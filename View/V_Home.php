<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Home extends V_Basic
{
    private $mainContent;
    /**
     *
     * Mostra il tamplete della Home di default
     */
    public function standardHome($username, $role,$banner='')
    {
        $tpl = $this->set_home($username);
        $this->set_Cont_menu_user($role);
        $this->set_Contenuto_Home($tpl);
        $this->assign($banner);
        $this->display('home_default.tpl');
    }


    /**
     *
     * Mostra il tamplete della Home di per i non loggati
     */
    public function login()
    {
        $tpl = 'login';
        $this->set_Cont_menu_user($role = 'ospite');
        $this->set_Contenuto_Home($tpl);
        $this->display('home_default.tpl');
    }


    /**
     * questa funzione serve per impostare qualsiasi pagina del sito
     * @param type $username
     * @param type $role
     * @param type $contenuto è il fetch di un tpl
     */
    public function home($role, $tpl)
    {
        $this->set_Cont_menu_user($role);
        $this->set_Contenuto_Home($tpl);
        $this->display('home_default.tpl');
    }


    /**
     * mostra la home page con messsaggio di errore 
     */
    public function notAllowed()
    {
        $this->assign('messagio_errore', 'non consentito');
        $this->standardHome();
    }


    /**
     *
     * Mostra il tamplete per dire ad un utemte che è stato bannato
     */
    public function bannedHome()
    {
        $this->display('banned.tpl');
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     * il contenuto non è altro che il fetch di altri tpl
     */
    public function set_Contenuto_Home($tpl)
    {
        $mainContent = $this->fetch_home($tpl);
        $this->assign('content', $mainContent);
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_Cont_menu_user($role)
    {
        $cont = $this->fetch_Bar($role);
        $this->assign('menu_user', $cont);
    }


    /**
     * restituisce il contnto del tpl in base all'utente
     */
    public function fetch_Bar($role)
    {
        //$ruolo = $this->imposta_ruolo($role);
        $contenuto = $this->fetch('menu_user_'.$role.'.tpl');
        return $contenuto;
    }
    
    /**
     * restituisce il contnto del tpl in base all'utente
     */
    public function fetch_home($tpl)
    {
        //$ruolo = $this->imposta_ruolo($role);
        $contenuto = $this->fetch($tpl.'.tpl');
        return $contenuto;
    }

    /**
     * setta il contenuto della homepage in base al fatto l'utente sia loggato oppure no
     * @param type $username prende il valore da session
     * @return type tpl
     */
    public function set_home($username = FALSE)
    {
        if($username === FALSE)
        {
            return $tpl='home_ospite';
        }
        else
        {
            return $tpl='home_loggati';
        }
    }


    /**
     * visualizza una pagina di errore per caricamento foto 
     * @param type $messaggio
     */
    public function error($messaggio)
    {
        $this->assign('messaggio', $messaggio);
        $contenuto = $this->fetch('pagina_errore.tpl');
        return $contenuto;
    }


}