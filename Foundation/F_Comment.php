<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * This class enables to save and load comments
 */
class F_Comment extends \Foundation\F_Database
{

    /**
     * Saves a comment in the DB
     *
     * @param \Entity\E_Comment $comment The comment to save
     */
    public static function insert(\Entity\E_Comment $comment)
    {
        $insertInto = "comment";

        $set = array(
            "text" => $comment->get_Text(),
            "user" => $comment->get_User(),
            "photo" => $comment->get_PhotoID()
                );

        $comment_ID = parent::insert_Query($insertInto, $set); //Inserts the comments and gets its ID.
        $comment->set_ID($comment_ID);
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
        $select = "*";
        $from = "comment";
        $where = array("photo" => $photo_ID);
        $limit = 0;
        $offset = 0;
        $orderBy = "id";
        parent::get_All($select, $from, $where, $limit, $offset, $orderBy);
    }


    public static function update(\Entity\E_Comment $comment)
    {
        $update = "comment";
        $set = array("text" => $comment->get_Text());
        $where = array("id" => $comment->get_ID());
        parent::update($update, $set, $where);
    }


    /**
     * Deletes a comment
     *
     * @param int $comment_ID The ID of the comment to remove
     */
    public static function remove($comment_ID)
    {
        $query = "DELETE FROM `comment` "
                ."WHERE (`id`=?) ";
        $toBind = array($comment_ID);
        parent::execute_Query($query, $toBind);
    }
}