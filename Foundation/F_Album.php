<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Entity\E_Album;
use Foundation\F_Database;
use Foundation\F_Photo;
use const NO_ALBUM_COVER;
use const PHOTOS_PER_PAGE;

class F_Album extends F_Database
{

    /**
     * Saves the album in the DB and sets its ID into the $album object
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
                .') result '
                .'SET '
                    .'`album_cover`.`cover` = result.thumbnail, '
                    .'`album_cover`.`type` = result.type '
                .'WHERE `album` = ?';
        $toBind = array($photo_ID, $album_ID);
        parent::execute_Query($query, $toBind);
    }


    /**
     * Rethrives the album IDs, Titles and Thumbnails of a user by passing its username.
     *
     * @param string $owner The user's username selected to get the albums from
     * @param int $page_toView The page number to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array The user's albums (IDs, Titles, Thumbnails) and the total of albums created.
     *               How to access to the array:
     *               - "id" => the album's ID
     *               - "title" => the album's title
     *               - "cover" => its cover
     *               - "type" => its type
     *               - "tot_album" => The number of albums matching the query
     */
    public static function get_By_User($owner, $page_toView = 1, $order_DESC = FALSE)
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

        $toBind = array($owner);
        $fetchAll = TRUE;
        $albums = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "id";
        $from = "album";
        $where = "`user`='$owner'";
        $tot = parent::count($count, $from, $where);

        return array_merge($albums, array("tot_album" => $tot));
    }


    /**
     * Rethrives an album (info, Thumbnail, owner) by passing its ID.
     *
     * @param int $id The album ID to search for
     * @return mixed A boolean FALSE if no album matches the query.
     *               An array containing the \Entity\E_Album object searched, its thumbnail and its uploader
                     How to access to the array:
     *               - "album" => the \Entity\E_Album object
     *               - "cover" => its cover
     *               - "type" => its type
     *               - "username" => The user's username that created the album
     */
    public static function get_By_ID($id)
    {
        //Retrieves album details and its Thumbnail
        $query = 'SELECT album.title, album.description, album.creation_date, album.user, album_cover.cover, album_cover.type '
                .'FROM `album` '
                    .'INNER JOIN `album_cover` '
                    .'ON album.id=album_cover.album '
                .'WHERE album.id = ?';

        $toBind = array($id);
        $album = parent::fetch_Result($query, $toBind);

        if($album === FALSE) //Only in case no album has the given ID
        {
            return FALSE;
        }

        //Retrieves the categories
        $cats = self::get_Categories($id);

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
            "type" => $album["type"],
            "username" => $album["user"]
            );
    }


    /**
     * Rethrives all the album with the selected categories
     *
     * @param array $cats The categories to search
     * @param int $page_toView The number of page to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with the albums matching the categories selected.
     *               How to access to the array:
     *               - "id" => the album's ID
     *               - "title" => the album's title
     *               - "cover" => its cover
     *               - "type" => its type
     *               - "tot_album" => The number of albums matching the query
     */
    public static function get_By_Categories($cats, $page_toView = 1, $order_DESC = FALSE)
    {
        $where = '(';
        //Alternate $where = `category` IN ( foreach($cats as $c) );
        for($i=0; $i<count($cats); $i++)
        {
            $where .= '(`category`=?) OR ';
        }
        $where = substr($where, 0, -4).') '; //Removes the " OR " and adds a ') '
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

        $fetchAll = TRUE;
        $toBind = $cats;
        $albums = parent::fetch_Result($query, $toBind, $fetchAll);

        $count = "album";
        $from = "cat_album";
        $tot = parent::count($count, $from, $where, $toBind);

        return array_merge($albums, array("tot_album" => $tot));
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
            $toBind = array_values($to_add);
            if($query_DEL!=='')
            {
                foreach($to_remove as $c)
                {
                    array_push($toBind, $c);
                }
            }
            parent::execute_Query($query, $toBind);
        }
        elseif($query_DEL!=='')
        {
            $toBind = array_values($to_remove);
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
        foreach($cats_array as $c)
        {
            array_push($cats, intval($c["category"]));
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


    /**
     * Checks whether the user is the creator of the album.
     * This will enable/disable the update for the album
     *
     * @param string $username The user to check with the album's creator
     * @param int $album_ID The album's ID to get the creator from
     * @return boolean Whether the user is the creator of the album
     */
    public static function is_TheCreator($username, $album_ID)
    {
        $select = array("user");
        $from = "album";
        $where = array("id" => $album_ID);
        $uploader = parent::get_One($select, $from, $where);
        if($username === $uploader["user"])
        {
            return TRUE;
        }
        return FALSE;
    }
}