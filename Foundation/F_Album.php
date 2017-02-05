<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

class F_Album extends Foundation\F_Database
{

    /**
     * Saves an album in the DB
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
            $album->get_Upload_Date(),
            $album->get_Reserved(),
            $owner);

        $album_ID = parent::insert($query, $toBind); //Inserts the album and gets its ID.
        $album->set_ID($album_ID);
    }


    /**
     * Rethrives the albums of a user by passing its username.
     *
     * @param string $username The user's username selected to get the albums from
     * @return array The user's albums
     */
    public static function get_from_user($username)
    {
        $toSearch = array("user" => $username);
        $DB_table = "album";
        $fetchAll = TRUE;
        $orderBy_column = "creation_date";
        parent::get($toSearch, $DB_table, $fetchAll, $orderBy_column);
    }


}