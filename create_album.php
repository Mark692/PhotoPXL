<?php
session_start();

require_once '.' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';
$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

if (!\Control\C_LoginRegistration::isLogged() || \Control\C_LoginRegistration::isBanned()) {
    header("Location: /index.php");
    exit();
}
?>

<html>
    <head>
        <link href="templates/main/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script src="templates/main/template/js/create_album.js"></script>
        <title>PhotoPXL</title>
    </head>
    <body>
        <form method="post" action="/Service/albumSync.php">
            <input type="hidden" name="action" value="create" />
            <input id="title" type="text" name="title" maxlength="30" required="required" placeholder="Titolo"/>
            <select multiple="" name="categories[]">
                <option value="1">Paesaggi</option>
                <option value="2">Ritratti</option>
                <option value="3">Fauna</option>
                <option value="4">Bianco e Nero</option>
                <option value="5">Astronomia</option>
                <option value="6">Street</option>
                <option value="7">Natura Morta</option>
                <option value="8">Sport</option>
            </select>
            <textarea id="description" name="description" maxlength="500" placeholder="Descrizione..."></textarea>
            <input type="submit" value="crea" />
        </form>
    </body>