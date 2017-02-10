<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Upload extends \View\V_Basic
{
    public function impostaPaginaGuest()
    {
        
    }


    /**
     * 
     * Mostra il tamplete di home_dafault
     */
    public function set_home_default()
    {
        $this->display('home_default.tpl');
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     */
    public function set_Contenuto($contenuto)
    {
        $this->mainContent = $contenuto;
    }


    /**
     * Scrive nel tpl gli attributi della classe
     */
    public function inserisciContenuto()
    {
        $this->assign('content', $this->mainContent);
    }


    public function set_Bar($tipo)
    {
        $cont = $this->fetch('Topbar_'.$tipo.'.tpl');
        $this->assign('TopBar_', $cont);
    }


}