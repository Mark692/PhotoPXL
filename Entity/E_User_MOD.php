<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Foundation\F_User_MOD;
use Utilities\Roles;

/**
 * This class represents the MODerator users.
 * Their function is to ban unwanted users while inheriting all the PRO users functions
 */
class E_User_MOD extends E_User_PRO
{
    /**
     * Instantiates a MOD User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::MOD);
    }



    //---ENTITY -> FOUNDATION---\\


    /**
     * Retrieves the list of all usernames that match the query
     *
     * @param int $pageToView The page to view. It influences the result offset
     * @param string $starts_With A case INsensitive string to filtrate the results
     * @param int $limit_PerPage The maximum number of records to show
     * @return array All the usernames that match the query and the total usernames stored in the DB
     */
    public static function get_UsersList($pageToView = 1, $starts_With = '', $limit_PerPage = 100)
    {
        return F_User_MOD::get_UsersList($pageToView, $starts_With, $limit_PerPage);
    }


    /**
     * Bans a user if its not an Admin
     *
     * @param string $username The user's username to ban
     */
    public static function ban($username)
    {
        F_User_MOD::ban($username);
    }
}