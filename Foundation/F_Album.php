<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Entity\E_Album;
use Entity\E_Photo_Blob;
use Foundation\F_Database;
use Foundation\F_Photo;

class F_Album extends F_Database
{

    /**
     * Saves the album in the DB
     *
     * @param E_Album $album The album to save
     * @param string $owner The $owner's username
     */
    public static function insert(E_Album $album, $owner)
    {
        //Insert all album details but the categories
        $insertInto = "album";

        $set = array(
            "title" => $album->get_Title(),
            "description" => $album->get_Description(),
            "creation_date" => $album->get_Creation_Date(),
            "user" => $owner
                );

        $album_ID = parent::insert_Query($insertInto, $set);
        $album->set_ID($album_ID);

        //Inserts categories
        $cats = $album->get_Categories();
        if($cats!==[])
        {
            $query = self::query_addCats($cats, $album_ID);
            parent::execute_Query($query, $cats);
        }

        //Sets a basic cover for the album
        self::insert_DefaultCover($album_ID);
    }


    /**
     * Sets a default album cover
     *
     * @param int $album_ID The album ID to set the cover to
     */
    private static function insert_DefaultCover($album_ID)
    {
        $query = 'INSERT INTO `album_cover` (`album`, `cover`, `type` ) '
                    .'SELECT ?, `thumbnail`, `type` '
                    .'FROM `photo` '
                    .'WHERE `id` = '.NO_ALBUM_COVER.' ';
        $toBind = array($album_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Updates the album details
     *
     * @param E_Album $to_Update The new Album object to save
     */
    public static function update_Details(E_Album $to_Update)
    {
        $id = $to_Update->get_ID();
        $update = "album";
        $set = array(
            "title" => $to_Update->get_Title(),
            "description" => $to_Update->get_Description(),
            "creation_date" => $to_Update->get_Creation_Date()
                );
        $where = array("id" => $id);
        parent::update($update, $set, $where);

        $cats = $to_Update->get_Categories();
        self::update_Categories($cats, $id);
    }


    /**
     * Updates the album cover with an existing photo
     *
     * @param int $album_ID The album ID to update
     * @param int $photo_ID The new cover chosen for the album
     */
    public static function set_Cover($album_ID, $photo_ID)
    {
        $query = 'UPDATE `album_cover`, '
                .'('
                    .'SELECT * '
                    .'FROM `photo` '
                    .'WHERE `id` = ?'
                .') photo '
                .'SET '
                    .'`cover` = photo.thumbnail '
                    .'`type` = photo.type '
                .'WHERE `album` = ?';
        $toBind = array($photo_ID, $album_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Updates the album cover by uploading a new photo to be used ONLY as cover
     *
     * @param int $album_ID The album ID to update
     * @param int $blob The new cover to upload for the album
     */
    public static function upload_NewCover($album_ID, E_Photo_Blob $blob)
    {
        $update = "album_cover";
        $set = array("cover" => $blob->get_Thumbnail(),
                     "type" => $blob->get_Type());
        $where = array("album" => $album_ID);
        parent::update($update, $set, $where);
    }


    /**
     * Rethrives the album IDs, Titles and Thumbnails of a user by passing its username.
     *
     * @param string $username The user's username selected to get the albums from
     * @param int $page_toView The page number to view. It influences the offset
     * @param $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array The user's albums (IDs, Titles, Thumbnails) and the total of albums created
     */
    public static function get_By_User($username, $page_toView = 1, $order_DESC = FALSE)
    {
        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT album.id, album.title, album_cover.cover, album_cover.type '
                .'FROM `album_cover` '
                    .'INNER JOIN `album` '
                    .'ON album_cover.album=album.id '
                .'WHERE album.id IN '
                .'('
                    .'SELECT album.id '
                    .'FROM `album` '
                    .'WHERE album.user=? '
                .') ';
        if($order_DESC===TRUE)
        {
            $query .= 'ORDER BY album.id DESC ';
        }
        $query .= 'LIMIT '.$limit.' '
                 .'OFFSET '.$offset;

        $toBind = array($username);
        $fetchAll = TRUE;
        $albums = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "id";
        $from = "album";
        $where = "`user`='$username'";
        $tot = parent::count($count, $from, $where);
        $tot_photo = array("tot_album" => $tot);

        return array_merge($albums, $tot_photo);
    }


    /**
     * Rethrives an album (info, Thumbnail, owner) by passing its ID.
     *
     * @param int $id The album ID to search for
     * @return array The \Entity\E_Album object searched, its thumbnail and its uploader
     */
    public static function get_By_ID($id)
    {
        //Retrieves album details and its Thumbnail
        $query = 'SELECT album.id, album.title, album.description, album.creation_date, album.user, album_cover.cover, album_cover.type '
                .'FROM `album` '
                    .'INNER JOIN `album_cover` '
                    .'ON album.id=album_cover.album '
                .'WHERE album.id = ?';

        $toBind = array($id);
        $album = parent::fetch_Result($query, $toBind);
        if($album === FALSE) //Only in case no album has the given ID
        {
            return [];
        }

        //Retrieves the categories
        $array_categories = self::get_Categories($id);
        $cats = [];
        foreach(array_values($array_categories) as $c)
        {
            array_push($cats, intval($c));
        }

        $e_album = new E_Album(
                $album["title"],
                $album["description"],
                $cats,
                $album["creation_date"]
                );
        $e_album->set_ID($id);

        return array(
            "album" => $e_album,
            "cover" => $album["cover"],
            "username" => $album["user"]
            );
    }


    /**
     * Rethrives all the album with the selected categories
     *
     * @param array $cats The categories to search
     * @param int $page_toView The number of page to view. It influences the offset
     * @param $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with the albums matching the categories selected.
     */
    public static function get_By_Categories($cats, $page_toView = 1, $order_DESC = FALSE)
    {
        $where = '';
        //Alternate $where = `category` IN ( foreach($cats as $c) );
        for($i=0; $i<count($cats); $i++)
        {
            $where .= '(`category`=?) OR ';
        }
        $where = substr($where, 0, -4); //Removes the " OR " at the end of the string


        $limit = PHOTOS_PER_PAGE;
        $offset = PHOTOS_PER_PAGE * ($page_toView - 1);

        $query = 'SELECT DISTINCT album.id, album.title, album_cover.cover, album_cover.type '
                .'FROM `album` '
                    .'INNER JOIN `album_cover` '
                    .'ON album.id=album_cover.album '
                .'WHERE album.id IN '
                .'('
                    .'SELECT DISTINCT cat_album.album '
                    .'FROM `cat_album` '
                    .'WHERE '.$where.' '
                .') ';
        if($order_DESC===TRUE)
        {
            $query .= 'ORDER BY album.id DESC ';
        }
        $query .= 'LIMIT '.$limit.' '
                 .'OFFSET '.$offset;

        echo($query.nl2br("\r\n"));

        $fetchAll = TRUE;
        $toBind = $cats;
        $albums = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "album";
        $from = "cat_album";
        $tot = parent::count($count, $from, $where, $toBind);
        $tot_photo = array("tot_album" => $tot);

        return array_merge($albums, $tot_photo);
    }


    /**
     * Updates the categories of an album. This function both add new categories
     * and remove old categories (if selected) from the album
     *
     * @param array $new_cats The new categories chosen for the album
     * @param int $album_ID The album's ID to whom set/remove the categories
     */
    private static function update_Categories($new_cats, $album_ID)
    {
        $old_cats = self::get_Categories($album_ID); //$old will be an associative array

        $to_add    = array_diff($new_cats, $old_cats);
        $to_remove = array_diff($old_cats, $new_cats);

        $query_ADD = self::query_addCats($to_add, $album_ID);
        $query_DEL = self::query_removeCats($to_remove, $album_ID);
        $query = $query_ADD.$query_DEL;

        if($query_ADD!=='')
        {
            $toBind = $to_add;
            if($query_DEL!=='')
            {
                array_push($toBind, $to_remove);
            }
            parent::execute_Query($query, $toBind);
        }
        elseif($query_DEL!=='')
        {
            echo("3 :(");
            $toBind = $to_remove;
            parent::execute_Query($query, $toBind);
        }
    }


    /**
     * Sets the album categories
     *
     * @param array $cats The categories chosen for the album
     * @param int $album_ID The album's ID to whom set the categories
     * @return string The query used to add categories to the album
     */
    private static function query_addCats($cats, $album_ID)
    {
        $tot_cats = count($cats);
        if($tot_cats===0)
        {
            return '';
        }
        $query = "INSERT INTO `cat_album` (`album`, `category`) "
                . "VALUES ";
        for($i=0; $i<$tot_cats; $i++)
        {
            $query .= "('$album_ID', ?),";
        }
        return substr($query, 0, -1).";"; //Trims the last "," and places a ";"
    }


    /**
     * Removes the selected categories from the album
     *
     * @param array $cats The category/ies to remove from the album selected
     * @param int $album_ID The album to modify and remove categories from
     * @return string The query used to remove categories from the album
     */
    private static function query_removeCats($cats, $album_ID)
    {
        $tot_cats = count($cats);
        if($tot_cats===0)
        {
            return '';
        }
        $query = "DELETE FROM `cat_album` "
                ."WHERE (`album`=$album_ID) "
                ."AND (";
        for($i=0; $i<$tot_cats; $i++)
        {
            $query .= "(`category`=?) OR ";
        }
        return substr($query, 0, -4).")"; //Trims the last " OR " and closes the paranthesys
    }


    /**
     * Retrieves the album's categories
     *
     * @param int $album_ID The album ID to look for categories
     * @return array The album's categories
     */
    private static function get_Categories($album_ID)
    {
        $select = array("category");
        $from = "cat_album";
        $where = array("album" => $album_ID);
        $cats_array = parent::get_All($select, $from, $where);

        $cats=[];
        foreach(array_values($cats_array) as $c)
        {
            array_push($cats, intval($c));
        }
        return $cats;
    }


    /**
     * Deletes an album from the DB.
     * Its photos will be kept with no album association
     * To delete all photos from an album use F_Photo::delete_ALL_fromAlbum()
     * To delete an album and all its photos use F_Album::delete_Album_AND_Photos()
     *
     * @param int $album_ID The album ID to delete from the DB
     */
    public static function delete($album_ID)
    {
        $query = "DELETE FROM `album` "
                ."WHERE (`id`=?) ";

        $toBind = array("id" => $album_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Deletes an album and all its photos
     *
     * @param int $album_ID The album to delete with all its associated photos
     */
    public static function delete_Album_AND_Photos($album_ID)
    {
        F_Photo::delete_ALL_fromAlbum($album_ID);
        self::delete($album_ID);
    }
}