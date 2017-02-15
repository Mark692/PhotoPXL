<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace View;

class V_Users extends \View\V_Basic
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati viene
     * ritornatoil commento inserito tramite Post
     *
     * @return array
     */
    public function get_Dati_commento()
    {
        $keys = array ('commento','id','id_commento');
        return parent::get_Dati($keys);
    }
    public function get_Dati_like()
    {
        $keys = array ('id');
//        return parent::get_Dati($keys);
        return parent::get_Dati($keys);
    }
    
}

