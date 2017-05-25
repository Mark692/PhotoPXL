<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace View;

class Show_Image
{
    
public function ShowImage($id,$user,$role)
    {
        $foto=\Entity\E_Photo::get_By_ID($id, $user, $role);
        $type = $foto['type'];
        $img = $foto['fullsize'];
        header ("Content-type: ".$type);
        echo $img;
    }
}