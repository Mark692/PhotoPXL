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
     * @param array $photo_details The blob file, its size and type
     * @param string $uploader The uploader's username
     */
    public static function insert(\Entity\E_Photo $photo, $photo_details, $uploader)
    {
        $query = 'INSERT INTO `photo` SET '
                .'`title`=?, '
                .'`description`=?, '
                .'`upload_date`=?, '
                .'`is_reserved`=?, '
                .'`user`=?, '
                .'`fullsize`=?, '
                .'`thumbnail`=?, '
                .'`size`=?, '
                .'`type`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $photo->get_Title(),
            $photo->get_Description(),
            $photo->get_Upload_Date(),
            $photo->get_Reserved(),
            $uploader,
            $photo_details["photo_blob"],
            $photo_details["thumbnail"],
            $photo_details["size"],
            $photo_details["type"]);

        $photo_ID = parent::execute_query($query, $toBind); //Inserts the photo and gets its ID.
        $photo->set_ID($photo_ID);

        $cats = $photo->get_Categories();
        $query_addCats = self::add_Cats($cats, $photo_ID);
        if($query_addCats!=='')
        {
            parent::execute_query($query_addCats, $cats);
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

        $set = array(
            "id" => $id,
            "title" => $to_Update->get_Title(),
            "description" => $to_Update->get_Description(),
            "creation_date" => $to_Update->get_Upload_Date(),
            "is_reserved" => $to_Update->get_Reserved()
                );

        $update = "photo";
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
    public static function get_By_User($username, $order_DESC=FALSE)
    {
        $select = array("id", "thumbnail");
        $from = "photo";
        $where = array("user" => $username);
        $fetchAll = TRUE;
        $orderBy = $username;
        return parent::get_All($where, $from, $select, $fetchAll, $orderBy, $order_DESC);
    }


    /**
     * Rethrives the photo corresponding to the ID selected
     *
     * @param int $id The photo's ID
     * @return array The selected photo
     */
    public static function get_By_ID($id)
    {
        $toSearch = array("id" => $id);
        $DB_table = "photo";
        $photo = parent::get_All($toSearch, $DB_table);
        $categories = self::get_Categories($id);

//        return array_merge($photo, $categories);
    }


    /**
     * Retrieves the IDs and thumbnails of all photos belonging to a specific album
     *
     * @param int $album_ID
     * @return array An array with photo thumbnails
     */
    public static function get_By_Album($album_ID)
    {
        $query = "SELECT `id`, `thumbnail` "
                ."FROM `photo` "
                ."WHERE `id` in ("
                    ."SELECT `photo` "
                    ."FROM `cat_photo` "
                    .'WHERE `album`=?'
                    .")";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $album_ID);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Rethrives all the photos with the selected categories
     *
     * @param array $cats The category/ies to search
     */
    public static function get_By_Categories($cats)
    {
        $where = '';
        for($i=0; $i<count($cats); $i++)
        {
            $where .= '(`category`=?) OR ';
        }
        $where = substr($where, 0, -4); //Removes the " OR " at the end of the string

        $query = "SELECT `id`, `thumbnail` "
                ."FROM `photo` "
                ."WHERE `id` in ("
                    ."SELECT `photo` "
                    ."FROM `cat_photo` "
                    .'WHERE '.$where
                    .")";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = parent::bind_params($pdo_stmt, $cats);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Updates the categories of a photo. This function both add new categories
     * and remove old categories (if selected) from the album
     *
     * @param array $new_cats The new categories chosen for the photo
     * @param int $photo_ID The photo's ID to whom set/remove the categories
     * @throws \Exceptions\queries In case there are no categories to add neither to remove
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

        $query_ADD = self::add_Cats($to_add, $photo_ID);
        $query_DEL = self::remove_Cats($to_remove, $photo_ID);
        $query = $query_ADD.$query_DEL;

        if($query_ADD!=='')
        {
            $toBind = $to_add;
            if($query_DEL!=='')
            {
                array_push($toBind, $to_remove);
            }
        }
        elseif($query_DEL!=='')
        {
            $toBind = $to_remove;
        }
        else
        {
            throw new \Exceptions\queries(2, array_merge($new_cats, $old_cats));
        }
        parent::execute_query($query, $toBind);
    }


    /**
     * Sets the photo categories
     *
     * @param array $cats The categories chosen for the album
     * @param int $photo_ID The photo's ID to whom set the categories
     * @return string The query used to add categories to the photo
     */
    private static function add_Cats($cats, $photo_ID)
    {
        if($cats === [])
        {
            return '';
        }
        $query = "INSERT INTO `cat_photo` (`photo`, `category`) VALUES ";
        for($i=0; $i<count($cats); $i++)
        {
            $query .= "('$photo_ID', ?),";
        }
        return substr($query, 0, -1).";"; //Trims the last "," and places a ";"
    }


    /**
     * Retrieves the photo's categories
     *
     * @param int $photo_ID The photo ID to look for categories
     * @return array The photo's categories
     */
    private static function get_Categories($photo_ID)
    {
        $query = "SELECT `category` "
                ."FROM `cat_photo` "
                ."WHERE `photo`=?";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $photo_ID);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Removes the selected categories from the album
     *
     * @param enum or array $cats The category/ies to remove from the album selected
     * @param int $album_ID The album to modify and remove categories from
     * @return string The query used to remove categories from the album
     */
    private static function remove_Cats($cats, $album_ID)
    {
        if($cats === [])
        {
            return '';
        }
        $query = "DELETE FROM `cat_album` "
                ."WHERE (`album`=$album_ID) "
                ."AND (";
        foreach ((array) $cats as $value)
        {
            $query .= "(`category`=?) OR ";
        }
        return substr($query, 0, -4).")"; //Trims the last " OR " and closes the paranthesys
    }


    /**
     * Retrieves the number of likes from the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return int The number of likes of the selected photo
     */
    public static function get_Total_Likes($photo_ID)
    {
        $query = "SELECT COUNT(user) "
                ."FROM likes "
                ."WHERE photo=?";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $photo_ID);
        $total_likes = $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $total_likes;
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
        parent::execute_query($query, $toBind);
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
        parent::execute_query($query, $toBind);
    }


    /**
     * Moves a photo to another album
     *
     * @param int $album_ID The new album ID to move to photo to
     * @param int $photo_ID The photo to move
     */
    public static function move_To($album_ID, $photo_ID)
    {
        $query = "UPDATE `photo_album` "
                ."SET `album`=? "
                ."WHERE `photo`=?";

        $toBind = array($album_ID, $photo_ID);
        parent::execute_query($query, $toBind);
    }
}