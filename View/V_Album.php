<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Album extends V_Home
{
    //METODI STATICI -> CONTROL\\

    //A BENEDETTA SERVE LA FUNZIONE STATICA ::album() PER DARE LA SCHERMATA QUANDO SI ENTRA NELL'ALBUM
    public static function album($qualche_parametro, $parametro2, $tre, $quattro, $chenesoquantiteneservono)
    {
        $v = new V_Basic();
        //VISUALIZZA L'ALBUM
    }


    //METODI BASE - NON STATICI!!!\\


    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('title', 'description', 'categories');
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


    /*
     * restituisce il contento del tpl in base all'utente
     */
    public function set_album_tpl($album, $thumbnail,$array_user)
    {
        $smarty = new \Smarty();
        $page_tot = ceil($thumbnail['tot_photo'] / PHOTOS_PER_PAGE);
        $smarty->assign('id', $thumbnail['id']);
        $smarty->assign('thumbnail', $thumbnail['thumbnail']);
        $smarty->assign('page_tot', $page_tot);
        $smarty->assign('title', $album['title']);
        $smarty->assign('description', $album['description']);
        $categorie = $this->imposta_categoria($album['categories']); //dal numero alla stringa
        $smarty->assign('categories', $categorie);
        $smarty->assign('user_details',$array_user);
        $role=$array_user['role'];
        $role=$this->imposta_ruolo($role);
        $this->home($role, $tpl='album');
    }


}