<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Profilo
{
    /**
     * 
     * mostra il profilo di un utente in cui è possibile visualizzare 
     * la foto profilo i dati(nome user, email, ruolo) e le ultime 16 foto;
     */
    public function riepilogo_dati()
    {

        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user_datails = \Foundation\F_User::get_By_Username($username);
        $array_Photo_Db = \Foundation\F_Photo::get_By_User($username);

        $ultime_foto = $QUALCOSA_DA_SISTEMARE1->display_foto($array_Photo_Db);

        //recupero foto profilo
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $fotoprofilo);
        $V_Profilo->assign('foto_profilo', $user_datails["photo"]); //CONTROLLA SE IMPLEMENTATA IN FOUNDATION
        $V_Profilo->assign('array_ultime_foto', $ultime_foto);
        return $V_Profilo->display('profilo_riepilogo.tpl');
    }


    /**
     * ritorna il tpl per la modifica dei dati
     */
    public function modifica()
    {
        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');

        $user_datails = \Foundation\F_User::get_By_Username($username);
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $userdatails['photo']);

        $F_user = new \Foundation\F_User;
        $user_datails = $F_user->get_By_Username($username);
        //recupero foto profilo
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $fotoprofilo);

        return $V_Profilo->display('modifica profilo.tpl');
    }


    /**
     * update dei dati dati dell'utente
     */
    public function update()
    {
        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $dati = $V_Profilo->get_Dati();
        $new_username = $dati['username'];
        $new_password = $dati['password'];
        $new_email = $dati['email'];
        $new_details = new \Entity\E_User($new_username, $new_password, $new_email);
        \Foundation\F_User::update_Profile($new_details, $username);
    }


}