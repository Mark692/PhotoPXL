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
class InvalidAlbumInfo extends \Exception
{
    public function __construct($code, $exc) {
        switch ($code) {
            case 0:
                $message = "Qualcosa è andato storto mentre si cercava di aggiornare le categorie dell'album!";
                break;

            case 1:
                $message = "";
                break;

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }

        parent::__construct($message, NULL, NULL);
    }

}


