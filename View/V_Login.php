<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Login extends V_Home
{
    /**
     * Grazie a questa funzione all'interno della variabile $dati_log vengono
     * registrati tutti i dati inviati tramite POST dal modulo di login
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('username', 'nonce');
        return parent::get_Dati($keys);
    }


    /**
     * visualizza una pagina di errore per login
     * @param type $messaggio
     */
    public function error($messaggio)
    {
        $tpl = 'login';
        $this->set_Cont_menu_user($role = 'ospite');
        $this->set_Contenuto_Home($tpl);
        $this->display('home_default.tpl');
        $this->assign('messaggio', $messaggio);
        $this->display('pagina_errore.tpl');
    }


}