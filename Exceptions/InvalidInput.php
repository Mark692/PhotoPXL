<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exceptions;
//use \Exception;

/**
 * Thrown when invalid input is received at the E_User object
 */
class InvalidInput extends \Exception
{
    public function __construct($code, $exc) {
        switch ($code) {
            case 0:
                $message = "ATTENZIONE! L'username inserito ($exc) comprende caratteri non permessi.";
                break;

            case 1:
                $message = "ATTENZIONE! L'email inserita ($exc) comprende caratteri non permessi.";
                break;

            //AGGIUNGERE CASI PER IL TITOLO DI FOTO ED ALBUM

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }
        parent::__construct($message, NULL, NULL);
    }

}