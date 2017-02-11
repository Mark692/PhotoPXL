<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

class F_Album extends \Foundation\F_Database
{

    /**
     * Creates an album in the DB
     *
     * @param \Entity\E_Album $album The album to save
     * @param string $owner The $owner's username
     */
    public static function insert(\Entity\E_Album $album, $owner)
    {
        $query = 'INSERT INTO `album` SET '
                .'`title`=?, '
                .'`description`=?, '
                .'`creation_date`=?, '
                .'`user`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $album->get_Title(),
            $album->get_Description(),
            $album->get_Creation_Date(),
            $owner);

        $album_ID = parent::execute_query($query, $toBind); //Inserts the album and gets its ID.
        $album->set_ID($album_ID);

        $cats_toSet = $album->get_Categories();
        $query_addCats = self::set_Categories($cats_toSet, $album_ID);
        if($query_addCats!=='')
        {
            parent::execute_query($query_addCats, $cats_toSet);
        }
    }


    /**
     * Updates the album details
     *
     * @param array $new_Details An ARRAY containing new details got from "View"
     * @param array $old_Details An ARRAY containing old details. This must be the DB record got from the get_by_*($q)
     * @param int $album_ID The album's ID
     */
    public static function update($new_Details, $old_Details, $album_ID)
    {
        $DB_table = "album";
        parent::update($new_Details, $old_Details, $DB_table, $album_ID);
    }


    /**
     * Rethrives the albums of a user by passing its username.
     *
     * @param string $username The user's username selected to get the albums from
     * @return array The user's albums
     */
    public static function get_By_User($username)
    {
        $toSearch = array("user" => $username);
        $DB_table = "album";
        $fetchAll = TRUE;
        return parent::get($toSearch, $DB_table, $fetchAll);
    }


    /**
     * Rethrives all the album with the selected categories
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
                ."FROM `album` "
                ."WHERE `id` in ("
                    ."SELECT `album` "
                    ."FROM `cat_album` "
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
     * @throws \Exceptions\invalid_Request In case there are no categories to add neither to remove
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
        else
        {
            throw new \Exceptions\invalid_Request(2, array_merge($new_cats, $old_cats));
        }
        parent::execute_query($query, $toBind);
    }


    /**
     * Sets the album categories. To be used on album creation
     *
     * @param enum or array $cat The category/ies chosen for the album
     * @param int $album_ID The album's ID to whom set the categories
     * @return string The query used to add categories to the album
     */
    private static function set_Categories($cats, $album_ID)
    {
        if((array) $cats === [])
        {
            return '';
        }
        $query = "INSERT INTO `cat_album` (`album`, `category`) VALUES ";
        foreach ((array) $cats as $value)
        {
            $query .= "('$album_ID', ?),";
        }
        return substr($query, 0, -1); //Trims the last ","
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
        if((array) $cats == [])
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
     * Deletes an album from the DB. Its photos will be kept with no album association
     * To delete all photos from an album use F_Photo::delete_ALL_fromAlbum
     *
     * @param int $album_ID The album ID to delete from the DB
     */
    public static function delete($album_ID)
    {
        $query = "DELETE FROM `album` "
                ."WHERE (`id`=?) ";

        $toBind = array("id" => $album_ID);
        parent::execute_query($query, $toBind);
    }

}