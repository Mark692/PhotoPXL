<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class allows to set detailed informations about photos
 */
class E_Photo
{
    private $ID;
    private $title;
    private $description;

    private $is_reserved;
    private $upload_date;
    private $categories = []; //Categorie della foto
    private $likes;
    private $comments = [];

    private $fullsize;
    private $thumbnail;
    private $size;
    private $type;


    /**
     * Instantiates a Photo object taken from the DB or just uploaded.
     * In case the Photo has just been uploaded use the short-construct in order to set:
     * - $likes = 0
     * - $up_date = time()
     *
     * @param string $title The title given by the user
     * @param string $desc The description given by the user
     * @param bool $is_Reserved Whether the photo is reserved or public
     * @param array $cat The categories of this photo
     * @param int $likes The number of like this photo earned. Leave it empty to set it to 0
     * @param int $up_Date The date of upload. Leave it empty to set it to NOW
     */
    public function __construct($title, $desc, $is_Reserved, $cat, $likes=0, $up_Date='')
    {
        $this->set_Title($title);
        $this->set_Description($desc);
        $this->set_Likes($likes);
        $this->set_Reserved($is_Reserved);
        $this->set_Categories($cat);
        $this->set_Upload_Date($up_Date);
    }


    /**
     * Sets the ID for the photo. It is the Database ID, so it should be used in __construct() only
     *
     * @param string $ID The photo ID. Rethrived from the Database.
     */
    public function set_ID($ID)
    {
        $this->ID = $ID;
    }


    /**
     * Returns the ID of this photo
     *
     * @return string The Database ID of the photo
     */
    public function get_ID()
    {
        return $this->ID;
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
        if(is_bool($is_reserved))
        {
            $this->is_reserved = $is_reserved;
        }
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
     * Sets a new title for the photo
     *
     * @param string $new_title The photo title
     */
    public function set_Title($new_title)
    {
        if($this->title_isValid($new_title))
        {
            $this->title = $new_title;
        }
    }


    /**
     * Checks whether the title is a valid entry
     *
     * @param string $title The photo title input
     * @return bool Returns TRUE if the title has only a-zA-z0-9-_. and spaces chars
     */
    private function title_isValid($title)
    {
        $allowed = array('\'', '-', '_', '.', ' ', '!', '?'); //Allows these chars inside a photo title
        if(ctype_alnum(str_replace($allowed, '', $title))) //Removes the allowed chars and checks whether the string is Alphanumeric
        {
            return TRUE;
        }
        throw new \Exceptions\input_texts(2, $title);
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
     * Sets the date in Timestamp format of the Photo's upload
     *
     * @param int The timestamp of uploading
     */
    public function set_Upload_Date($up_date = '')
    {
        if ($up_date==='' || $up_date<0)
        {
            $up_date = time();
        }
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
     * Sets the likes the Photo received
     *
     * @param array $user_list The list of users that liked the Photo
     */
    public function set_Likes($user_list)
    {
        $this->likes = $user_list;
    }


    /**
     * Retrieves the list of users that liked the Photo
     *
     * @return array The list of users that liked the Photo
     */
    public function get_Likes()
    {
        return $this->likes;
    }


    /**
     * Returns the total of likes received
     *
     * @return int The number of likes received
     */
    public function get_Total_Likes()
    {
        return count($this->likes);
    }


    /**
     * Adds a like to the current Photo
     *
     * @param string $username The user's username that likes the photo
     */
    public function add_Like($username)
    {
        array_push($this->likes, $username);
    }


    /**
     * Removes a like from the current Photo
     *
     * @param string $username The user that wants to remove the like from this photo
     */
    public function remove_Like($username)
    {
        $user_key = array_search($username, $this->likes);
            if ($user_key !== FALSE) //Exists in the "likes" array
            {
                unset($this->categories[$user_key]);
            }
        $this->likes = array_values($this->likes); //Ordinates the array without any gaps in between the keys
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
     * Sets a list of comments for this photo
     *
     * @param array $comments The list of comments for this photo
     */
    public function set_Comments($comments)
    {
        $this->comments = $comments;
    }


    /**
     * Retrieves the list of comments made for this photo
     *
     * @return array The list of comments for this photo
     */
    public function get_Comments()
    {
        return $this->comments;
    }


    /**
     * Adds a comment at the current photo
     *
     * @param string $comment The comment to add
     */
    public function add_Comment($comment)
    {
        array_push($this->comments, $comment);
    }


    /**
     * Removes a comment if exists
     *
     * @param int $comment_ID The comment's ID to remove
     */
    public function remove_Comment($comment_ID)
    {
        if(in_array($comment_ID, $this->comments))
        {
            unset($this->comments[$comment_ID]);
        }
        $this->categories = array_values($this->categories); //Ordinates the array without any gaps in between the keys
    }


    /**
     * Sets the fullsize image from the path given as parameter
     *
     * @param string $path The path to the photo
     * @throws \Exceptions\photo_details Whether the path to the photo is incorrect
     */
    public function set_Fullsize($path)
    {
        if(realpath($path)===FALSE)
        {
            throw new \Exceptions\photo_details(0, $path);
        }
        $this->fullsize = realpath($path);
    }


    /**
     * Returns the fullsize photo
     *
     * @return image The fullsize photo
     */
    public function get_Fullsize()
    {
        return $this->fullsize;
    }


    /**
     * Creates and sets a thumbnail image
     *
     * @param string $path The path to the photo
     * @throws \Exceptions\photo_details Whether the path is incorrect
     */
    public function set_Thumbnail($path)
    {
        if(realpath($path)===FALSE)
        {
            throw new \Exceptions\photo_details(1, $path);
        }
        $imagick = new \Imagick(realpath($path));
        $width = THUMBNAIL_WIDTH;
        $height = THUMBNAIL_HEIGHT;
        $best_Fit = TRUE;
        $fill = TRUE;
        $imagick->thumbnailImage($width, $height, $best_Fit, $fill);

        $this->thumbnail = $path;
    }


    /**
     * Retrieves the thumbnail created for the photo
     *
     * @return image The thumbnail of the photo
     */
    public function get_Thumbnail()
    {
        return $this->thumbnail;
    }


    /**
     * Sets the size of the photo
     *
     * @param int $size The size of the photo
     * @throws \Exceptions\photo_details Whether the size is over the maximum allowed
     */
    public function set_Size($size)
    {
        if($size>MAX_SIZE)
        {
            throw new \Exceptions\photo_details(2, $size);
        }
        $this->size = $size;
    }


    /**
     * Retrieves the size of the photo
     *
     * @return int The size of the photo
     */
    public function get_Size()
    {
        return $this->size;
    }


    /**
     * Sets the type of the photo
     *
     * @param string $type The type of the photo
     */
    public function set_Type($type)
    {
        $this->type = $type;
    }


    /**
     * Retrieves the type of the photo. To be used to show the correct HTML Header
     *
     * @return string The type of the photo
     */
    public function get_Type()
    {
        return $this->type;
    }
}
