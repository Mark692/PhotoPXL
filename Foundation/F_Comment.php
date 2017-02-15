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
    public static function execute_Query(\Entity\E_Comment $comment)
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
        $toSearch = array("photo_ID" => $photo_ID);
        $DB_table = "comment";
        $fetchAll = TRUE;
        $orderBy = "id";
        parent::get_All($toSearch, $DB_table, $fetchAll, $orderBy);
    }


    /**
     * Retrieves all the comments that match the query
     *
     * @param array $toSearch The parameters to search in the "comment" table
     * @return array The list of all comments that match the query
     */
    public static function get_All($toSearch)
    {
        $DB_table = "comment";
        $fetchAll = TRUE;
        $orderBy = "id";
        return parent::get_All($toSearch, $DB_table, $fetchAll, $orderBy);
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