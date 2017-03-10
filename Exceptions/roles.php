<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exceptions;

use Exception;
use Utilities\Roles;

/**
 * This class handles exception about the User Role and related functions
 */
class roles extends Exception
{
    public function __construct($code, $exc='')
    {
        $max_role = Roles::ADMIN;
        $min_role = Roles::BANNED;

        switch ($code) {
            case 0:

                $message = "ATTENZIONE! Il ruolo inserito ($exc) non è corretto. Inserire un valore tra 0 e ".$max_role;
                break;

            case 1:
                $message = "ATTENZIONE! L'utente ricopre già il grado massimo: ".$max_role;
                break;

            case 2:
                $message = "ATTENZIONE! L'utente ricopre già il grado minimo: ".$min_role;
                break;

            case 3:
                $message = "ATTENZIONE! Non puoi bannare un Admin!!";
                break;

            case 4:
                $message = "ATTENZIONE! Non puoi cambiare il TUO ruolo di Admin!!";
                break;


            default: $message = "ATTENZIONE! Parametro non valido: $exc";
        }
        parent::__construct($message, NULL, NULL);
    }








}