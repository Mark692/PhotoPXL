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
     * Mostra il tamplete della Home di default in base al tipo di utente
     */
    public function set_home($tipo)
    {
        $this->display('home_default.tpl');
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
     *
     * Mostra il tamplete per un utente bannato
     */
    public function set_ban()
    {

        $this->display('bannato.tpl');
    }


    /**
     * setta la barra in base all'utente
     */
    public function set_Bar($role)
    {
        $ruolo=$this->imposta_ruolo($role);
        return $this->fetch('topbar_'.$ruolo.'.tpl');
    }


}