<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

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
    public static function get_UsersList($pageToView, $starts_With = '', $limit_PerPage = 100)
    {
        $offset = ($pageToView - 1) * $limit_PerPage;

        $query = 'SELECT `username` '
                .'FROM `users` ';

        $len = strlen($starts_With);
        if($len>0)
        {
            $query .= 'WHERE LEFT(`username`, '.$len.') = \''.$starts_With.'\' ';
        }
        else
        {
            $query .= 'WHERE 1 ';
        }
        $query .= 'LIMIT '.$limit_PerPage.' '
                .'OFFSET '.$offset;
        
        $toBind = [];
        $fetchAll = TRUE;
        $users_array = parent::fetch_Result($query, $toBind, $fetchAll);
        $users = [];
        foreach($users_array as $u)
        {
            array_push($users, $u["username"]); //Keeps only the usernames
        }

        $count = "username";
        $from = "users";
        $where = "1";
        $tot = parent::count($count, $from, $where);
        $total = array("total_inDB" => $tot);

        return array_merge($users, $total);
    }


    /**
     * Bans a user if its not an Admin
     *
     * @param string $username The user's username to ban
     */
    public static function ban($username)
    {
        $user_Role = parent::get_Role($username);
        if($user_Role !== \Utilities\Roles::ADMIN)
        {
            $update = "users";
            $set = array("role" => \Utilities\Roles::BANNED);
            $where = array("username" => $username);

            parent::update($update, $set, $where);
        }
    }
}

