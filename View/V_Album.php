<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace View;

class V_Album extends \View\V_Basic
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('title', 'description','categories');
        return parent::get_Dati($keys);
    }


    /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function get_ID_Album()
    {
        if(isset($_REQUEST['id_album']))
        {
            return $_REQUEST['id_album'];
        }
    }
}

