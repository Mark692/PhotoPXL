<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Comment
{
    private $text = '';
    private $photo;
    private $user;
    private $id;
    

    /**
     *
     * @param string $text The user comment
     */
    public function __construct($text, $user, $photo)
    {
        $this->set_text($text);
        $this->user = $user;
        $this->photo = $photo;
    }


    /**
     * Sets a new text
     * @param string
     */
    public function set_text($new_text)
    {
        $this->text = $new_text;
    }


    /**
     * Retrieves the text
     * @return string
     */
    public function get_text()
    {
        return $this->text;
    }


    /**
     * Sets the user that commented
     * @param string $user The user's username
     */
    public function set_user($user)
    {
        $this->user = $user;
    }


    /**
     * Retrieves the user that commented
     * @return string The user's username
     */
    public function get_user()
    {
        return $this->user;
    }


    //------------------------------CONTROLLA QUESTE DUE FUNZIONI
    //------------------------E COME DEVONO PRENDERE E RESTITUIRE $photo
    //--------------------Tutto l'oggetto? L'ID? Cosa???????????????????????????

    /**
     * Sets the photo commented
     * @param string The photo's ID
     */
    public function set_photo($photo)
    {
        $this->photo = $photo;
    }


    /**
     * Retrieves the photo
     * @return string The photo's ID
     */
    public function get_photo()
    {
        return $this->photo;
    }

}
