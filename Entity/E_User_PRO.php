<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Foundation\F_User_PRO;
use Utilities\Roles;

/**
 * This class represents higher level users than Standard ones.
 * PRO Users are able to set a privacy to their photos and are not limited in daily uploads
 */
class E_User_PRO extends E_User
{
    /**
     * Instantiates a PRO User
     *
     * @param string $username This user's username
     * @param string $password This user's password
     * @param string $email This user's email
     */
    public function __construct($username, $password, $email)
    {
        parent::__construct($username, $password, $email);
        parent::set_Role(Roles::PRO);
    }


    /**
     * Enables the user to upload any photo
     *
     * @return boolean TRUE
     */
    public function canUpload()
    {
        return TRUE;
    }



    //---ENTITY -> FOUNDATION---\\


    /**
     * Updates a photo privacy.
     * This function does NOT checks if the actual user is the uploader of the photo
     *
     * @param int $photo_ID The photo ID
     * @param int $privacy The new privacy for the photo
     * @throws queries In case of connection errors
     */
    public static function set_PhotoPrivacy($photo_ID, $privacy)
    {
        F_User_PRO::set_PhotoPrivacy($photo_ID, $privacy);
    }
}