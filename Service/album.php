<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Album;

$albumId=  filter_input(INPUT_POST, "albumId");
$pageToView=  filter_input(INPUT_POST, "pageToView");
echo json_encode(C_Album::seeAsync($albumId, $pageToView));