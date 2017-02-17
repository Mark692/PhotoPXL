<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

global $config;

//----Smarty Directories----\\
$config['smarty']['template_dir'] =
'/Users/federicosantomero/Documents/PhotoPXL/PhotoPXL/PhotoPXL/templates/main/template';
$config['smarty']['compile_dir'] =
'/Users/federicosantomero/Documents/PhotoPXL/PhotoPXL/PhotoPXL/templates/main/template_c/';
$config['smarty']['config_dir'] =
'/Users/federicosantomero/Documents/PhotoPXL/PhotoPXL/PhotoPXL/templates/main/configs/';
$config['smarty']['cache_dir'] =
'/Users/federicosantomero/Documents/PhotoPXL/PhotoPXL/PhotoPXL/templates/main/cache/';




//----Database Connection Parameters----\\
$config['mysql_host']     = 'localhost';
$config['mysql_database'] = 'photopxl';
$config['mysql_user']     = 'root';
$config['mysql_password'] = 'FRIGO A LEGNA';



//----Photo/Album Categories----\\
define("PAESAGGI", 1);
define("RITRATTI", 2);
define("FAUNA", 3);
define("BIANCONERO", 4);
define("ASTRONOMIA", 5);
define("STREET", 6);
define("NATURAMORTA", 7);
define("SPORT", 8);



//----Standard User Limits----\\
define("UPLOAD_STD_LIMIT", 10);


//----Photo's Details----\\
define("PHOTOS_PER_ROW", 4);
define("PHOTOS_PER_PAGE", 16);

define("MAX_SIZE_FULL", 16777215); //MEDIUMBLOB max size allowed
define("MAX_SIZE_THUMB", 65535); //BLOB max size allowed

define("THUMBNAIL_WIDTH", 100); //Larghezza
define("THUMBNAIL_HEIGHT", 100); //Altezza
define("FULL_WIDTH",1600);//LUNGHEZZA
define("FULL_HEIGHT",1600);//ALTEZZA

//-----tempo di scadenza della sessione-----\\
define("MAX_TIME_SESSION",2592000);
