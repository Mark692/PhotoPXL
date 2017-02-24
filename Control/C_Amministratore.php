<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Amministartore
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
        //tpl con checkbox
        return $v_mod->fetch('modulo_banna.tpl');
    }


    public function modulo_cambiaruolo()
    {
        $v_amministratore=new \View\V_Amministratore();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $lista_utenti = \Foundation\F_User_MOD::get_UsersList();
        $array_post = $v_amministratore->getdati();
        $ruoli=$v_amministratore->imposta_ruolo();
        $v_amministratore->assign('role',$ruoli);
        $page_toView = $array_post['page_toView'];
        if($page_toView == NULL)
        {
            $page_toView = 1;
        }
        if($lista_utenti['photo_tot'] !== 0)
        {
            $page_tot = ceil($lista_utenti['user_tot'] / USER_PER_PAGE);
            $v_amministratore->assign('page_tot', $page_tot);
            $v_amministratore->assign('page_toView', $page_toView);
            $v_amministratore->assign('lista_utenti', $lista_utenti['username']);
        }
        else
        {
            $v_amministratore->assign('message', "Nessun Username trovato");
        }
        $v_amministratore->assign('utente', $username);
        $v_amministratore->assign('role', $role);
        //tpl con checkbox
        return $v_amministratore->fetch('modulo_cambiaruolo.tpl');
    }


    /**
     * funzione che banna uno o più utenti
     * @return type tpl
     */
    public function ban()
    {
        $v_amministratore = new \View\V_Amministratore();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user = $v_amministratore->getdati(); //array di username da bannare
        if(in_array($username, $user) !== FALSE)
        {
            foreach($user as $valore)
            {
                \Foundation\F_User_MOD::ban($valore);
            }
            return $v_amministratore->fetch('utenti_bannati_con_successo');
        }
        else
        {
            $v_amministratore->assign('messaggio', 'non puoi bannare te stesso!');
            return $this->modulo_banna();
        }
    }
    
     /**
     * funzione che cambia il ruolo a uno o più utenti
     * @return type tpl
     */
    public function change_role()
    {
        $v_amministratore = new \View\V_Amministratore();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user = $v_amministratore->getdati(); 
        $ruoli=$v_amministratore->reimposta_ruolo($user['role']);
        array_push($user, $ruoli);
        if(in_array($username, $user) !== FALSE)
        {
            \Foundation\F_User_Admin::change_role($user['username'], $user['ruoli']);
            return $v_amministratore->fetch('successo');
        }
        else
        {
            $v_amministratore->assign('messaggio', 'non puoi cambiare  il ruolo a te stesso!');
            return $this->modulo_cambiaruolo();
        }
    }


    public function smista()
    {
        $v_amministratore = new \View\V_Mod();
        switch ($v_amministratore->getTask())
        {
            case 'modulo_ban';
                return $this->modulo_banna();
            case 'ban':
                return $this->ban();
            case 'modulo_cambia_ruolo';
                return $this->modulo_cambiaruolo();
            case 'cambia_ruolo';
                return $this->change_role();
        }
    }


}