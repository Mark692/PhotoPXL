<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Entity\E_Comment;

/**
 * This class enables to save and load comments
 */
class F_Comment extends F_Database
{

    /**
     * Saves a comment in the DB and sets its ID into the $comment object
     *
     * @param E_Comment $comment The comment to save
     */
    public static function insert(E_Comment $comment)
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
     * @param bool $order_DESC Whether to order result in DESCendent order. Default: ASCendent
     * @return array The comments made for the photo
     */
    public static function get_By_Photo($photo_ID, $order_DESC = FALSE)
    {
        $select = array("id", "text", "user");
        $from = "comment";
        $where = array("photo" => $photo_ID);
        $limit = 0;
        $offset = 0;
        $orderBy = "id";
        return parent::get_All($select, $from, $where, $limit, $offset, $orderBy, $order_DESC);
    }


    /**
     * Updates the text of a comment
     * NOTE that you need to set the comment's ID to get this work!
     *
     * @param E_Comment $comment The new comment to store in the DB
     */
    public static function update(E_Comment $comment)
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