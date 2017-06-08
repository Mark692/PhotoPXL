<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * Sets basic functions for PRO users
 */
class F_User_PRO extends F_User
{

    /**
     * Updates a photo privacy.
     *
     * @param string $username The user who's trying to change the privacy to a photo
     * @param int $photo_ID The photo ID
     * @param int $privacy The new privacy for the photo
     * @throws queries In case of connection errors
     */
    public static function set_PhotoPrivacy($username, $photo_ID, $privacy)
    {
        $update = "photo";
        $set = array("is_reserved" => intval($privacy)); //In case a bool is passed the value will be set as INT
        $where = array("id" => $photo_ID, "user" => $username);

        parent::update($update, $set, $where);
    }
}

