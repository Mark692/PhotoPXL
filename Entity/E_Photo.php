<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Exceptions\input_texts;
use Foundation\F_Photo;
use const MAX_DESCRIPTION_CHARS;
use const MAX_TITLE_CHARS;
use const MIN_TITLE_CHARS;

/**
 * This class allows to set detailed informations about photos
 */
class E_Photo
{
    private $ID;
    private $title;
    private $description;
    private $is_reserved;
    private $categories = [];
    private $upload_date;
    private $likes = [];
    private $comments = [];


    /**
     * Instantiates a Photo object taken from the DB or just uploaded.
     * In case the Photo has just been uploaded use the short-construct in order to set:
     * - $likes = 0
     * - $up_date = time()
     *
     * @param string $title The title given by the user
     * @param string $desc The description given by the user
     * @param bool $is_reserved Whether the photo is reserved or public
     * @param array $cat The categories of this photo
     * @param array $likes The list of users that liked the photo
     * @param int $up_Date The date of upload. Leave it empty to set it to NOW
     */
    public function __construct($title, $desc = '', $is_reserved = FALSE, $cat = [], $up_Date = 0, $likes = [], $comments = [])
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


        if($this->check_Categories($cat) === FALSE)
        {
            throw new input_texts(4, $desc);
        }
        $this->set_Categories($cat);


        $date = $this->set_TrueUploadDate($up_Date);
        $this->set_Upload_Date($date);


        $this->set_Reserved($is_reserved);
        $this->set_LikesList($likes);
        $this->set_Comments($comments);
    }


    /**
     * Sets the ID for the photo. It is the Database ID, so it should be used in __construct() only
     *
     * @param int $ID The photo ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Returns the ID of this photo
     *
     * @return int The Database ID of the photo
     */
    public function get_ID()
    {
        return $this->ID;
    }


    /**
     * Sets a new title for the photo
     *
     * @param string $new_title The photo title
     */
    public function set_Title($new_title)
    {
        $this->title = $new_title;
    }


    /**
     * Retrieves the title of the Photo
     *
     * @return string The photo's title
     */
    public function get_Title()
    {
        return $this->title;
    }


    /**
     * Checks whether the title is a valid entry
     *
     * @param string $title The photo title input
     * @return bool Whether the title has only a-zA-Z0-9, the $allowed chars and a length of [3, 30] chars
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
     * Sets a new description for the Photo
     *
     * @param string The description for the photo
     */
    public function set_Description($new_description)
    {
        $this->description = $new_description;
    }


    /**
     * Retrieves the description of the Photo
     *
     * @return string This photo's description
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
     * Sets the Photo privacy as
     * - Reserved (TRUE): only certain users will be able to see the photo
     * - Public  (FALSE): ALL users will be able to see the photo
     *
     * @param bool $is_reserved The new Photo privacy
     */
    public function set_Reserved($is_reserved)
    {
        $this->is_reserved = $is_reserved;
    }


    /**
     * Retrieves the visibility of the Photo
     *
     * @return bool Retrieves the visibility of the Photo
     */
    public function get_Reserved()
    {
        return $this->is_reserved;
    }


    /**
     * Sets the date in Timestamp format of the Photo's upload
     *
     * @param int $up_date The timestamp of uploading
     */
    private function set_Upload_Date($up_date)
    {
        $this->upload_date = $up_date;
    }


    /**
     * Retrieves the timestamp of this Photo's upload
     *
     * @return int The timestamp of this Photo's upload
     */
    public function get_Upload_Date()
    {
        return $this->upload_date;
    }


    /**
     * Used to check whether the creation date is correct
     *
     * @param int $date The creation date
     * @return int The correct date of creation
     */
    private function set_TrueUploadDate($date)
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


    /**
     * Sets an array of categories for the Photo
     *
     * @param array $cat The array of categories to set for the photo
     */
    public function set_Categories($cat)
    {
        $this->categories = $cat;
    }


    /**
     * Retrives the categories array
     *
     * @return array The array of this photo's categories
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
        foreach($cats as $c)
        {
            if($c < PAESAGGI || $c > SPORT)
            {
                return FALSE;
            }
        }
        return TRUE;
    }


    /**
     * Sets the number of likes received
     *
     * @param array $total_likes The number of likes received on this photo
     */
    public function set_LikesList($total_likes)
    {
        $this->likes = $total_likes;
    }


    /**
     * Retrieves the list of users that liked the photo
     *
     * @return array The list of users that liked the photo
     */
    public function get_LikesList()
    {
        return $this->likes;
    }


    /**
     * Retrieves the number of likes received
     *
     * @return int The number of likes received
     */
    public function get_NLikes()
    {
        return count($this->likes);
    }


    /**
     * Sets the list of users that commented the photo
     *
     * @param array $comments The list of users that commented the photo
     */
    public function set_Comments($comments)
    {
        $this->comments = $comments;
    }


    /**
     * Retrieves the list of users that commented the photo
     *
     * @return int The list of users that commented the photo
     */
    public function get_CommentsList()
    {
        return $this->comments;
    }


    /**
     * Retrieves the number of comments for this photo
     *
     * @return int The number of comments for this photo
     */
    public function get_NComments()
    {
        return count($this->comments);
    }



    //---ENTITY -> FOUNDATION---\\


    /**
     * Saves a photo object and sets its ID into the $photo object
     *
     * @param E_Photo $photo The photo to save
     * @param E_Photo_Blob $photo_details The blob file, its size and type
     * @param string $uploader The uploader's username
     */
    public static function insert(E_Photo $photo, E_Photo_Blob $photo_details, $uploader)
    {
        F_Photo::insert($photo, $photo_details, $uploader);
    }


    /**
     * Updates a record from the "photo" table
     *
     * @param E_Photo $to_Update The photo to update
     */
    public static function update(E_Photo $to_Update)
    {
        F_Photo::update($to_Update);
    }


    /**
     * Rethrives all the IDs and thumbnails of a user photos by passing its username
     *
     * @param string $uploader The user's username selected to get the photos from
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The watching user's role
     * @param int $page_toView The page number to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array The user's photos
     */
    public static function get_By_User($uploader, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
    {
        return F_Photo::get_By_User($uploader, $user_Watching, $user_Role, $page_toView, $order_DESC);
    }


    /**
     * Rethrives the photo corresponding to the ID selected
     *
     * @param int $id The photo's ID
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The user role
     * @return mixed An array containing the \Entity\E_Photo object photo, its uploader, fullsize and type
     *               A boolean FALSE if no photo matches the query
     */
    public static function get_By_ID($id, $user_Watching, $user_Role)
    {
        return F_Photo::get_By_ID($id, $user_Watching, $user_Role);
    }


    /**
     * Retrieves the IDs and thumbnails of the photos belonging to a specific album.
     * The fetched photos are always the public ones but can also be the private
     * ones if the user watching is the Uploader or a MOD/Admin
     *
     * @param int $album_ID The album ID of which get the photos from
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The user role
     * @param int $page_toView The page number to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with photo IDs and thumbnails
     */
    public static function get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
    {
        return F_Photo::get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView, $order_DESC);
    }


    /**
     * Rethrives all the photos with the selected categories
     *
     * @param array $cats The categories to search
     * @param string $user_Watching The user trying to look at the photo
     * @param enum $user_Role The user role
     * @param int $page_toView The number of page to view. It influences the offset
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array An array with the photos matching the categories selected.
     */
    public static function get_By_Categories($cats, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
    {
        return F_Photo::get_By_Categories($cats, $user_Watching, $user_Role, $page_toView, $order_DESC);
    }


    /**
     * Retrieves the list of all users that liked the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return array The users that liked the selected photo
     */
    public static function get_DB_LikeList($photo_ID)
    {
        return F_Photo::get_LikeList($photo_ID);
    }


    /**
     * Retrieves the most liked photos in DESCending style
     *
     * @param int $page_toView The page selected as offset to fetch the photos
     * @return array An array with the IDs and Thumbnails of the most liked photos
     *               and the number of rows affected by the query (to be used to
     *               determine how many pages to show)
     */
    public static function get_MostLiked($user_Watching, $user_Role, $page_toView = 1)
    {
        return F_Photo::get_MostLiked($user_Watching, $user_Role, $page_toView);
    }


    /**
     * Retrieves the list of all users that commented the selected photo
     *
     * @param int $photo_ID The photo's ID
     * @return array The users that commented the selected photo
     */
    public static function get_DB_CommentsList($photo_ID)
    {
        return F_Photo::get_UsernamesThatCommented($photo_ID);
    }


    /**
     * Deletes a photo from the DB including its likes and comments
     *
     * @param int $photo_ID The photo ID to delete from the DB
     */
    public static function delete($photo_ID)
    {
        F_Photo::delete($photo_ID);
    }


    /**
     * Deletes all photos within an album including their likes and comments
     *
     * @param int $album_ID The album from which we want to delete photos
     */
    public static function delete_ALL_fromAlbum($album_ID)
    {
        F_Photo::delete_ALL_fromAlbum($album_ID);
    }


    /**
     * Moves a photo to another album.
     * Use $album='' to move the photo out of the album
     *
     * @param int $photo_ID The photo to move
     * @param int $album_ID The new album ID to move to photo to
     */
    public static function move_To($photo_ID, $album_ID = '')
    {
        F_Photo::move_To($photo_ID, $album_ID);
    }


    /**
     * Checks whether the user is the uploader of the photo.
     * This will enable/disable the update for the photo
     *
     * @param string $username The user to check with the photo's uploader
     * @param int $photo_ID The photo's ID to get the uploader from
     * @return boolean Whether the user is the uploader
     */
    public static function is_TheUploader($username, $photo_ID)
    {
        return F_Photo::is_TheUploader($username, $photo_ID);
    }
}
