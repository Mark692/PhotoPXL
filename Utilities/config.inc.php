<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

global $config;

$smarty_path = ".".DIRECTORY_SEPARATOR
                    ."templates".DIRECTORY_SEPARATOR
                        ."main".DIRECTORY_SEPARATOR;

//----Smarty Directories----\\
$config['smarty']['cache_dir']    = $smarty_path.'cache'.DIRECTORY_SEPARATOR;
$config['smarty']['config_dir']   = $smarty_path.'configs'.DIRECTORY_SEPARATOR;
$config['smarty']['template_dir'] = $smarty_path.'template'.DIRECTORY_SEPARATOR;
$config['smarty']['compile_dir']  = $smarty_path.'template_c'.DIRECTORY_SEPARATOR;




//----Database Connection Parameters----\\
$config['mysql_host']     = 'localhost';
$config['mysql_database'] = 'my_photopxl';
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



//----Input important text----\\
define("MIN_TITLE_CHARS", 3);
define("MAX_TITLE_CHARS", 30);
define("MAX_DESCRIPTION_CHARS", 500);

define("MIN_USERNAME_CHARS", 3);
define("MAX_USERNAME_CHARS", 20);

define("MAX_COMMENT_CHARS", 2000);



//----Photo's Details----\\
define("PHOTOS_PER_ROW", 4);
define("PHOTOS_PER_PAGE", 16);

define("MAX_SIZE_FULL", 16777215); //MEDIUMBLOB max size allowed
define("MAX_SIZE_THUMB", 65535); //BLOB max size allowed

define("THUMB_WIDTH", 100); //Lunghezza miniatura
define("THUMB_HEIGHT", 100); //Altezza miniatura
define("FULL_WIDTH",1600);//Lunghezza Fullsize
define("FULL_HEIGHT",1600);//Altezza Fullsize



//-----Tempo di scadenza della sessione-----\\
define("MAX_TIME_SESSION",2592000);

//-----Username per pagina-----\\
define("USER_PER_PAGE", 100);
