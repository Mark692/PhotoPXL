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
define("PAESAGGI", "Paesaggi");
define("RITRATTI", "Ritratti");
define("FAUNA", "Fauna");
define("BIANCO_NERO", "Bianco e Nero");
define("ASTRONOMIA", "Astronomia");
define("STREET", "Street");
define("NATURA_MORTA", "Natura morta");
define("SPORT", "Sport");


//----USERS----\\


//----Limits
define("UPLOAD_STD_LIMIT", 10);
