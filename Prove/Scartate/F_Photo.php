<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Photo extends \Foundation\F_Database
{
    /**
     * Saves a photo object in the DB.
     * To save the blob file and its details use the "upload()" function!
     *
     * @param \Entity\E_Photo $photo The photo to save
     * @param string $uploader The uploader's username
     */
    public static function insert(\Entity\E_Photo $photo, $uploader)
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
     * Enables the upload of the blob photo file and its details: size, type
     *
     * @param int $photo_ID The photo's ID
     * @param array $photo_details The blob file, its size and type
     */
    public static function upload($photo_ID, $photo_details)
    {
        $query = 'INSERT INTO `photo_blob` SET '
                .'`id`=?, '
                .'`blob`=?, '
                .'`size`=?, '
                .'`type`=?';

        $toBind = array_merge($photo_ID, $photo_details);
        parent::execute_query($query, $toBind);
    }

}