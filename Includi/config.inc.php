<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;

//----Database Connection Parameters---
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'photopxl';
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'FRIGO A LEGNA';


//---User Roles Parameters---
//$config['user_Role']['STD'] = "Standard";
//$config['user_Role']['PRO'] = "Pro";
//$config['user_Role']['BAN'] = "Banned";

//---User Upload Limits Parameters---
$config['upload_limit']['Standard'] = 10;
$config['upload_limit']['PRO'] = -1;
$config['upload_limit']['Banned'] = 0;


//---Photo/Album Categories---
$config['categories'][] = 'Paesaggi';
$config['categories'][] = 'Ritratti';
$config['categories'][] = 'Fauna';
$config['categories'][] = 'Macro';
$config['categories'][] = 'Bianco e Nero';
$config['categories'][] = 'Astronomia';
$config['categories'][] = 'Street';
$config['categories'][] = 'Natura Morta';
$config['categories'][] = 'Sport';


