<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View; 
use Entity\E_User;
use Entity\E_Photo;

class showimage
{
    public function showimage($id,$username)
    {
        $role= E_User::get_DB_Role($username);
        $thumb = E_Photo::get_By_ID($id, $username, $role);
        $mime = image_type_to_mime_type($thumb["type"]);
        $pic = $thumb["fullsize"];
        echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
    }
}
