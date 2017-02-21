<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Mod
{
    /**
     * ritorna il modulo tpl per bannare
     * @return type
     */
    public function modulo_banna()
    {
        $v_mod = new \View\V_Mod();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $lista_utenti = \Foundation\F_User_MOD::get_UsersList();
        $array_post = $v_mod->getdati();
        $page_toView = $array_post['page_toView'];
        if($page_toView == NULL)
        {
            $page_toView = 1;
        }
        if($lista_utenti['photo_tot'] !== 0)
        {
            $page_tot = ceil($lista_utenti['user_tot'] / USER_PER_PAGE);
            $v_mod->assign('page_tot', $page_tot);
            $v_mod->assign('page_toView', $page_toView);
            $v_mod->assign('lista_utenti', $lista_utenti['username']);
        }
        else
        {
            $v_mod->assign('message', "Nessun Username trovato");
        }
        $v_mod->assign('utente', $username);
        $v_mod->assign('role', $role);
        return $v_mod->fetch('modulo_banna.tpl');
    }


    /**
     * funzione che banna uno o più utenti
     * @return type tpl
     */
    public function ban()
    {
        $v_mod = new \View\V_Mod();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user = $v_mod->getdati(); //array di username da bannare
        if(in_array($username, $user) !== FALSE)
        {
            foreach($user as $valore)
            {
                \Foundation\F_User_MOD::ban($valore);
            }
            return $v_mod->fetch('utenti_bannati_con_successo');
        }
        else
        {
            $v_mod->assign('messaggio', 'non puoi bannare te stesso!');
            return $this->modulo_banna();
        }
    }


    public function smista()
    {
        $V_Mod = new \View\V_Mod();
        switch ($V_Mod->getTask())
        {
            case 'modulo_ban';
                return $this->modulo_banna();
            case 'ban':
                return $this->ban();
        }
    }


}