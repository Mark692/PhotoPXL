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
     * Saves a photo in the DB
     *
     * @param \Entity\E_Photo $photo The photo to save
     * @param string $uploader The uploader's username
     */
    public static function execute_query(\Entity\E_Photo $photo, $uploader)
    {
        $query = 'INSERT INTO `photo` SET '
                .'`title`=?, '
                .'`description`=?, '
                .'`upload_date`=?, '
                .'`is_reserved`=?, '
                .'`user`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $photo->get_Title(),
            $photo->get_Description(),
            $photo->get_Upload_Date(),
            $photo->get_Reserved(),
            $uploader);

        $photo_ID = parent::execute_query($query, $toBind); //Inserts the photo and gets its ID.
        $photo->set_ID($photo_ID);
    }


    /**
     * Rethrives photos matching the query
     *
     * @param array $toSearch The values to search with the query
     * @return array The photos matching the query
     */
    public static function get($toSearch, $fetchAll=FALSE, $orderBy_column='', $orderStyle="ASC")
    {
        $DB_table = "photo";
        return parent::get($toSearch, $DB_table, $fetchAll, $orderBy_column, $orderStyle);
    }


    /**
     * Rethrives the photos of a user by passing its username.
     * This is a faster way (than the self::get()) to search all the photos bound to the same $username
     *
     * @param string $username The user's username selected to get the photos from
     * @return array The user's photos
     */
    public static function get_from_user($username)
    {
        $toSearch = array("user" => $username);
        $fetchAll = TRUE;
        $orderBy_column = "upload_date";
        return self::get($toSearch, $fetchAll, $orderBy_column);
    }


//    public static function get_PROVA()
//    {
//        $toSearch = array("id" => 8); //Prende la foto con ID 8
//        $DB_table = "photo_blob";
//        return parent::get($toSearch, $DB_table);
//    }


    //CREA FUNZIONI PER:
    //get_from_Album() - dalla foto-album
    //get_byCategory() - dalla cat-foto
    //remove_photo() - ricorda la tabella di collegamento foto-album
    //update_photo()
    //move_to() - cambia in foto-album
    //update_categories - nella tabella cat-foto
}