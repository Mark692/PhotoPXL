<?php
session_start();

$path = "." . DIRECTORY_SEPARATOR . "Utilities" . DIRECTORY_SEPARATOR;
require_once $path . "my_Autoloader.php";
require_once $path . "config.inc.php";

\Control\C_LoginRegistration::logout();
header("Location: index.php");

