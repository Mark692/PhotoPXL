<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_User extends \Foundation\F_Database
{
    /**
     * Retrieves all the users that match the query
     *
     * @param array $arr_values The values to search with the query
     * @param bool $fetchAll Whether to get 1 (FALSE) or all (TRUE) the records that match the query
     * @param string $orderBy The table column chosen to order the results
     * @param string $orderStyle The ASCendent or DESCendent style to return the results. Allowed values: ASC or DESC
     * @return array All the users that match the query
     */
    public static function get_All($arr_values, $fetchAll=FALSE, $orderBy='', $orderStyle="ASC")
    {
        $DB_table = "users";
        return parent::get_All($arr_values, $DB_table, $fetchAll, $orderBy, $orderStyle);
    }
}