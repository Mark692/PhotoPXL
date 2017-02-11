<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Home extends \View\V_Basic
{
    
    private $mainContent;
    

    /**
     * 
     * Mostra il tamplete della Home di default 
     */
    public function set_home()
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

    /**
     * 
     */
    public function set_Bar($tipo)
    {
        $cont = $this->fetch('Topbar_'.$tipo.'.tpl');
        $this->assign('TopBar', $cont);
    }


}