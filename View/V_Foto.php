<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Foto extends \View\V_Basic
{

    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public function get_Dati()
    {
    $keys1 = array ('foto1', 'foto2', 'foto3');
//    $keys2= array ('title','desc','is_reserved','cat','album_ID','tmp_name','size','type');
    $total = [];
     foreach($keys1 as $dato1){
    array_push($total, array_merge($_REQUEST[$dato1], $_FILES[$dato1]));
    }
    return $total;
    
        }
    
}