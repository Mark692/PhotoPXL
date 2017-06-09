<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Exceptions\input_texts;
use Foundation\F_Album;
use const MAX_DESCRIPTION_CHARS;
use const MAX_TITLE_CHARS;
use const MIN_TITLE_CHARS;

/**
 * This class allows the creation of photo albums.
 */
class E_Album
{
    private $ID;
    private $title;
    private $description;
    private $categories = [];
    private $creation_date;


    /**
     * Instantiates an Album object taken from the DB or just uploaded.
     * In case the Album has just been created use the short-construct in order
     * to set the $up_date to NOW automatically.
     *
     * @param string $title The  title of the album
     * @param string $desc The description of the album
     * @param array $categories The categories array of the album
     * @param int $creation_date The creation date of the album
     */
    public function __construct($title, $desc='', $categories=[], $creation_date = 0)
    {
        if($this->check_Title($title) === FALSE)
        {
            throw new input_texts(2, $title);
        }
        $this->set_Title($title);


        if($desc !== '' && $this->check_Description($desc) === FALSE)
        {
            throw new input_texts(3, $desc);
        }
        $this->set_Description($desc);


        if(self::check_Categories($categories) === FALSE)
        {
            throw new input_texts(4, $categories);
        }
        $this->set_Categories($categories);

        $date = $this->check_Creation_Date($creation_date);
        $this->set_Creation_Date($date);
    }


    /**
     * Sets the ID for the album. It is the Database ID, so it should be used in __construct() only
     *
     * @param int $ID The album ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Returns the ID of this album
     *
     * @return int The Database ID of the album
     */
    public function get_ID()
    {
        return $this->ID;
    }


    /**
     * Sets a new title for the Album
     *
     * @param string $new_title The album title
     */
    public function set_Title($new_title)
    {
        $this->title = $new_title;
    }


    /**
     * Checks whether the title is a valid entry
     *
     * @param string $title The title input
     * @throws input_texts Whether the title contains invalid chars
     * @return bool Whether the title has only a-zA-z0-9, the $allowed chars and a length of [3, 30] chars
     */
    private function check_Title($title)
    {
        if(strlen($title)>=MIN_TITLE_CHARS
                && strlen($title)<=MAX_TITLE_CHARS)
        {
            $allowed = array('\'', '-', '_', '.', ' ', '!', '?'); //Allows these chars inside an album title
            if(ctype_alnum(str_replace($allowed, '', $title))) //Removes the allowed chars and checks whether the string is Alphanumeric
            {
                return TRUE;
            }
        }
        return FALSE;
    }


    /**
     * Retrieves the title of the Album
     *
     * @return string The album title
     */
    public function get_Title()
    {
        return $this->title;
    }


    /**
     * Sets a new description for the Album
     *
     * @param string $new_description Sets a new description for this album
     */
    public function set_Description($new_description)
    {
        $this->description = $new_description;
    }


    /**
     * Retrieves the description of the Album
     *
     * @return string This album's description
     */
    public function get_Description()
    {
        return $this->description;
    }


    /**
     * Used to check whether the input description uses UTF-8 chars
     *
     * @param string $desc The description to evaluate
     * @return bool Whether the description uses UTF-8 chars only and has less than 500 chars
     */
    private function check_Description($desc)
    {
        if(strlen($desc)<=MAX_DESCRIPTION_CHARS)
        {
            return mb_check_encoding($desc, 'UTF-8');
        }
        return FALSE;
    }


    /**
     * Sets an array of categories for the Album
     *
     * @param array $cat The array of categories to set for the album
     */
    public function set_Categories($cat)
    {
        $this->categories = array_unique($cat);
    }


    /**
     * Retrives the categories array for this album
     *
     * @return array The list of categories for the Album
     */
    public function get_Categories()
    {
        return $this->categories;
    }


    /**
     * Used to check whether the input categories are all valid entry
     *
     * @param array $cats The categories to evaluate
     * @return bool Whether the categories are all valid entry
     */
    public static function check_Categories($cats)
    {
        $constants = new \ReflectionClass('\Utilities\Categories');
        $allowed = $constants->getConstants();
        foreach($cats as $c)
        {
            if(!in_array($c, $allowed, TRUE))
            {
                return FALSE;
            }
        }
        return TRUE;
    }


    /**
     * Sets a creation date for the Album
     *
     * @param int $date The timestamp of the Album's creation
     */
    private function set_Creation_Date($date)
    {
            $this->creation_date = $date;
    }


    /**
     * Retrieves the Timestamp of album's creation date
     *
     * @return int The timestamp of the Album's creation
     */
    public function get_Creation_Date()
    {
        return $this->creation_date;
    }


    /**
     * Used to check whether the creation date is correct
     *
     * @param int $date The creation date
     * @return int The date of creation
     */
    private function check_Creation_Date($date)
    {
        if ($date <= 0)
        {
            return time();
        }
        else
        {
            return $date;
        }
    }




    //---ENTITY -> FOUNDATION---\\


    /**
     * Saves the album in the DB and sets its ID into the $album object
     *
     * @param E_Album $album The album to save
     * @param string $owner The $owner's username
     * @throws queries In case of connection errors
     */
    public static function insert(E_Album $album, $owner)
    {
        F_Album::insert($album, $owner);
    }


    /**
     * Updates the album details
     *
     * @param E_Album $to_Update The new Album object to save
     * @throws queries In case of connection errors
     */
    public static function update_Details(E_Album $to_Update)
    {
        F_Album::update_Details($to_Update);
    }


    /**
     * Updates the album cover with an existing photo
     *
     * @param int $album_ID The album ID to update
     * @param int $photo_ID The new cover chosen for the album
     * @throws queries In case of connection errors
     */
    public static function set_Cover($album_ID, $photo_ID)
    {
        F_Album::set_Cover($album_ID, $photo_ID);
    }


    /**
     * Rethrives the album IDs, Titles and Thumbnails of a user by passing its username.
     *
     * @param string $username The user's username selected to get the albums from
     * @param int $page_toView The page number to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @throws queries In case of connection errors
     * @return array The user's albums (IDs, Titles, Thumbnails) and the total of albums created.
     *               How to access to the array:
     *               - "id" => the album's ID
     *               - "title" => the album's title
     *               - "cover" => its cover
     *               - "type" => its type
     *               - "tot_album" => The number of albums matching the query
     */
    public static function get_By_User($username, $page_toView=1, $order_DESC=FALSE)
    {
        return F_Album::get_By_User($username, $page_toView=1, $order_DESC=FALSE);
    }


    /**
     * Rethrives an album (info, Thumbnail, owner) by passing its ID.
     *
     * @param int $id The album ID to search for
     * @throws queries In case of connection errors
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
        return F_Album::get_By_ID($id);
    }


    /**
     * Rethrives all the album with the selected categories
     *
     * @param array $cats The categories to search
     * @param int $page_toView The number of page to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @throws queries In case of connection errors
     * @return array An array with the albums matching the categories selected.
     *               How to access to the array:
     *               - "id" => the album's ID
     *               - "title" => the album's title
     *               - "cover" => its cover
     *               - "type" => its type
     *               - "tot_album" => The number of albums matching the query
     */
    public static function get_By_Categories($cats, $page_toView=1, $order_DESC=FALSE)
    {
        return F_Album::get_By_Categories($cats, $page_toView=1, $order_DESC=FALSE);
    }


    /**
     * Deletes an album from the DB.
     * Its photos will be kept with no album association
     * To delete all photos from an album use F_Photo::delete_ALL_fromAlbum()
     * To delete an album and all its photos use F_Album::delete_Album_AND_Photos()
     *
     * @param int $album_ID The album ID to delete from the DB
     * @throws queries In case of connection errors
     */
    public static function delete($album_ID)
    {
        F_Album::delete($album_ID);
    }


    /**
     * Deletes an album and all its photos
     *
     * @param int $album_ID The album to delete with all its associated photos
     * @throws queries In case of connection errors
     */
    public static function delete_Album_AND_Photos($album_ID)
    {
        F_Album::delete_Album_AND_Photos($album_ID);
    }


    /**
     * Checks whether the user is the creator of the album.
     * This will enable/disable the update for the album
     *
     * @param string $username The user to check with the album's creator
     * @param int $album_ID The album's ID to get the creator from
     * @throws queries In case of connection errors
     * @return boolean Whether the user is the creator of the album
     */
    public static function is_TheCreator($username, $album_ID)
    {
        return F_Album::is_TheCreator($username, $album_ID);
    }
}