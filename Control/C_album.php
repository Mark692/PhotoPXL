<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Album
{
    public function Crea_Album()
    {
        $v_Album = new \View\V_Album;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $v_Album->assign('utente', $username);
        $v_Album->assign('role', $role);
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
        $array_post = $v_Album->getdati('id', 'page_toView', 'page_tot','order');
        //page_to_view sarà gestito nel template con una form dove verrà incrementato per vedere la pagina succesiva
        //alrimenti decrementato
        $page_toView = $array_post['page_toView'];
        if($page_toView == NULL)
        {
            $page_toView = 1;
        }
        $page_tot = $array_post['page_tot'];
        if($page_tot == NULL)
        {
            //richiamo funzione dal database $page_tot
            $v_Album->assign('page_tot', $page_tot);
        }
        else
        {
            $v_Album->assign('page_tot', $page_tot);
        }
        $id_album = $array_post['id'];
        $album_details = \Foundation\F_Album::get_By_ID($id_album);
        $order=$array_post['order'];
        if($order==NULL){
            $order=FALSE;
        }
        $v_Album->assign('order', $order);
        $thumbnail = \Foundation\F_Photo::get_By_Album($id_album, $page_toView, $order);
        $categories = $v_Album->assign('foto_deteils', $thumbnail);
        $v_Album->assign('categories', $categories);
        $v_Album->assign('id_thumbnail', $thumbnail['id']);
        $v_Album->assign('thumbnail', $thumbnail['thumbnail']);
        if($album_details['username'] != $username)
        {
            if($role >= \Utilities\Roles::MOD)
            {
                return $v_Album->fetch('foto_altri_user_mod.tpl');
            }
            elseif($role == \Utilities\Roles::BANNED)
            {
                $Session->unset_session();
            }
            $v_Album->fetch('foto_altri_user.tpl');
        }
        elseif($role == \Utilities\Roles::BANNED)
        {
            $Session->unset_session();
        }
        $v_Album->fetch('foto_user.tpl');
    }


}