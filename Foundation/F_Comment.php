<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class permits to save and load comments
 */
class F_Comment extends F_Database
{

    /**
     * Saves a comment in the DB
     *
     * @param \Entity\E_Comment $comment The comment to save
     * @return string The comment's ID
     */
    public static function insert(\Entity\E_Comment $comment)
    {
        $query = 'INSERT INTO `comment` SET '
                .'`text`=?, '
                .'`UTENTE_FK`=?, '
                .'`PHOTO_FK`=?';

        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $comment->get_Text(),
            $comment->get_User(),
            $comment->get_Photo());

        $comment_ID = parent::insert($query, $toBind); //Inserts the comments and gets its ID.
        $comment->set_ID($comment_ID);
        return $comment->get_ID();
    }
}