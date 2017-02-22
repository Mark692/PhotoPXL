<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @access public
 * @package View
 */

namespace View;

class V_Album extends \View\V_Basic
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati vengono
     * registrati tutti i dati inviati tramite POST dal modulo di modifica del profilo
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('username', 'page_toView', 'page_tot', 'order', 'email','tmp_name','size','type');
        return parent::get_Dati($keys);
    }


}