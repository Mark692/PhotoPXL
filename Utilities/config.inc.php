<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

global $config;

//----Database Connection Parameters----\\
$config['mysql_host']     = 'localhost';
$config['mysql_database'] = 'photopxl';
$config['mysql_user']     = 'root';
$config['mysql_password'] = 'FRIGO A LEGNA';



//----Photo/Album Categories----\\
define("PAESAGGI", 1);
define("RITRATTI", 2);
define("FAUNA", 3);
define("BIANCO_NERO", 4);
define("ASTRONOMIA", 5);
define("STREET", 6);
define("NATURA_MORTA", 7);
define("SPORT", 8);


//----USERS----\\


//----Limits
define("UPLOAD_STD_LIMIT", 10);
define("VIEW_PHOTO_PER_ROW", 4);
define("VIEW_PHOTO_PER_ALBUM", 16);
