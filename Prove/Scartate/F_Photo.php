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

        $photo_ID = parent::execute_Query($query, $toBind); //Inserts the photo and gets its ID.
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
        parent::execute_Query($query, $toBind);
    }


    /**
     * Retrieves the thumbnails only. Used in F_Album to get the album cover
     *
     * @param int $id The photo's ID to search
     * @return mediumblob The photo's thumbnail
     */
    public static function get_Thumbnail($id)
    {
        $select = array("thumbnail");
        $from = "photo";
        $where = array("id" => $id);
        $thumbnail_array = parent::get_One($select, $from, $where);
        return $thumbnail_array["thumbnail"];
    }


    /**
     * Retrieves the most liked photos in DESCending style
     *
     * @param int $page_toView The page selected as offset to fetch the photos
     * @return array An array with the IDs and Thumbnails of the most liked photos
     *               and the number of rows affected by the query (to be used to
     *               determine how many pages to show)
     */
    public static function get_MostLiked($page_toView=1)
    {
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT `id`, `thumbnail` '
                .'FROM `photo` '
                .'WHERE `id` in '
                .'('
                    .'SELECT `photo` '
                    .'FROM `likes` '
                    .'GROUP BY `photo` '
                    .'ORDER BY COUNT(*) '
                .') '
//                .'ORDER BY `id` DESC '
                .'LIMIT '.$limit.' '
                .'OFFSET '.$offset.' ';

        $toBind = [];
        $fetchAll = TRUE;
        $mostLiked = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "photo";
        $from = "likes";
        $where = "1";
        $tot = parent::count($count, $from, $where);
        $tot_photo = array("tot_photo" => $tot);

        return array_merge($mostLiked, $tot_photo);
    }

}