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
    public function showimage()
    {
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $role= E_User::get_DB_Role($username);
        $foto = E_Photo::get_By_ID($id, $username, $role);
        $img = $foto['fullsize'];
        $type = $foto['type'];
        header("Content-type:image/".$type);
        echo $img;
    }
}
