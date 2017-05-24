<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Photo;

$photo = new C_Photo();
$action = filter_input(INPUT_POST, "action");
switch ($action){
    case "see": $photoId = filter_input(INPUT_POST, "photoId");
        $photo->see($photoId);
        break;
    case "edit": $photoId = filter_input(INPUT_POST, "photoId");
        $title = filter_input(INPUT_POST, "title");
        $categories= filter_input(INPUT_POST, "categories");
        $description = filter_input(INPUT_POST, "description");
        $photo->edit($photoId, $title, $categories, $description);
        break;
    case "upload": $photoPath = $_FILES['userfile']['tmp_name']; //userfile è l'id dell'input con type=file. Userfile è id(o name)
        $title = filter_input(INPUT_POST, "title");
        $categories = filter_input(INPUT_POST, "categories");
        $description = filter_input(INPUT_POST, "description");
        $albumId = filter_input(INPUT_POST, "albumId");
        $photo->upload($photoPath, $title, $categories, $description);
        break;
    case "delete": $photoId = filter_input(INPUT_POST, "photoId");
        $photo->delete($photoId);
        break;
    case "searchByCategory": $category = filter_input(INPUT_POST, "category");
        $photo->searchByCategory($category);
        break;
    case "changeAlbum": $photoId = filter_input(INPUT_POST, "photoId");
        $newAlbumId = filter_input(INPUT_POST, "newAlbumId");
        $photo->changeAlbum($photoId, $newAlbumId);
        break;
    case "mostLiked": $photo->mostLiked();
        break;
    default: break;
}