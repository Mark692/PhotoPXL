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
     * Saves a photo object
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

        $photo_ID = parent::insert_Query($insertInto, $set);
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
            "title" => $to_Update->get_Title(),
            "description" => $to_Update->get_Description(),
            "upload_date" => $to_Update->get_Upload_Date(),
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
     * @param int $page_toView The page number to view. It influences the offset
     * @param $order_DESC Whether to order result in DESCendent order. Default: ASCendent
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
        $where = "`user`='$username'";
        $tot = parent::count($count, $from, $where);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($photos, $tot_photo);
    }


    /**
     * Rethrives the photo corresponding to the ID selected
     *
     * @param int $id The photo's ID
     * @return array The \Entity\E_Photo object photo, its uploader, fullsize and type
     */
    public static function get_By_ID($id)
    {
        //Select ALL but ID, Thumbnail and Size
        $select = array("title", "description", "is_reserved", "upload_date", "user", "fullsize", "type");
        $from = "photo";
        $where = array("id" => $id);
        $photo = parent::get_One($select, $from, $where);

        //Retrieves the categories
        $cats = self::get_Categories($id);

        //Retrieves the likes
        $liked_By = self::get_TotalLikes($id);

        $e_photo = new \Entity\E_Photo(
                $photo["title"],
                $photo["description"],
                $photo["is_reserved"],
                $cats,
                $liked_By,
                $photo["upload_date"]
                );
        $e_photo->set_ID($id);

        return array(
            "photo" => $e_photo,
            "uploader" => $photo["user"],
            "fullsize" => $photo["fullsize"],
            "type" => $photo["type"]
            );
    }


    /**
     * Retrieves the IDs and thumbnails of all photos belonging to a specific album
     *
     * @param int $album_ID
     * @param int $page_toView The page number to view. It influences the offset
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
     * @param array $cats The categories to search
     * @param int $page_toView The number of page to view. It influences the offset
     * @param $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with the photos matching the categories selected.
     */
    public static function get_By_Categories($cats, $page_toView=1, $order_DESC=FALSE)
    {
        $where = '';
        //Alternate $where = `category` IN ( foreach($cats as $c) );
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
                    .') ';
        if($order_DESC===TRUE)
        {
            $query .= 'ORDER BY album.id DESC ';
        }
        $query .= 'LIMIT '.$limit.' '
                 .'OFFSET '.$offset;

        $fetchAll = TRUE;
        $toBind = $cats;
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
        $old_cats = self::get_Categories($photo_ID);

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
     * @param array $cats The category/ies to remove from the photo selected
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
        $cats_array = parent::get_All($select, $from, $where);

        $cats=[];
        foreach($cats_array as $sub_array)
        {
            array_push($cats, $sub_array["category"]); //Keep only the values
        }
        return $cats;
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
        $likes = parent::get_All($select, $from, $where);
        $usernames_only = [];
        foreach($likes as $v)
        {
            array_push($usernames_only, $v["user"]);
        }
        return $usernames_only;
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
                    .'INNER JOIN `likes` '
                    .'ON photo.id=likes.photo '
                .'GROUP BY `photo` '
                .'ORDER BY COUNT(*) DESC ' //From most liked to less liked
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
     * Deletes a photo from the DB including its likes and comments
     *
     * @param int $photo_ID The photo ID to delete from the DB
     */
    public static function delete($photo_ID)
    {
        $album_ID = self::check_LastOne($photo_ID);
        if($album_ID!==FALSE)
        {
            \Foundation\F_Album::update_Cover($album_ID);
        }

        $query = 'DELETE FROM `likes` '
                    .'INNER JOIN `comment` '
                    .'ON likes.photo = comment.photo '
                        .'INNER JOIN `photo` '
                        .'ON comment.photo = photo.id '
                .'WHERE (photo.id = ?)';

        $toBind = array($photo_ID);

        parent::execute_Query($query, $toBind);
    }


    /**
     * Deletes all photos within an album including their likes and comments
     *
     * @param int $album_ID The album from which we want to delete photos
     */
    public static function delete_ALL_fromAlbum($album_ID)
    {

        //Sets the default cover for the empty album
        \Foundation\F_Album::update_Cover($album_ID);

        //Deletes the album photos
        $query = 'DELETE FROM `likes` '
                    .'INNER JOIN `comment` '
                    .'ON likes.photo = comment.photo '
                        .'INNER JOIN `photo` '
                        .'ON comment.photo = photo.id '
                ."WHERE photo.id IN ("
                    ."SELECT `photo` "
                    ."FROM `photo_album` "
                    ."WHERE `album`=?"
                    .")";

        $toBind = array("id" => $album_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Moves a photo to another album and sets a default cover for the album if
     * it would be empty after the move
     *
     * @param int $album_ID The new album ID to move to photo to
     * @param int $photo_ID The photo to move
     */
    public static function move_To($album_ID, $photo_ID)
    {
        $album_ID = self::check_LastOne($photo_ID);
        if($album_ID!==FALSE)
        {
            \Foundation\F_Album::update_Cover($album_ID);
        }

        $update = "photo_album";
        $set = array("album" => $album_ID);
        $where = array("photo" => $photo_ID);
        parent::update($update, $set, $where);
    }


    /**
     * Checks whether this photo is the last photo of its album
     *
     * @param int $photo_ID The photo to check
     * @return mixed - "int": the album ID if the photo is the last one
     *               - "boolean" FALSE: The photo is not the last one in the album
     *                                  OR the photo is not in any album
     */
    private static function check_LastOne($photo_ID)
    {
        $select = array("album");
        $from = "photo_album";
        $where = array("photo" => $photo_ID);
        $album_ID = parent::get_One($select, $from, $where);
        if($album_ID!==[])
        {
            $count = "photo";
            $where = '`album` = ?';
            $count = parent::count($count, $from, $where, $album_ID);
            if($count===1)
            {
                return $album_ID;
            }
        }
        return FALSE;
    }
}