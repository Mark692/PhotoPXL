<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exceptions;

/**
 * Thrown when invalid input is received at the E_User object
 */
class input_texts extends \Exception
{
    public function __construct($code, $exc)
    {
        switch ($code)
        {
            case 0:
                //E_User->__construct() - Username check
                $message ="Il testo contiene Caratteri Speciali non ammessi. Permessi: -_.";
                break;

            case 1:
                //E_User->__construct() - Email check
                $message ="L'email inserita non è valida. Immessa: $exc";
                break;

            case 2:
                //E_Photo->__construct() - Title check
                //E_Album->__construct() - Title check
                $message ="Il testo contiene Caratteri Speciali non ammessi. Permessi: '-_.!? e lo spazio";
                break;

            case 3:
                //E_Photo->__construct() - Description check
                //E_Album->__construct() - Description check
                //E_Comment->__construct() - Text check
                $message ="Il testo immesso non è un testo valido!";
                break;

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }

        parent::__construct($message, NULL, NULL);
    }


}