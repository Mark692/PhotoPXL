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
    {
        $v_User = new \View\V_Users();
        $id = $v_User->get_Dati_like();
        $session = new \Utilities\U_Session();
        $username = $session->get_val('username');
        \Foundation\F_User::add_Like_to($id, $username);
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
    }


    public function add_comments()
    {
        $v_User = new \View\V_Users();
        $text= $v_User->get_Dati_commento();
        $session = new \Utilities\U_Session();
        $username= $session->get_val('username');
        $comment = new \Entity\E_Comment($text['commento'], $username, $text['id']);
        \Foundation\F_Comment::execute_Query($comment);
    }
    
    public function remove_comments()
    {
        $v_User = new \View\V_Users();
        $text= $v_User->get_Dati_commento();
        $session = new \Utilities\U_Session();
        $username= $session->get_val('username');
        ;
        \Foundation\F_Comment::remove($comment_ID);
    }

}