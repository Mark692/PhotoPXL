<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Like
{
    /**
     * funzione per l'aggiunta di un like data l'username e la foto
     */
    public function add_like()
    {   $c_foto=new \Control\C_Photo();
        $v_User = new \View\V_Users();
        $id = $v_User->getID();
        $session = new \Utilities\U_Session();
        $username = $session->get_val('username');
        \Foundation\F_User::add_Like_to($id, $username);
        $c_foto=new \Control\C_Photo();
        return $c_foto->display_photo();
    }


    /**
     * funzione per la rimozione di un like data l'username e la foto
     */
    public function remove_like()
    {
        $v_User = new \View\V_Users();
        $id = $v_User->get_Dati_like();
        $session = new \Utilities\U_Session();
        $username = $session->get_val('username');
        \Foundation\F_User::remove_Like($username, $id);
        $c_foto=new \Control\C_Photo();
        return $c_foto->display_photo();
    }


    public function add_comments()
    {   
        $v_User = new \View\V_Users();
        $text = $v_User->get_Dati_commento();
        $session = new \Utilities\U_Session();
        $username = $session->get_val('username');
        $comment = new \Entity\E_Comment($text['commento'], $username, $text['id']);
        \Foundation\F_Comment::insert($comment);
        $c_foto=new \Control\C_Photo();//ricorda di inserire l'id della foto nel submit
        return $c_foto->display_photo();
    }


    public function remove_comments()
    {
        $v_User = new \View\V_Users();
        $text = $v_User->get_Dati_commento();
        $session = new \Utilities\U_Session();
        $username = $session->get_val('username');
        //può rimuovere solo mod admin e utente che ha inserito il commento
        \Foundation\F_Comment::remove($comment_ID);
        $c_foto=new \Control\C_Photo();
        return $c_foto->display_photo();
    }


    public function smista()
    {
        $V_Home = new \View\V_Home();
        Switch ($V_Home->getTask())
        {
            case 'add like':
            $this->add_like();
            break;
            case 'remove like':
            $this->remove_like();
            break;
            case 'add comments':
            $this->add_comments();
            break;
            case 'remove comments':
            $this->remove_comments();
            break;
        }
    }


}