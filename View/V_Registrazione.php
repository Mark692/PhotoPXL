<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registazione extends \View
{

    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('username', 'password', 'email');
        $dettagli = array ();
        foreach ($keys as $k => $dato)
        {
            $dettagli[$k] = $_REQUEST[$k];
        }
        return $dettagli;
    }

}