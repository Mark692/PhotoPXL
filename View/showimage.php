<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        echo ('sono dentro Show_image');
        $id = filter_input(INPUT_GET, 'id');
        $foto= Entity\E_Photo::get_By_ID($id, $username=$_GET['username'], $role=  Entity\E_User::get_DB_Role($_GET['username']));
        $img = $foto['fullsize'];
        header("Content-type:image/jpeg");
        echo $img;




?>