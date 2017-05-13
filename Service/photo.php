<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Photo;

$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "comment": $photoId = filter_input(INPUT_POST, "photoId");
        $text = filter_input(INPUT_POST, "text");
        $returns = C_Photo::comment($photoId, $text);
        break;
    case "likeUnlike": $photoId = filter_input(INPUT_POST, "photoId");
        $returns = C_Photo::likeUnlike($photoId);
        break;
    case "seeComments":$photoId = filter_input(INPUT_POST, "photoId");
        $returns = C_Photo::seeComments($photoId);
        break;
    case "seeLikes":$photoId = filter_input(INPUT_POST, "photoId");
        $returns = C_Photo::seeLikes($photoId);
        break;
    case "mostLikedAsync": $pageToView = filter_input(INPUT_POST, "pageToView");
        $returns = C_Photo::mostLikedAsync($pageToView);
        break;
    default: $returns = false;
}

echo json_encode($returns);