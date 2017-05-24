<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Photo;

$photo = new C_Photo();
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "comment": $photoId = filter_input(INPUT_POST, "photoId");
        $text = filter_input(INPUT_POST, "text");
        $returns = $photo->comment($photoId, $text);
        break;
    case "likeUnlike": $photoId = filter_input(INPUT_POST, "photoId");
        $returns = $photo->likeUnlike($photoId);
        break;
    case "seeComments":$photoId = filter_input(INPUT_POST, "photoId");
        $returns = $photo->seeComments($photoId);
        break;
    case "seeLikes":$photoId = filter_input(INPUT_POST, "photoId");
        $returns = $photo->seeLikes($photoId);
        break;
    case "mostLikedAsync": $pageToView = filter_input(INPUT_POST, "pageToView");
        $returns = $photo->mostLikedAsync($pageToView);
        break;
    case "privacy": $photoId = filter_input(INPUT_POST, "photoId");
        $returns = $photo->privacy($photoId);
    default: $returns = false;
}

echo json_encode($returns);