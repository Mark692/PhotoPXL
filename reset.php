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
        <title>PhotoPXL</title>
    </head>
    <body>
        <form method="post" action="Service/loginregistration.php">
            <input type="password" name="newPassword" placeholder="Inserisci la nuova password" />
            <input type="hidden" name="username" value="<?php echo filter_input(INPUT_GET, "username"); ?>" />
            <input type="hidden" name="token" value="<?php echo filter_input(INPUT_GET, "token"); ?>" />
            <input type="hidden" name="action" value="resetpassword" />
            <input type="submit" value="cambia password" />
        </form>
    </body>
</html>