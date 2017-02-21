<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Album
{
    public function modulo_Crea_Album()
    {
        $v_Album = new \View\V_Album;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $v_Album->assign('utente', $username);
        $v_Album->assign('role', $role);
        $categorie = $v_Album->imposta_categoria(); //imposta tutte le categorie dal numero alla stringa
        $v_Album->assign('categorie', $categorie);
        if($role == \Utilities\Roles::STANDARD)
        {
            return $v_Album->fetch('crea_album_standard.tpl');
        }
        elseif($role > \Utilities\Roles::STANDARD)
        {
            return $v_Album->fetch('crea_album.tpl');
        }
        else
        {
            $Session->unset_session();
        }
    }


    public function display_photo_album()
    {
        $v_Album = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $v_Album->assign('username', $username);
        $v_Album->assign('role', $role);
        $array_post = $v_Album->getdati('id', 'page_toView', 'page_tot', 'order');
        //page_to_view sarà gestito nel template con una form dove verrà incrementato per vedere la pagina succesiva
        //alrimenti decrementato
        $page_toView = $array_post['page_toView'];
        if(!is_int($page_toView))//la prima volta sarà null 
        {
            $page_toView = 1;
        }
        $id_album = $array_post['id'];
        $order = $array_post['order'];
        if($order == NULL)
        {
            $order = FALSE;
        }
        $v_Album->assign('order', $order);
        $thumbnail = \Foundation\F_Photo::get_By_Album($id_album, $page_toView, $order);
        $album_details = \Foundation\F_Album::get_By_ID($id_album);
        if($thumbnail['tot_photo'] !== 0)
        {
            $page_tot = ceil($thumbnail['tot_photo'] / PHOTOS_PER_PAGE);
            $v_Album->assign('id', $thumbnail['id']);
            $v_Album->assign('thumbnail', $thumbnail['thumbnail']);
            $v_Album->assign('page_tot', $page_tot);
        }
        else
        {
            $v_Album->assign('message', "Nessun Risultato trovato");
        }
        $v_Album->assign('title', $album_details['title']);
        $v_Album->assign('description', $album_details['description']);
        $categorie = $v_Album->imposta_categoria($album_details['categories']); //dal numero alla stringa
        $v_Album->assign('categories', $album_details['categories']);
        if($album_details['username'] != $username)
        {
            if($role >= \Utilities\Roles::MOD)
            {
                return $v_Album->fetch('album_altri_user_mod.tpl');
            }
            elseif($role == \Utilities\Roles::BANNED)
            {
                $Session->unset_session();
            }
            $v_Album->fetch('album_altri_user.tpl');
        }
        elseif($role == \Utilities\Roles::BANNED)
        {
            $Session->unset_session();
        }
        $v_Album->fetch('album_user.tpl');
    }


    public function crea_album()
    {
        {
            $session = new \Utilities\U_Session;
            $username = $session->get_val('username');
            $v_album = new \View\V_Foto();
            $dati_album = $v_album->get_Dati();
            $title = $dati_album['title'];
            $desc = $dati_album['desc'];
            $cat = $dati_album['cat'];
            $categorie = $v_album->reimposta_categorie($cat); //dalla stringa al numero
            try
            {
                $album_details = new \Entity\E_Album($title, $desc, $categorie);
            }
            catch (\Exceptions\input_texts $ex)
            {
                //Catch per il titolo
                $v_album->assign('messaggio', $ex->getMessage());
                $this->crea_album();
            }
            \Foundation\F_Album::insert($album_details, $username);
            //tpl successo
        }
    }


    /**
     * funzione per elimanre un album
     */
    public function delete_album()
    {
        $v_Album = new \View\V_Album();
        $album_id = $v_Album->get_ID_Album();
        \Foundation\F_Album::delete($album_ID);
        $c_profilo = new \Control\C_Profilo();
        return $c_profilo->display_user();
    }


    public function smista()
    {
        $v_Album = new \View\V_Profilo();
        switch ($v_Album->getTask())
        {
            case 'Modulo_Crea_Album';
                return $this->modulo_Crea_Album();
            case 'Display_Album':
                return $this->display_photo_album();
            case 'Crea_Album':
                return $this->crea_album();
            case 'Elimina Album':
                return $this->delete_album();
        }
    }


}