<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exceptions;

use Exception;

/**
 * Thrown when invalid input is received at the E_User object
 */
class uploads extends Exception
{
    public function __construct($code, $exc='')
    {
        switch ($code)
        {
            case 0:
                //E_Photo_Blob->on_Upload() - Type check
                $message ="La foto è di un formato NON supportato!";
                break;

            case 1:
                //E_Photo_Blob->on_Upload() - Size check
                $message ="La foto ha dimensione troppo grande!";
                break;

            default:
                $message = "Qualcosa è andato storto durante l'upload: ".$exc;
        }
        parent::__construct($message, NULL, NULL);
    }
}

