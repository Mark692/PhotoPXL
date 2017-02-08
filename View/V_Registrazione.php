<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registazione extends View
{
    /**
     * @var string $_layout
     */
    private $_layout = '';
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono 
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     * @return array
     */
    public function get_Dati_registazione()
    {
        $chiavi_registrazione = array ('username', 'password', 'email');
        $dati_reg = array ();
        foreach ($chiavi_registrazione as $k => $dato)
        {
            $dati_reg[$k] = $_REQUEST[$k];
        }
        return $dati_reg;
    }
 /**
     * Grazie a questa funzione all'interno della variabile $dati_log vengono 
     * registrati tutti i dati inviati tramite POST dal modulo di login
     * @return array
     */
    public function get_Dati_login()
    {
        $chiavi_registrazione = array ('username', 'password');
        $dati_log = array ();
        foreach ($chiavi_registrazione as $k => $dato)
        {
            $dati_log[$k] = $_REQUEST[$k];
        }
        return $dati_log;
    }

    /**
     * imposta il layout
     *
     * @param string $layout
     */
    public function set_Layout($layout)
    {
        $this->_layout = $layout;
    }


    /**
     * Ritorna il contenuto del template che si vuole visualizzare 
     * @return string
     */
    public function processa_Template()
    {
        $contenuto = $this->fetch('da definire_'.$this->_layout.'.tpl');
        return $contenuto;
    }


    /**
     * Assegna a smarty i dati della registrazione passati come parametro
     * @param array $dati
     * @param int $data
     */
    public function set_Dati($dati)
    {
        $this->assign('username', $dati['username']);
        $this->assign('password', $dati['password']);
        $this->assign('email', $dati['email']);
    }


}