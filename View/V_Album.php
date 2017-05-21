<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Album extends V_Home
{
    //METODI STATICI \\

    //A BENEDETTA SERVE LA FUNZIONE STATICA ::album() PER DARE LA SCHERMATA QUANDO SI ENTRA NELL'ALBUM
    /*
     * funzione per restituire la vista di un album
     */
    public static function album()
    {
        $v = new V_Basic();
        $home=new V_Home();
        $username = $_SESSION["username"];
        $id= $_SESSION["id"];
        $album= \Entity\E_Album::get_By_ID($id);//devo capire se mi da solo le informazioni oppure le thumbnail interne
        $v->assign('username',$username);
        $v->assign('album', $album);
        $role =$v->imposta_ruolo($_SESSION["role"]);
        $home->home_default($role, $tpl = 'Album');
        //$array_photo=$home->thumbnail($array_photo);
        //$v->assign('array_photo',$array_photo);
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
     * nn lo so che fa questa
     */
    public function set_album_tpl($album, $thumbnail,$array_user)
    {
        $v = new \V_Basic();
        $page_tot = ceil($thumbnail['tot_photo'] / PHOTOS_PER_PAGE);
        $v->assign('id', $thumbnail['id']);
        $v->assign('thumbnail', $thumbnail['thumbnail']);
        $v->assign('page_tot', $page_tot);
        $v->assign('title', $album['title']);
        $v->assign('description', $album['description']);
        $categorie = $this->imposta_categoria($album['categories']); //dal numero alla stringa
        $v->assign('categories', $categorie);
        $v->assign('user_details',$array_user);
        $role=$array_user['role'];
        $role=$this->imposta_ruolo($role);
        $this->home($role, $tpl='album');
    }


}
