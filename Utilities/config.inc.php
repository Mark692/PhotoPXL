<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

global $config;


$smarty_path = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR
                ."templates".DIRECTORY_SEPARATOR
                    ."main".DIRECTORY_SEPARATOR;

//----Smarty Directories----\\
$config['smarty']['cache_dir']    = $smarty_path.'cache'.DIRECTORY_SEPARATOR;
$config['smarty']['config_dir']   = $smarty_path.'configs'.DIRECTORY_SEPARATOR;
$config['smarty']['template_dir'] = $smarty_path.'template'.DIRECTORY_SEPARATOR;
$config['smarty']['compile_dir']  = $smarty_path.'template_c'.DIRECTORY_SEPARATOR;




//----Database Connection Parameters----\\
$config['mysql_database'] = 'my_photopxl';
$config['mysql_host']     = 'localhost';     //NOT USED ON ALTERVISTA. PERMISSION CHANGES ARE FORBIDDEN!
$config['mysql_user']     = 'root';          //NOT USED ON ALTERVISTA. PERMISSION CHANGES ARE FORBIDDEN!
$config['mysql_password'] = 'FRIGO A LEGNA'; //NOT USED ON ALTERVISTA. PERMISSION CHANGES ARE FORBIDDEN!



//----Photo/Album Categories----\\
define("PAESAGGI", 1);
define("RITRATTI", 2);
define("FAUNA", 3);
define("BIANCONERO", 4);
define("ASTRONOMIA", 5);
define("STREET", 6);
define("NATURAMORTA", 7);
define("SPORT", 8);



//----FIXED DB IDs----\\
define("NO_ALBUM_COVER", 1);
define("DEFAULT_PRO_PIC", 2);



//----User constants----\\
define("UPLOAD_STD_LIMIT", 10);
define("TOKEN_BIN_LENGHT", 32); //This has to be converted to HEX and then saved to DB
define("TOKEN_LIFETIME", 172800); //Two days lifetime


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


define("FULL_WIDTH", 1600); //Lunghezza Fullsize
define("FULL_HEIGHT", 1600); //Altezza Fullsize
define("THUMB_WIDTH", 100); //Lunghezza miniatura
define("THUMB_HEIGHT", 100); //Altezza miniatura



//-----Tempo di scadenza della sessione-----\\
define("MAX_TIME_SESSION", 2592000); //= 30 days



//-----Username per pagina-----\\
define("USER_PER_PAGE", 100);
