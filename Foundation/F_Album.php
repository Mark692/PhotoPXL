<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use PDO; //It IS used.

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
        $query_addCats = self::add_Cats($cats_toSet, $album_ID);
        if($query_addCats!=='')
        {
            parent::execute_query($query_addCats, $cats_toSet);
        }
    }


    /**
     * Updates the album details
     *
     * @param \Entity\E_Album $to_Update The new Album object to save
     */
    public static function update(\Entity\E_Album $to_Update)
    {
        $album_ID = $to_Update->get_ID();
        $array_toUpdate = array(
            "id" => $album_ID,
            "title" => $to_Update->get_Title(),
            "description" => $to_Update->get_Description(),
            "creation_date" => $to_Update->get_Creation_Date()
                );
        $DB_table = "album";
        $primary_key = "id";
        parent::update($array_toUpdate, $DB_table, $primary_key, $album_ID);

        $cats = $to_Update->get_Categories();
        self::update_Categories($cats, $album_ID);
    }


    /**
     * Rethrives the albums of a user by passing the album's ID.
     *
     * @param int $ID The user's username selected to get the albums from
     * @return array The album searched
     */
    public static function get_By_ID($ID)
    {
        $query1 = "SELECT * "
                 ."FROM `album` "
                 ."WHERE `id`=?;";

        $query2 = "SELECT `thumbnail` "
                . "FROM `album_cover` "
                . "WHERE `id`=?";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $ID);
        $pdo_stmt->bindParam(2, $ID);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $details = parent::get_All($toSearch, $DB_table, $fetchAll);

        $query = "SELECT `thumbnail` "
                . "FROM `album_cover` "
                . "WHERE `id`=?";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $details["id"]);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        $cover = $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);

        //NON VA BENE.
        //FINISCILA E CONTROLLA TUTTE LE ALTRE
        //CONTROLLA I "return ARRAY MERGE" PERCHè SONO SBAGLIATI AL 90%
        //USA UN FOREACH PER ASSOCIARE I DATI DI UNA QUERY AI DATI DI UN'ALTRA
        //(foreach as $v {push(arr1[id], arr2[id]})




    }


    /**
     * Rethrives all the album with the selected categories
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
     * @param array $new_cats The new category/ies chosen for the album
     * @param int $album_ID The album's ID to whom set/remove the categories
     * @throws \Exceptions\queries In case there are no categories to add neither to remove
     */
    private static function update_Categories($new_cats, $album_ID)
    {
        $old = self::get_Categories($album_ID); //$old will be an associative array
        $old_cats=[];
        foreach($old as $v)
        {
            array_push($old_cats, $v); //Keep only the values
        }
        $to_add    = array_diff($new_cats, $old_cats);
        $to_remove = array_diff($old_cats, $new_cats);

        $query_ADD = self::add_Cats($to_add, $album_ID);
        $query_DEL = self::remove_Cats($to_remove, $album_ID);
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
     * Sets the album categories. To be used on album creation
     *
     * @param enum or array $cat The category/ies chosen for the album
     * @param int $album_ID The album's ID to whom set the categories
     * @return string The query used to add categories to the album
     */
    private static function add_Cats($cats, $album_ID)
    {
        if($cats === [])
        {
            return '';
        }
        $query = "INSERT INTO `cat_album` (`album`, `category`) VALUES ";
        for($i=0; $i<count($cats); $i++)
        {
            $query .= "('$album_ID', ?),";
        }
        return substr($query, 0, -1).";"; //Trims the last "," and places a ";"
    }


    /**
     * Retrieves the album's categories
     *
     * @param int $album_ID The album ID to look for categories
     * @return array The album's categories
     */
    private static function get_Categories($album_ID)
    {
        $query = "SELECT `category` "
                ."FROM `cat_album` "
                ."WHERE `album`=?";

        $pdo = parent::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->bindParam(1, $album_ID);
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
        for($i=0; $i<count($cats); $i++)
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