<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

class F_Photo extends \Foundation\F_Database
{

    /**
     * Saves a photo object in the DB using ONLY one table instead of two.
     * This will half the queries for "inserts" and "gets"
     *
     * @param \Entity\E_Photo $photo The photo to save
     * @param \Entity\E_Photo_Blob $photo_details The blob file, its size and type
     * @param string $uploader The uploader's username
     */
    public static function insert(\Entity\E_Photo $photo, \Entity\E_Photo_Blob $photo_details, $uploader)
    {
        //Insert all photo details but the categories
        $insertInto = "photo";

        $set = array(
            "title" => $photo->get_Title(),
            "description" => $photo->get_Description(),
            "upload_date" => $photo->get_Upload_Date(),
            "is_reserved" => $photo->get_Reserved(),
            "user" => $uploader,
            "fullsize" => $photo_details->get_Fullsize(),
            "thumbnail" => $photo_details->get_Thumbnail(),
            "size" => $photo_details->get_Size(),
            "type" => $photo_details->get_Type()
                );

        $photo_ID = parent::insert_Query($insertInto, $set); //Inserts the photo and gets its ID.
        $photo->set_ID($photo_ID);

        //Finally inserts categories
        $cats = $photo->get_Categories();
        if($cats!==[])
        {
            $query = self::query_addCats($cats, $photo_ID);
            parent::execute_Query($query, $cats);
        }
    }


    /**
     * Updates a record from the "photo" table
     *
     * @param \Entity\E_Photo $to_Update The photo to update
     */
    public static function update(\Entity\E_Photo $to_Update)
    {
        $id = $to_Update->get_ID();
        $update = "photo";
        $set = array(
            "id" => $id,
            "title" => $to_Update->get_Title(),
            "description" => $to_Update->get_Description(),
            "creation_date" => $to_Update->get_Upload_Date(),
            "is_reserved" => $to_Update->get_Reserved()
                );
        $where = array("id" => $id);
        parent::update($update, $set, $where);

        $cats = $to_Update->get_Categories();
        self::update_Categories($cats, $id);
    }


    /**
     * Rethrives all the IDs and thumbnails of a user photos by passing its username
     *
     * @param string $username The user's username selected to get the photos from
     * @return array The user's photos
     */
    public static function get_By_User($username, $page_toView=1, $order_DESC=FALSE)
    {
        $select = array("id", "thumbnail");
        $from = "photo";
        $where = array("user" => $username);
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);
        $orderBy = "id";
        $photos = parent::get_All($select, $from, $where, $limit, $offset, $orderBy, $order_DESC);

        $count = "id";
        $where = "`user`=$username";
        $tot = parent::count($count, $from, $where);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($photos, $tot_photo);
    }


    /**
     * Rethrives the photo corresponding to the ID selected
     *
     * @param int $id The photo's ID
     * @return array The selected photo, its categories and the users that liked the photo
     */
    public static function get_By_ID($id)
    {
        //Select ALL but ID, Thumbnail and Size
        $select = array("title", "description", "is_reserved", "upload_date", "user", "fullsize", "type");
        $from = "photo";
        $where = array("id" => $id);
        $photo = parent::get_One($select, $from, $where);

        //Retrieves the categories
        $array_categories = self::get_Categories($id);
        $cats = [];
        foreach($array_categories as $k => $v)
        {
            array_push($cats, $array_categories[$k][$v]);
        }

        //Retrieves the number of likes
        $user_likes = self::get_TotalLikes($id);
        $liked_By = [];
        foreach($user_likes as $k => $v)
        {
            array_push($liked_By, $array_categories[$k][$v]);
        }

        return array_merge($photo, $cats, $liked_By);
    }


    /**
     * Retrieves the IDs and thumbnails of all photos belonging to a specific album
     *
     * @param int $album_ID
     * @param int $page_toView The number of page to view. It influences the offset
     * @param $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with photo IDs and thumbnails
     */
    public static function get_By_Album($album_ID, $page_toView=1, $order_DESC=FALSE)
    {
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT `id`, `thumbnail` '
                .'FROM `photo` '
                .'WHERE `id` in ('
                    .'SELECT `photo` '
                    .'FROM `photo_album` '
                    .'WHERE `album`=?'
                    .') '
                .'ORDER BY `id` ';
        if ($order_DESC===TRUE)
        {
            $query .= ' DESC ';
        }
        $query .='LIMIT '.$limit.' '
                .'OFFSET '.$offset;

        $fetchAll = TRUE;
        $toBind = array($album_ID);
        $photos = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "photo_album";
        $where = "`album`=?";
        $tot = parent::count($count, $from, $where, $toBind);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($photos, $tot_photo);
    }


    /**
     * Rethrives all the photos with the selected categories
     *
     * @param array $cats The category/ies to search
     * @param int $page_toView The number of page to view. It influences the offset
     * @return array An array with the photos matching the categories selected.
     */
    public static function get_By_Categories($cats, $page_toView=1)
    {
        $where = '';
        for($i=0; $i<count($cats); $i++)
        {
            $where .= '(`category`=?) OR ';
        }
        $where = substr($where, 0, -4); //Removes the " OR " at the end of the string
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT `id`, `thumbnail` '
                .'FROM `photo` '
                .'WHERE `id` in ('
                    .'SELECT `photo` '
                    .'FROM `cat_photo` '
                    .'WHERE '.$where
                    .') '
                .'ORDER BY `id` '
                .'LIMIT '.$limit.' '
                .'OFFSET '.$offset;

        $fetchAll = TRUE;
        $toBind = array($cats);
        $photos = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "cat_photo";
        $tot = parent::count($count, $from, $where, $toBind);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($photos, $tot_photo);
    }


    /**
     * Updates the categories of a photo. This function both add new categories
     * and remove old categories (if selected) from the album
     *
     * @param array $new_cats The new categories chosen for the photo
     * @param int $photo_ID The photo's ID to whom set/remove the categories
     */
    private static function update_Categories($new_cats, $photo_ID)
    {
        $old = self::get_Categories($photo_ID); //$old will be an associative array
        $old_cats=[];
        foreach($old as $v)
        {
            array_push($old_cats, $v); //Keep only the values
        }
        $to_add    = array_diff($new_cats, $old_cats);
        $to_remove = array_diff($old_cats, $new_cats);

        $query_ADD = self::query_addCats($to_add, $photo_ID);
        $query_DEL = self::query_removeCats($to_remove, $photo_ID);
        $query = $query_ADD.$query_DEL;

        if($query_ADD!=='')
        {
            $toBind = $to_add;
            if($query_DEL!=='')
            {
                array_push($toBind, $to_remove);
                parent::execute_Query($query, $toBind);
            }
        }
        elseif($query_DEL!=='')
        {
            $toBind = $to_remove;
            parent::execute_Query($query, $toBind);
        }
    }


    /**
     * Sets the photo categories
     *
     * @param array $cats The categories chosen for the album
     * @param int $photo_ID The photo's ID to whom set the categories
     * @return string The query used to add categories to the photo
     */
    private static function query_addCats($cats, $photo_ID)
    {
        $tot_cats = count($cats);
        if($tot_cats===0)
        {
            return '';
        }
        $query = "INSERT INTO `cat_photo` (`photo`, `category`) "
                ."VALUES ";
        for($i=0; $i<$tot_cats; $i++)
        {
            $query .= "('$photo_ID', ?),";
        }
        return substr($query, 0, -1).";"; //Trims the last "," and places a ";"
    }


    /**
     * Removes the selected categories from the photo
     *
     * @param enum or array $cats The category/ies to remove from the photo selected
     * @param int $photo_ID The photo to modify and remove categories from
     * @return string The query used to remove categories from the photo
     */
    private static function query_removeCats($cats, $photo_ID)
    {
        $tot_cats = count($cats);
        if($tot_cats===0)
        {
            return '';
        }
        $query = "DELETE FROM `cat_photo` "
                ."WHERE (`photo`=$photo_ID) "
                ."AND (";
        for($i=0; $i<$tot_cats; $i++)
        {
            $query .= "(`category`=?) OR ";
        }
        return substr($query, 0, -4).")"; //Trims the last " OR " and closes the paranthesys
    }


    /**
     * Retrieves the photo's categories
     *
     * @param int $photo_ID The photo ID to look for categories
     * @return array The photo's categories
     */
    private static function get_Categories($photo_ID)
    {
        $select = array("category");
        $from = "cat_photo";
        $where = array("photo" => $photo_ID);
        return parent::get_All($select, $from, $where);
    }


    /**
     * Retrieves the list of all uses that liked the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return array The users that liked the selected photo
     */
    public static function get_TotalLikes($photo_ID)
    {
        $select = array("user");
        $from = "likes";
        $where = array("photo" => $photo_ID);
        return parent::get_All($select, $from, $where);
    }


    /**
     * Retrieves the most liked photos in DESCending style
     *
     * @param int $page_toView The page selected as offset to fetch the photos
     * @return array An array with the IDs and Thumbnails of the most liked photos
     *               and the number of rows affected by the query (to be used to
     *               determine how many pages to show)
     */
    public static function get_MostLiked($page_toView=1)
    {
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);
        $query = 'SELECT `id`, `thumbnail` '
                .'FROM `photo` '
                .'WHERE `id` in '
                .'('
                    .'SELECT `photo` '
                    .'FROM `likes` '
                    .'GROUP BY `photo` '
                    .'ORDER BY COUNT(*) '
                .') '
                .'ORDER BY `id` DESC '
                .'LIMIT '.$limit.' '
                .'OFFSET '.$offset.' ';
        $toBind = [];
        $fetchAll = TRUE;
        $mostLiked = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "likes";
        $where = "1";
        $tot = parent::count($count, $from, $where);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($mostLiked, $tot_photo);
    }


    /**
     * Deletes a photo from the DB
     *
     * @param int $photo_ID The photo ID to delete from the DB
     */
    public static function delete($photo_ID)
    {
        $query = "DELETE FROM `photo` "
                ."WHERE (`id`=?) ";

        $toBind = array("id" => $photo_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Deletes all photos whithin an album
     *
     * @param int $album_ID The album from which we want to delete photos
     */
    public static function delete_ALL_fromAlbum($album_ID)
    {
        $query = "DELETE FROM `photo` "
                ."WHERE `id` in ("
                    ."SELECT `photo` "
                    ."FROM `photo_album` "
                    ."WHERE `album`=?"
                    .")";

        $toBind = array("id" => $album_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Moves a photo to another album
     *
     * @param int $album_ID The new album ID to move to photo to
     * @param int $photo_ID The photo to move
     */
    public static function move_To($album_ID, $photo_ID)
    {
        $update = "photo_album";
        $set = array("album" => $album_ID);
        $where = array("photo" => $photo_ID);
        parent::update($update, $set, $where);
    }
}