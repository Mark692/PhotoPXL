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
class photo_details extends \Exception
{
    public function __construct($code, $exc)
    {
        switch($code)
        {
            case 0:
                //E_Photo_Blob->generate() - Fullsize/Thumbnail check
                $message = "Percorso immagine non valido: $exc";
                break;

            case 2:
                //E_Photo_Blob->generate() - Size check
                $message = "Dimensione immagine troppo grande: $exc. Dimensione massima permessa: ".MAX_SIZE;
                break;

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }

        parent::__construct($message, NULL, NULL);
    }


}