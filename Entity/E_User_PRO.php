<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_User_PRO extends E_User_Basic
{
    private $role = \Utilities\PRO;


    /**
     * NOTA BENE: AGGIUNGERE UN BLOCCO TRY-CATCH (in Control) PER GESTIRE IL
     * CASO IN CUI $obj_photo NON SIA UN OGGETTO \Entity\E_Photo!!!
     *
     * Sets the Photo privacy as
     * Reserved (if $privacy === TRUE):  only certain users will be able to see the photo
     * Public   (if $privacy === FALSE): ALL users will be able to see the photo
     * @param \Entity\E_Photo object The photo object to set the privacy
     * @param bool $privacy The privacy setting for the photo
     */
    public function set_privacy($obj_photo, bool $privacy)
    {
        $obj_photo->set_privacy($privacy);
    }
}