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
                .'`photo_blob`=?, '
                .'`size`=?, '
                .'`type`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $photo->get_Title(),
            $photo->get_Description(),
            $photo->get_Upload_Date(),
            $photo->get_Reserved(),
            $uploader,
            $photo_details["photo_blob"],
            $photo_details["size"],
            $photo_details["type"]);

        $photo_ID = parent::execute_query($query, $toBind); //Inserts the photo and gets its ID.
        $photo->set_ID($photo_ID);
    }


    /**
     * Rethrives all the photos of a user by passing its username
     *
     * @param string $username The user's username selected to get the photos from
     * @return array The user's photos
     */
    public static function get_By_User($username)
    {
        $toSearch = array("user" => $username);
        $DB_table = "photo";
        $fetchAll = TRUE;
        return parent::get($toSearch, $DB_table, $fetchAll);
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
        return parent::get($toSearch, $DB_table);
    }


    /**
     *
     * @param type $album_ID
     * @return type
     */
    public static function get_By_Album($album_ID)
    {
        $query = "SELECT * "
                ."FROM `photo` "
                ."WHERE `id` in ("
                    ."SELECT `photo` "
                    ."FROM `cat_photo` "
                    .'WHERE `album`=?'
                    .")";
        $toBind = array($album_ID);

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt = parent::bind_params($pdo_stmt, $toBind);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Rethrives all the photos with the selected categories
     *
     * @param enum or array $cats The category/ies to search
     */
    public static function get_By_Categories($cats)
    {
        $where = '';
        foreach ((array) $cats as $v)
        {
            $where .= '(`category`=?) OR ';
        }
        $where = substr($where, 0, -4); //Removes the " OR " at the end of the string

        $query = "SELECT * "
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
     * Updates the categories of an album. This function both add new categories
     * and remove old categories (if selected) from the album
     *
     * @param enum or array $new_cats The new category/ies chosen for the album
     * @param enum or array $old_cats The category/ies to remove from the album
     * @param int $album_ID The album's ID to whom set/remove the categories
     * @throws \Exceptions\invalid_Query In case there are no categories to add neither to remove
     */
    public static function update_Categories($new_cats, $old_cats, $album_ID)
    {
        $to_add    = array_diff((array) $new_cats, (array) $old_cats);
        $to_remove = array_diff((array) $old_cats, (array) $new_cats);

        if(count($to_add)>=1 && count($to_remove)>=1)
        {
            $query_ADD = self::set_Categories($to_add, $album_ID);
            $query_DEL = self::remove_Categories($to_remove, $album_ID);
            $query = $query_ADD."; ".$query_DEL;
            $toBind = array_merge($to_add, $to_remove);
        }
        elseif(count($to_add)>=1 && count($to_remove)<1)
        {
            $query = self::set_Categories($to_add, $album_ID); // =$query_ADD;
            $toBind = $to_add;
        }
        elseif(count($to_add)<1 && count($to_remove)>=1)
        {
            $query = self::remove_Categories($to_remove, $album_ID); // =$query_DEL
            $toBind = $to_remove;
        }
//-----ELSE NO CHANGES WERE MADE MAY THROW AN EXCEPTION OR LEAVE IT EMPTY-----\\
//        else
//        {
//            throw new \Exceptions\InvalidAlbumInfo(0, array_merge($new_cats, $old_cats));
//        }
        parent::execute_query($query, $toBind);
    }


    /**
     * Sets the album categories. To be used on album creation
     *
     * @param string/array $cat The category/ies chosen for the album
     * @param int $album_ID The album's ID to whom set the categories
     * @return string The query used to add categories to the album
     */
    private static function set_Categories($cat, $album_ID)
    {
        $query = "INSERT INTO `cat_album` (`album`, `category`) VALUES ";
        foreach ((array) $cat as $value)
        {
            $query .= "('$album_ID', ?),";
        }
        return $query = substr($query, 0, -1); //Trims the last ","
    }


    /**
     * Removes the selected categories from the album
     *
     * @param enum or array $cats The category/ies to remove from the album selected
     * @param int $album_ID The album to modify and remove categories from
     * @return string The query used to remove categories from the album
     */
    private static function remove_Categories($cats, $album_ID)
    {
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
     * Updates a record from the "photo" table
     *
     * @param array $new_photo The ARRAY containing the new photo details got from "View"
     * @param array $old_photo The ARRAY containing the old photo details
     */
    public static function update_Details($new_photo, $old_photo)
    {
        $DB_table = "photo";
        $primary_Key = "id";
        parent::update($new_photo, $old_photo, $DB_table, $primary_Key);
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