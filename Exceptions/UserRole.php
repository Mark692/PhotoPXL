<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exceptions;

/**
 * This class handles exception about the User Role and related functions
 */
class UserRole extends \Exception
{
    public function __construct($code, $exc='')
    {
        global $config;
        switch ($code) {
            case 0:
                $max = count($config['user']) -1;
                $message = "ATTENZIONE! Il ruolo inserito ($exc) non è corretto. Inserire un valore tra 0 e ".$max;
                break;

            case 1:
                $message = "ATTENZIONE! L'utente ricopre già il grado massimo: ".end($config['user']);
                break;

            case 2:
                $message = "ATTENZIONE! L'utente ricopre già il grado minimo: ".$config['user'][0];
                break;

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }
        parent::__construct($message, NULL, NULL);
    }








}