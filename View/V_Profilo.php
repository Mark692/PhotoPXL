<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @access public
 * @package View
 */

namespace View;

class V_Profilo extends V_Home
{
    //METODI STATICI -> CONTROL\\

    //A BENEDETTA SERVE LA FUNZIONE STATICA ::home() pagina profilo con la LISTA (THUMBNAIL = MINIATURE) degli album/foto
    public static function home($qualche_parametro, $parametro2, $tre, $quattro, $chenesoquantiteneservono)
    {
        $v = new V_Basic();
        //VISUALIZZA LA HOME
    }


    //A BENEDETTA SERVE LA FUNZIONE STATICA ::banner() DEVE AVVERTIRE L'UTENTE CHE L'AZIONE è AVVENUTA CON SUCCESSO
    public static function banner()
    {
        $v = new V_Basic();
        //MOSTRA IL BANNER = TESTO. FINE.
    }


    //METODI BASE - NON STATICI!!!\\


    /**
     * Grazie a questa funzione all'interno della variabile $dati vengono
     * registrati tutti i dati inviati tramite POST dal modulo di modifica del profilo
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('username', 'page_toView', 'page_tot', 'order', 'email', 'tmp_name', 'size', 'type');
        return parent::get_Dati($keys);
    }


    /**
     * mostra il profilo dell'utente
     */
    public function showProfile($array_user, $pic_profile, $thumbnail)
    {

        $this->assign('user_details', $array_user);
        $this->assign('pic_profile', $pic_profile);
        $this->assign('thumbnail', $thumbnail);
        $role = $this->imposta_ruolo($array_user['role']);
        $this->assign('role', $role);
        $this->home($role, $tpl = 'showProfile');
    }


    /**
     * mostra il modulo tpl per la modifica dei dati del profilo
     */
    public function showEditProfile($array_user, $pic_profile, $thumbnail)
    {

        $this->assign('user_details', $array_user);
        $this->assign('pic_profile', $pic_profile);
        $this->assign('thumbnail', $thumbnail);
        $role = $this->imposta_ruolo($array_user['role']);
        $this->assign('role', $role);
        $this->home($role, $tpl = 'EditProfile');
    }


    /**
     * ritorna il contunuto del tpl che da un messaggio di password cambiata correttamente
     */
    public function banner_password($username, $role)
    {
        $banner = $this->fetch_banner($tpl = 'banner_password_cambiata');
        $this->assign('banner', $banner);
        $role = $this->imposta_ruolo($role);
        $this->standardHome($username, $role);
    }


    /**
     * ritorna il contunuto del tpl che da un messaggio di email cambiata correttamente
     */
    public function banner_email($username, $role)
    {
        $banner = $this->fetch_banner($tpl = 'banner_email_cambiata');
        $this->assign('banner', $banner);
        $role = $this->imposta_ruolo($role);
        $this->standardHome($username, $role);
    }


}