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
    private $text = '';
    private $user;
    private $photo;


    /**
     *
     * @param int $id The comment's ID
     * @param string $text The text of the comment
     * @param string $user The commenting user's username
     * @param string $photo The commented photo
     */
//    public function __construct($id, $text, $user, $photo)
//    {
//        $this->set_ID($id);
//        $this->set_Text($text);
//        $this->set_User($user);
//        $this->set_Photo($photo);
//    }

    

    /**
     * @param string $text The text of the comment
     * @param string $user The commenting user's username
     * @param string $photo The commented photo
     */
    public function __construct($text, $user, $photo)
    {
        $this->set_Text($text);
        $this->set_User($user);
        $this->set_Photo($photo);
    }


    /**
     * Sets an ID for the comment
     * @param int $id The comment's ID
     */
    public function set_ID($id)
    {
        $this->id = $id;
    }


    /**
     * Retrieves the comment ID
     * @return int The comment's ID
     */
    public function get_ID()
    {
        return $this->id;
    }


    /**
     * Sets a new text
     * @param string $new_text The text to apphend on a photo
     */
    public function set_Text($new_text)
    {
        $this->text = $new_text;
    }


    /**
     * Retrieves the text
     * @return string The comment made by a user
     */
    public function get_Text()
    {
        return $this->text;
    }


    /**
     * Sets the user that commented
     * @param string $user The user's username
     */
    public function set_User($user)
    {
        $this->user = $user;
    }


    /**
     * Retrieves the user that commented
     * @return string The user's username
     */
    public function get_User()
    {
        return $this->user;
    }


//------------------------------CONTROLLA QUESTE DUE FUNZIONI
//------------------------E COME DEVONO PRENDERE E RESTITUIRE $photo
//--------------------Tutto l'oggetto? L'ID? Cosa???????????????????????????
    /**
     * Sets the commented photo's ID
     * @param string The photo's ID
     */
    public function set_Photo($photo)
    {
        $this->photo = $photo;
    }


    /**
     * Retrieves the commented photo's ID
     * @return string The photo's ID
     */
    public function get_Photo()
    {
        return $this->photo;
    }
//------------------------------CONTROLLA QUESTE DUE FUNZIONI
//------------------------E COME DEVONO PRENDERE E RESTITUIRE $photo
//--------------------Tutto l'oggetto? L'ID? Cosa???????????????????????????

}
