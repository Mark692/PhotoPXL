<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataE_User_PRO
{

    /**
     * Sets the Photo privacy as
     * Reserved (TRUE):  only certain users will be able to see the photo
     * Public  (FALSE): ALL users will be able to see the photo
     *
     * @param int $photo_ID The photo to which set the privacy
     * @param bool $privacy The privacy setting for the photo
     */
    public function set_Reserved($photo_ID, $privacy)
    {
        if(is_bool($privacy))
        {
            $photo_ID->set_Reserved($privacy);
        }
    }
}