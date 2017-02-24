<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Cerca
{
    /**
     * funzione che ricerca foto o album in base alla categoria
     * @return type
     */
    public function search_photo_by_categories()
    {
        $v_ricerca = new \View\V_Ricerca();
        $session = new \Utilities\U_Session();
        $username = $session->get_val('username');
        $role = $session->get_val('role');
        $array_dati = $v_ricerca->get_Dati();
        $tipo_ricerca = $array_dati['tipo_ricerca'];
        $cats = $array_dati['categories'];
        $categorie = $v_ricerca->reimposta_categorie($cats);
        $page_toView = $array_dati['page_toView'];
        if($page_toView == NULL)
        {
            $page_toView = 1;
        }
        if($tipo_ricerca == 'foto')
        {
            $array_search = \Foundation\F_Photo::get_By_Categories($categorie, $page_toView);
        }
        else
        {
            $array_search = \Foundation\F_Album::get_By_Categories($cats, $page_toView);
        }
        $page_tot = ceil($array_search['photo_tot'] / PHOTOS_PER_PAGE);
        $v_ricerca->assign('username', $username);
        $v_ricerca->assign('role', $role);
        $v_ricerca->assign('page_tot', $page_tot);
        $v_ricerca->assign('id_thumbnail', $array_search['id']);
        $v_ricerca->assign('thumbnail', $array_search['thumbnail']);
        return $v_ricerca->fetch('ricerca_categorie.tpl');
    }


//funzione ricerca per data
    /**
     * ritorna il tpl per la ricerca da vedere perchè lo faccio nella home
     */
    public function modulo_ricerca()
    {
        $v_ricerca = new \View\V_Ricerca();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $v_ricerca->assign('utente', $username);
        $v_ricerca->assign('role', $role);
        $categorie = $v_ricerca->imposta_categoria();
        $v_ricerca->assign('categorie', $categorie);
        return $v_ricerca->fetch('ricerca.tpl');
    }


    public function smista()
    {
        $v_Ricerca = new \View\V_Ricerca();
        switch ($v_Ricerca->getTask())
        {
            case 'Modulo_ricerca':
                return $this->modulo_ricerca();
            case 'search_photo_by_categories':
                return $this->search_photo_by_categories();
        }
    }


}