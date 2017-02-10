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
            $uploader);
        $toBind = array_merge($toBind, $photo_details);

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
        return self::get($toSearch, $DB_table, $fetchAll);
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
        return self::get($toSearch, $DB_table);
    }



//____________________________________________________________________________\\
//____________________________________________________________________________\\
   //----CONTROLLA LE FUNZIONI DI F_Album PER LE CATEGORIE E----\\
  //----SE VANNO BENE, COPIALE QUI CAMBIANDO IL NOME DELLA TABELLA!!!----\\
 //
//get_By_Categories\\
//update_Categories\\
//set_Categories\\
//remove_Categories\\
//____________________________________________________________________________\\
//____________________________________________________________________________\\


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