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
define("PAESAGGI", 0);
define("RITRATTI", 1);
define("FAUNA", 2);
define("BIANCO_NERO", 3);
define("ASTRONOMIA", 4);
define("STREET", 5);
define("NATURA_MORTA", 6);
define("SPORT", 7);


//----USERS----\\

//Roles
define("BANNED", 0);
define("STANDARD", 1);
define("PRO", 2);
define("MOD", 3);
define("ADMIN", 4);

//----Limits
define("UPLOAD_STD_LIMIT", 10);