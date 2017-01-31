<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

global $config;

//----Database Connection Parameters----\\
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'photopxl';
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'FRIGO A LEGNA';



//----Photo/Album Categories----\\
define("PAESAGGI", "Paesaggi");
define("RITRATTI", "Ritratti");
define("FAUNA", "Fauna");
define("BIANCO_NERO", "Bianco e Nero");
define("ASTRONOMIA", "Astronomia");
define("STREET", "Street");
define("NATURA_MORTA", "Natura morta");
define("SPORT", "Sport");


//----USERS----\\

//Roles
define("BANNED", "Banned");
define("STANDARD", "Standard");
define("PRO", "Pro");
define("MOD", "Mod");
define("ADMIN", "Admin");

//----Limits
define("UPLOAD_STD_LIMIT", 10);