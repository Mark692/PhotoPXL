<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Login extends \View
{

    /**
     * Grazie a questa funzione all'interno della variabile $dati_log vengono
     * registrati tutti i dati inviati tramite POST dal modulo di login
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('username', 'nonce');
        $dettagli = array ();
        foreach ($keys as $k => $dato)
        {
            $dettagli[$k] = $_REQUEST[$k];
        }
        return $dettagli;
    }
}