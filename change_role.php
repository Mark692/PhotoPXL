<?php

session_start();

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if(!\Control\C_LoginRegistration::isLogged() || !\Control\C_Administration::isModOrAdmin()){
    header("Location: /index.php");
    exit();
}

?>

<html>
    <head>
        <link href="templates/main/template/css/bootstrap.min.css" rel="stylesheet">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="templates/main/template/js/administration.js"></script>
        <title>PhotoPXL</title>
    </head>
    <body>
        <form method="post" action="Service/administration.php">
            <input id="username" type="text" name="username" />
            <input type="hidden" name="action" value="changeRole" />
            <select id="role" name="role">
                <option value="0">Banned</option>
                <option value="1">Standard</option>
                <option value="2">Pro</option>
                <option value="3">Mod</option>
                <option value="4">Admin</option>
            </select>
            <input type="submit" value="cambia" />
        </form>
    </body>
</html>