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
     * mostra il profilo dell'untete
     */
    public function showProfile($array_user,$immagine_profilo)
    {
       
        $this->assign('utente',$array_user);
        $this->assign('immagine_profilo',$immagine_profilo);
        $role=$array_user['role'];
        $this->home($role, $tpl='profilo');    
    }

    
    //da sistemare perchè non mi legge i banner
    
    
    /**
     * ritorna il contunuto del tpl che da un messaggio di password cambiata correttamente
     */
    public function banner_password($username,$role)
    {
        $banner = $this->fetch_banner($tpl='banner_password_cambiata');
        $this->standardHome($username, $role, $banner);
    }
    
    public function fetch_banner($tpl)
    {
        //$ruolo = $this->imposta_ruolo($role);
        $banner = $this->fetch($tpl.'.tpl');
        return $banner;
    }
    /**
     * ritorna il contunuto del tpl che da un messaggio di email cambiata correttamente
     */
    public static function banner_email()
    {
        $contenuto = $this->fetch('email_cambiata_ok.tpl');
        return $contenuto;
    }

}