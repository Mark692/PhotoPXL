<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registration extends V_Basic
{

    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public static function get_Dati()
    {
        $keys = array ('username', 'password', 'email');
        return parent::get_Dati($keys);
    }

}