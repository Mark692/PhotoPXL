<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

/**
 * Sets basic info for PRO users
 */
class F_User_PRO extends F_User
{

    /**
     * Updates a photo privacy
     *
     * @param int $photo_ID The photo ID
     * @param bool $privacy The new privacy for the photo
     */
    public static function set_PhotoPrivacy($photo_ID, $privacy)
    {
        $update = "photo";
        $set = array("is_reserved" => $privacy);
        $where = array("id" => $photo_ID);

        parent::update($update, $set, $where);
    }


}

