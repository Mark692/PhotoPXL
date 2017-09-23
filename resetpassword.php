<?php

session_start();

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if(\Control\C_LoginRegistration::isLogged()){
    header("Location: /index.php");
    exit();
}

?>
<html>
    <head>
        <link href="templates/main/template/css/bootstrap.min.css" rel="stylesheet">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="templates/main/template/js/forgotpassword.js"></script>
        <title>PhotoPXL</title>
    </head>
    <body>
        <form method="post" action="Service/loginregistration.php">
            <input type="text" id="username" name="username" placeholder="Inserisci username" />
            <input type="hidden" name="action" value="gettoken" />
            <input type="submit" value="cambia password" />
        </form>
    </body>
</html>