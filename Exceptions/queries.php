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
class queries extends \PDOException
{
    public function __construct($code, $exc)
    {
        switch ($code)
        {
            case 0:
                $message = "Attenzione! La richiesta non è andata a buon fine. Eccezione: $exc";
                break;

            case 1:
                $message = "Attenzione! C'è stato un errore nella richiesta: $exc";
                break;

            case 2:
                $message = "Attenzione! Non sono state apportate modifiche. Dati ricevuti: $exc";
                break;

            case 3:
                $message = "Attenzione: trovata 'duplicate entry'!";
                break;

            case 4:
                $message = "Impossibile connettersi al database";
                break;


            default: $message = "ATTENZIONE! Richiesta mal formulata: $exc";
        }

        parent::__construct($message);
    }


}