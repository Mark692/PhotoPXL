<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $config;

//Parametri di connessione a DB
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'photopxl';
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'FRIGO A LEGNA';


//Parametri per gli utenti
//$config['user_Role']['STD'] = "Standard";
//$config['user_Role']['PRO'] = "Pro";
//$config['user_Role']['BAN'] = "Banned";
$config['upload_limit']['Standard'] = 10;
$config['upload_limit']['PRO'] = -1;
$config['upload_limit']['Banned'] = 0;



