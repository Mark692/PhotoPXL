<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use Utilities\Roles;

/**
 * Sets basic info for MOD users
 */
class F_User_MOD extends F_User_PRO
{
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
        $offset = ($pageToView - 1) * $limit_PerPage;

        $query = 'SELECT `username` '
                .'FROM `users` ';
        $where = '1 ';

        $len = strlen($starts_With);
        if($len > 0)
        {
            $where = 'LEFT(`username`, '.$len.') = \''.$starts_With.'\' ';
        }
        $query .='WHERE '.$where
                .'ORDER BY `username` '
                .'LIMIT '.$limit_PerPage.' '
                .'OFFSET '.$offset;

        $toBind = [];
        $fetchAll = TRUE;
        $users_array = parent::fetch_Result($query, $toBind, $fetchAll);
        $usernames_only = [];
        foreach($users_array as $u)
        {
            array_push($usernames_only, $u["username"]);
        }

        $count = "username";
        $from = "users";
        $tot = parent::count($count, $from, $where);
        $total = array("total_inDB" => $tot);

        return array_merge($usernames_only, $total);
    }


    /**
     * Bans a user if its not an Admin
     *
     * @param string $username The user's username to ban
     */
    public static function ban($username)
    {
        $user_Role = parent::get_Role($username);
        if($user_Role !== FALSE //The username exists
                && $user_Role !== Roles::ADMIN) //AND it's not an Admin
        {
            $update = "users";
            $set = array("role" => Roles::BANNED);
            $where = array("username" => $username);

            parent::update($update, $set, $where);
        }

        elseif($user_Role === FALSE)
            {echo("We, questo tizio non esiste!".nl2br("\r\n").nl2br("\r\n"));}
            elseif($user_Role !== Roles::ADMIN) {
    }


}