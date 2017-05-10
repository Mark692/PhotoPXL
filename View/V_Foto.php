<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Foto extends V_Home
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public static function get_Dati()
    {
        $keys = array ('title', 'description', 'is_reserved', 'categories', 'album_id');
        return parent::get_Dati($keys);
    }


    /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public static function getID()
    {
        if(isset($_REQUEST['id']))
        {
            return $_REQUEST['id'];
        }
    }


    /**
     * Questo metodo viene utilizzato per vedere una foto, assegna a smarty i dati dell'utente e il percorso della foto
     * @param type $array_user
     * @param type $photo
     */
    public static function showPhotoPage($array_user, $photo)
    {
        $this->assign('foto_deteils', $photo);
        $this->assign('foto', $photo);
        $categories = $this->imposta_categoria($photo['categories']);
        $this->assign('categories', $categories);
        $this->assign('utente', $array_user);
         if($photo['username'] != $array_user['username']);
        {
            $this->home($role, $tpl='foto_altri_user');;
        }
        $this->home($role, $tpl='foto_user');
    }


}