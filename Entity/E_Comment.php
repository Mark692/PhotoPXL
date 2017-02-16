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
        if(trim($new_text)=='')
        {
            throw new \Exceptions\input_texts(3, $new_text);
        }
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
}
