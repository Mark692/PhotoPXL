<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Mod extends V_Basic
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati vengono
     * registrati tutti i dati inviati tramite POST dal modulo di modifica del profilo
     *
     * @return array
     */
    public static function get_dati()
    {
        //'bannati' mi riporta i nomi degli utenti bannati che sono stati selezionati
        //nel tpl dovrò inserire nella <input type="checkbox" name='bannati' valure='$username'/>$username </ br>

        $keys = array ('bannati','page_toView', 'page_tot');
        return parent::get_Dati($keys);
    }


}
