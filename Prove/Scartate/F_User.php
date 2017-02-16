<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataF_Photo extends \Foundation\F_Database
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
    

    /**
     * Instantiates an \Entity\E_User_* user according to its role
     *
     * @param array $details The user details fetched from a query
     * @return \Entity\E_User_* The right user according to its role
     */
    private static function instantiate_EUser($details)
    {
        $username = $details["username"];
        $password = $details["password"];
        $email = $details["email"];
        $up_Count = $details["up_Count"];
        $last_up = $details["last_Up"];
        switch ($details["role"])
        {
            case \Utilities\Roles::STANDARD:
                $user = new \Entity\E_User_Standard($username, $password, $email, $up_Count, $last_up);
                break;
            case \Utilities\Roles::PRO:
                $user = new \Entity\E_User_PRO($username, $password, $email);
                break;
            case \Utilities\Roles::MOD:
                $user = new \Entity\E_User_MOD($username, $password, $email);
                break;
            case \Utilities\Roles::ADMIN:
                $user = new \Entity\E_User_ADMIN($username, $password, $email);
                break;
        }
        return $user;
    }
}