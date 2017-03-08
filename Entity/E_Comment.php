<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class represents the comments that users can write on photos
 */
class E_Comment
{
    private $id;
    private $text;
    private $user;
    private $photo;


    /**
     * Instantiates a new comment.
     * The comment's ID will be set by Foundation\F_Comment based on the DB's ID
     *
     * @param string $text The text of the comment
     * @param string $user_ID The commenting user's username
     * @param int $photo_ID The commented photo's ID
     */
    public function __construct($text, $user_ID, $photo_ID)
    {
        if(trim($text) == ''
            && ($this->check_Text($text) === FALSE))
        {
            throw new \Exceptions\input_texts(3, $text);
        }
        $this->set_Text($text);
        $this->set_User($user_ID);
        $this->set_PhotoID($photo_ID);
    }


    /**
     * Sets the ID for the comment
     *
     * @param int $id The comment's ID
     */
    public function set_ID($id)
    {
        $this->id = $id;
    }


    /**
     * Retrieves the comment ID
     *
     * @return int The comment's ID
     */
    public function get_ID()
    {
        return $this->id;
    }


    /**
     * Sets a new text
     *
     * @param string $new_text The text to apphend on a photo
     */
    public function set_Text($new_text)
    {
        $this->text = $new_text;
    }


    /**
     * Retrieves the text
     *
     * @return string The comment made by a user
     */
    public function get_Text()
    {
        return $this->text;
    }


    /**
     * Used to check whether the input comment uses UTF-8 chars
     *
     * @param string $text The text to evaluate
     * @return bool Whether the comment uses UTF-8 chars only and is less than 2000 chars
     */
    private function check_Text($text)
    {
        if(strlen($text)<=MAX_COMMENT_CHARS)
        {
            return mb_check_encoding($text, 'UTF-8');
        }
        return FALSE;
    }


    /**
     * Sets the user that commented
     *
     * @param string $user The user's username
     */
    public function set_User($user)
    {
        $this->user = $user;
    }


    /**
     * Retrieves the user that commented
     *
     * @return string The user's username
     */
    public function get_User()
    {
        return $this->user;
    }


    /**
     * Sets the commented photo's ID
     *
     * @param int The photo's ID
     */
    public function set_PhotoID($photo_ID)
    {
        $this->photo= $photo_ID;
    }


    /**
     * Retrieves the commented photo's ID
     *
     * @return int The photo's ID
     */
    public function get_PhotoID()
    {
        return $this->photo;
    }



    //---ENTITY -> FOUNDATION---\\


    /**
     * Saves a comment in the DB
     *
     * @param \Entity\E_Comment $comment The comment to save
     */
    public static function insert(\Entity\E_Comment $comment)
    {
        \Foundation\F_Comment::insert($comment);
    }


    /**
     * Rethrives the comments posted on a photo passing its ID.
     * The output will be in ASCendent order = from the first comment made to
     * the latest one.
     *
     * @param int $photo_ID The photo's ID selected to get the comments from
     * @return array The comments made for the photo
     */
    public static function get_By_Photo($photo_ID)
    {
        return \Foundation\F_Comment::get_By_Photo($photo_ID);
    }


    /**
     * Deletes a comment
     *
     * @param int $comment_ID The ID of the comment to remove
     */
    public static function remove($comment_ID)
    {
        \Foundation\F_Comment::remove($comment_ID);
    }
}
