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
                $message ="Il testo contiene caratteri speciali non ammessi. Permessi: -_.";
                break;

            case 1:
                $message ="L'email inserita non è valida. Immessa: $exc";
                break;

            case 2:
                $message ="Il testo contiene caratteri speciali non ammessi. Permessi: '-_.!? e lo spazio";
                break;

            case 3:
                $message ="Il commento immesso non è un testo valido!";
                break;


            //AGGIUNGERE CASI PER IL TITOLO DI FOTO ED ALBUM

            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }

        parent::__construct($message, NULL, NULL);
    }


}