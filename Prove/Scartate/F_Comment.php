<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

class F_Photo extends \Foundation\F_Database
{

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
}