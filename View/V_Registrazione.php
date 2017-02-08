<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registazione extends View
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     * @return array
     */
    public function get_Dati_registazione()
    {
        $chiavi_registrazione = array ('username', 'nonce', 'email');
        $dati_reg = array ();
        foreach ($chiavi_registrazione as $k => $dato)
        {
            $dati_reg[$k] = $_REQUEST[$k];
        }
        return $dati_reg;
    }


    /**
     * Grazie a questa funzione all'interno della variabile $dati_log vengono
     * registrati tutti i dati inviati tramite POST dal modulo di login
     *
     * @return array
     */
    public function get_Dati_login()
    {
        $chiavi_registrazione = array ('username', 'nonce');
        $dati_log = array ();
        foreach ($chiavi_registrazione as $k => $dato)
        {
            $dati_log[$k] = $_REQUEST[$k];
        }
        return $dati_log;
    }

}