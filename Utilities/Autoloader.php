<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Extends autoloader functionalities to include new classes
 *
 * @param string $path The path to the class to load
 */
function load_This($path)
{
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $path);
    $path .= '.php';
    require_once ($path);
}

spl_autoload_register('load_This');
