<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Entity\E_Photo;
use Entity\E_Photo_Blob;
use Utilities\Roles;
use const PHOTOS_PER_PAGE;

class F_Photo extends F_Database
{

    /**
     * Saves a photo object and sets its ID into the $photo object
     *
     * @param E_Photo $photo The photo to save
     * @param E_Photo_Blob $photo_details The blob file, its size and type
     * @param string $uploader The uploader's username
     */
    public static function insert(E_Photo $photo, E_Photo_Blob $photo_details, $uploader)
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
     * @param E_Photo $to_Update The photo to update
     */
    public static function update(E_Photo $to_Update)
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
     * @param string $uploader The user's username selected to get the photos from
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The watching user's role
     * @param int $page_toView The page number to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array The user's photos
     */
    public static function get_By_User($uploader, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
    {
        $select = array("id", "thumbnail", "type");
        $from = "photo";
        $where = array("user" => $uploader);
        if($user_Watching !== $uploader)
        {
            if($user_Role < Roles::MOD)
            {
                $publicOnly = array("is_reserved" => 0);
                $where = array_merge($where, $publicOnly);
            }
        }
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);
        $orderBy = "id";
        $photos = parent::get_All($select, $from, $where, $limit, $offset, $orderBy, $order_DESC);


        $count = "id";
        $noPermissions = self::add_ClauseNoPermission($user_Role);
        $where = '(`user`=\''.$uploader.'\') '.$noPermissions;

        $toBind = [];
        if($noPermissions !== '')
        {
            $toBind = array($user_Watching);
        }
        $tot = parent::count($count, $from, $where, $toBind);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($photos, $tot_photo);
    }


    /**
     * Rethrives the photo corresponding to the ID selected
     *
     * @param int $id The photo's ID
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The user role
     * @return mixed An array containing the \Entity\E_Photo object photo, its uploader, fullsize and type
     *               A boolean FALSE if no photo matches the query
     */
    public static function get_By_ID($id, $user_Watching, $user_Role)
    {
        //Select ALL but ID, Thumbnail and Size
        $select = array("title", "description", "is_reserved", "upload_date", "user", "fullsize", "type");
        $from = "photo";
        $where = array("id" => $id);
        if(!self::can_beShowed($id, $user_Watching, $user_Role))
        {
            $where = array_merge($where, array("is_reserved" => "0")); //Fetches only PUBLIC photos
        }
        $photo = parent::get_One($select, $from, $where);

        if($photo === FALSE) //No photos match the query
        {
            return FALSE;
        }

        //Retrieves the categories
        $cats = self::get_Categories($id);

        //Retrieves the likes
        $liked_By = self::get_LikeList($id);

        //Retrieves the comments
        $commented_By = self::get_UsernamesThatCommented($id);


        $e_photo = new E_Photo(
                $photo["title"],
                $photo["description"],
                $photo["is_reserved"],
                $cats,
                $photo["upload_date"],
                $liked_By,
                $commented_By
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
     * Retrieves the IDs and thumbnails of the photos belonging to a specific album.
     * The fetched photos are always the public ones but can also be the private
     * ones if the user watching is the Uploader or a MOD/Admin
     *
     * @param int $album_ID The album ID of which get the photos from
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The user role
     * @param int $page_toView The page number to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with photo IDs and thumbnails
     */
    public static function get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
    {
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT photo.id, photo.thumbnail, photo.type '
                .'FROM `photo` '
                    .'INNER JOIN `users` '
                    .'ON photo.user=users.username '
                .'WHERE photo.id in '
                .'( '
                    .'SELECT `photo` '
                    .'FROM `photo_album` '
                    .'WHERE `album`=? ' //$album_ID
                .') ';

        $user_clause = self::add_ClauseNoPermission($user_Role);
        $query .= $user_clause
                .'ORDER BY `id` ';
        if ($order_DESC===TRUE)
        {
            $query .= 'DESC ';
        }
        $query .= 'LIMIT '.$limit.' '
                 .'OFFSET '.$offset;

        $toBind = array($album_ID);
        if($user_clause !== '')
        {
            array_push($toBind, $user_Watching);
        }

        $fetchAll = TRUE;
        $photos = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "`photo_album` "
                ."INNER JOIN `photo` "
                ."ON photo_album.photo=photo.id";
        $where = "`album`=? ";
        if($user_Role < Roles::MOD)
        {
            $where .= self::add_ClauseNoPermission($user_Role);
        }
        $tot = parent::count($count, $from, $where, $toBind);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($photos, $tot_photo);
    }


    /**
     * Retrives all the photos with the selected categories
     *
     * @param array $cats The categories to search
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The user role
     * @param int $page_toView The number of page to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with the photos matching the categories selected.
     */
    public static function get_By_Categories($cats, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
    {
        $where = '(';
        //Alternate $where = `category` IN ( foreach($cats as $c) );
        for($i=0; $i<count($cats); $i++)
        {
            $where .= '(`category`=?) OR ';
        }
        $where = substr($where, 0, -4).') '; //Removes the " OR " and adds a ') '
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT DISTINCT `id`, `thumbnail`, `type` '
                .'FROM `photo` '
                .'WHERE `id` in ('
                    .'SELECT DISTINCT `photo` '
                    .'FROM `cat_photo` '
                    .'WHERE '.$where
                    .') ';

        $noPermissions = self::add_ClauseNoPermission($user_Role);
        $query .= $noPermissions
                .'ORDER BY photo.id ';
        if($order_DESC===TRUE)
        {
            $query .= 'DESC ';
        }
        $query .= 'LIMIT '.$limit.' '
                 .'OFFSET '.$offset;

        $fetchAll = TRUE;
        $toBind = $cats;
        if($noPermissions !== '')
        {
            array_push($toBind, $user_Watching);
        }
        $photos = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "`cat_photo` INNER JOIN `photo` ON cat_photo.photo=photo.id";
        $where .= $noPermissions; //Here is VERY important that $where is surrounded by ()
        $tot = parent::count($count, $from, $where, $toBind);

        return array_merge($photos, array("tot_photo" => $tot));
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

        $to_add = array_diff($new_cats, $old_cats);
        $to_remove = array_diff($old_cats, $new_cats);

        $query_ADD = self::query_addCats($to_add, $photo_ID);
        $query_DEL = self::query_removeCats($to_remove, $photo_ID);
        $query = $query_ADD.$query_DEL;

        if($query_ADD!=='')
        {
            $toBind = array_values($to_add);
            if($query_DEL!=='')
            {
                foreach($to_remove as $c)
                {
                    array_push($toBind, $c);
                }
            }
            parent::execute_Query($query, $toBind);
        }
        elseif($query_DEL!=='')
        {
            $toBind = array_values($to_remove);
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
        foreach($cats_array as $c)
        {
            array_push($cats, intval($c["category"]));
        }
        return $cats;
    }


    /**
     * Retrieves the list of all uses that liked the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return array The users that liked the selected photo
     */
    public static function get_LikeList($photo_ID)
    {
        $select = array("user");
        $from = "likes";
        $where = array("photo" => $photo_ID);
        $likes = parent::get_All($select, $from, $where);
        $usernames_only = [];
        foreach(array_values($likes) as $users)
        {
            array_push($usernames_only, $users);
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
    public static function get_MostLiked($user_Watching, $user_Role, $page_toView = 1)
    {
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT `id`, `thumbnail`, `type` '
                .'FROM `photo` '
                    .'INNER JOIN `likes` '
                    .'ON photo.id=likes.photo ';
        $noPermissions = self::add_ClauseNoPermission($user_Role);
        $toBind = [];
        $where = "1";
        if($noPermissions !== '')
        {
            $where = substr($noPermissions, 3); //Trims "AND"
            $query .= "WHERE ".$where;
            $toBind = array($user_Watching);
        }
        $query .='GROUP BY `photo` '
                .'ORDER BY COUNT(*) DESC ' //From most liked to less liked
                .'LIMIT '.$limit.' '
                .'OFFSET '.$offset.' ';
        $fetchAll = TRUE;
        $mostLiked = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "`likes` INNER JOIN `photo` ON likes.photo=photo.id";
        $tot = parent::count($count, $from, $where, $toBind);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($mostLiked, $tot_photo);
    }


    /**
     * Retrieves the list of all uses that commented the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return array The users that commented the selected photo
     */
    public static function get_UsernamesThatCommented($photo_ID)
    {
        $select = array("user");
        $from = "comment";
        $where = array("photo" => $photo_ID);
        $comments = parent::get_All($select, $from, $where);
        $usernames_only = [];
        foreach($comments as $users)
        {
            array_push($usernames_only, $users["user"]);
        }
        return $usernames_only;
    }


    /**
     * Deletes a photo from the DB including its likes and comments
     *
     * @param int $photo_ID The photo ID to delete from the DB
     */
    public static function delete($photo_ID)
    {
        $query = 'DELETE FROM `photo` '
                .'WHERE (photo.id = ?)'; //$photo_ID

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
        //Deletes the album photos
        $query = 'DELETE FROM `photo` '
                ."WHERE id IN ("
                    ."SELECT `photo` "
                    ."FROM `photo_album` "
                    ."WHERE `album`=?" //$album_ID
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
        $has_anAlbum = self::has_anAlbum($photo_ID); //Whether the photo was already in an album

        $table = "photo_album";
        if($has_anAlbum) //Already exists -> Update it
        {
            $set = array("album" => $album_ID);
            $where = array("photo" => $photo_ID);
            parent::update($table, $set, $where);
        }
        else //Does not exists -> Insert it
        {
            $set = array("album" => $album_ID, "photo" => $photo_ID);
            parent::insert_Query($table, $set);
        }
    }


    /**
     * Checks whether the photo belongs to an album or not
     *
     * @param int $photo_ID The photo to check
     * @return bool Whether the photo belongs to an album or not
     */
    private static function has_anAlbum($photo_ID)
    {
        $query = "SELECT EXISTS"
                ."( "
                    ."SELECT 1 "
                    ."FROM `photo_album` "
                    ."WHERE `photo` = ?"
                .") AS photo_exists";

        $toBind = array($photo_ID);
        $exists = parent::fetch_Result($query, $toBind);
        return boolval($exists["photo_exists"]);
    }


    /**
     * Cheks whether the user can look at "reserved" photos.
     * Returns TRUE whether the user is the uploader or at least a MOD
     *
     * @param int $photo_ID The photo to check if public or reserved
     * @param string $user The user trying to look at the photo
     * @param enum $user_Role The user role
     * @return boolean Whether the user can look at the specific photo
     */
    private static function can_beShowed($photo_ID, $user, $user_Role)
    {
        $check = array("is_reserved", "user");
        $from = "photo";
        $where = array("id" => $photo_ID);
        $photo = parent::get_One($check, $from, $where);
        if($photo["user"] === $user)
        {
            return TRUE; //The user is the uploader
        }
        elseif(intval($photo["is_reserved"]) === 1)
        {
            if($user_Role >= Roles::MOD)
            {
                return TRUE; //The user is a MOD or ADMIN
            }
        }
        return FALSE;
    }


    /**
     * Sets a basic WHERE clause whether the user's Role is not MOD/Admin
     *
     * @param enum $user_Role The user's Role
     * @return string The WHERE clause to add at the query
     */
    private function add_ClauseNoPermission($user_Role)
    {
        if($user_Role < Roles::MOD)
        {
            return 'AND IF '
                    .'( '
                        .'photo.user = BINARY ? , ' //$user_Watching - Case sensitive check
                        .'1, ' //if TRUE
                        .'photo.is_reserved = 0' //if FALSE
                    .') ';
        }
        return '';
    }
}