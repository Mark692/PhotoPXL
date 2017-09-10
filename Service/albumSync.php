<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Album;

if(!\Control\C_LoginRegistration::isLogged()){
    header("Location: /index.php");
    exit();
}

$action = filter_input(INPUT_POST, "action");
switch($action){
    case "create": $title = filter_input(INPUT_POST, "create");
        $categories = filter_input(INPUT_POST, "categories");
        $description = filter_input(INPUT_POST, "description");
        C_Album::create($title, $categories, $description);
        break;
    case "delete": $albumId = filter_input(INPUT_POST, "albumId");
        $withPhotos = (boolean) filter_input(INPUT_POST, "withPhotos");
        C_Album::delete($albumId, $withPhotos);
        break;
    case "edit": $albumId = filter_input(INPUT_POST, "albumId");
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories");
        $description = filter_input(INPUT_POST, "description");
        C_Album::edit($albumId, $title, $categories, $description);
        break;
    case "see": $albumId = filter_input(INPUT_POST, "albumId");
        C_Album::see($albumId);
        break;
    default;
}