<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registration extends V_Home
{

    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public static function get_Dati()
    {
        $keys = array ('username', 'password', 'email');
        return parent::get_Dati($keys);
    }
    
    /**
     * ritorna il contunuto del tpl che da un messaggio di password cambiata correttamente
     */
    
    //da vedere il messaggio da inserire nel banner per errore login
    
    public function error($username, $role)
    {
        $banner = $this->fetch_banner($tpl = 'banner_login_errato');
        $this->assign('banner', $banner);
        $role = $this->imposta_ruolo($role);
        $this->standardHome($username, $role);
    }

}