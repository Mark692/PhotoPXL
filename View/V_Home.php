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
    public function standardHome()
    {
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
     */
    public function set_Contenuto($contenuto)
    {
        $this->mainContent = $contenuto;
        $this->assign('content', $this->mainContent);
    }

    /**
     * setta la barra in base all'utente
     */
    public function set_Bar($role)
    {
        $ruolo = $this->imposta_ruolo($role);
        return $this->fetch('topbar_'.$ruolo.'.tpl');
    }
    /**
     * visualizza una pagina di errore per caricamento foto 
     * @param type $messaggio
     */

    public function error($messaggio)
    {
        $this->assign('messaggio',$messaggio);
        $this->display('pagina_errore.tpl');
    }

}