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
    public static function execute_query(\Entity\E_Album $album, $owner)
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
        $orderBy_column = "creation_date";
        return parent::get($toSearch, $DB_table, $fetchAll, $orderBy_column);
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
        $where = substr($where, 0, -5); //Removes the " OR " at the end of the string

        $query = 'SELECT * '
                .'FROM `cat_album` '
                .'WHERE '.$where;

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
     * @throws \Exceptions\InvalidAlbumInfo In case there are no categories to add neither to remove
     */
    public static function update_Categories($new_cats, $old_cats, $album_ID)
    {
        $to_add = array_diff((array) $new_cats, (array) $old_cats);
        $to_remove = array_diff((array) $old_cats, (array) $new_cats);
        $query_ADD='';
        $query_DEL='';

        if(count($to_add)>=1 && count($to_remove)>=1)
        {
            $query_ADD = self::set_Categories($to_add, $album_ID);
            $query_DEL = self::remove_Categories($to_remove, $album_ID);
            $query = $query_ADD.", ".$query_DEL;
            $toBind = array_merge($to_add, $to_remove);
        }
        elseif(count($to_add)<1 && count($to_remove)>=1)
        {
            $query = self::remove_Categories($to_remove, $album_ID); // =$query_DEL
            $toBind = $to_remove;
        }
        elseif(count($to_add)>=1 && count($to_remove)<1)
        {
            $query = self::set_Categories($to_add, $album_ID); // =$query_ADD;
            $toBind = $to_add;
        }
        else
        {
            throw new \Exceptions\InvalidAlbumInfo(0, array_merge($new_cats, $old_cats));
        }
        parent::execute_query($query, $toBind);
    }


    /**
     * Sets the album categories
     *
     * @param string/array $cat The category/ies chosen for the album
     * @param int $album_ID The album's ID to whom set the categories
     * @return string The query used to add categories to the album
     */
    public static function set_Categories($cat, $album_ID)
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
    public static function remove_Categories($cats, $album_ID)
    {
        $query = "DELETE FROM `cat_album` "
                ."WHERE (`album`=$album_ID) "
                ."AND (";
        foreach ((array) $cats as $value)
        {
            $query .= "(`category`=?) OR ";
        }
        return $query = substr($query, 0, -5).")"; //Trims the last " OR " and closes the paranthesys
    }

}