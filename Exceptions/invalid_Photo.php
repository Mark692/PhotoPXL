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
class invalid_Photo extends \Exception
{
    public function __construct($code, $exc)
    {
        switch ($code)
        {
            case 0:
                $message ="Percorso immagine non valido: $exc";
                break;

            case 1:
                $message ="L'email inserita non è valida. Immessa: $exc";
                break;

            case 2:
                $message ="Il testo contiene caratteri speciali non ammessi. Permessi: '-_.!? e lo spazio";
                break;


            //AGGIUNGERE CASI PER IL TITOLO DI FOTO ED ALBUM

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }

        parent::__construct($message, NULL, NULL);
    }


}
