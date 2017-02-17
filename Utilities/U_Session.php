<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

class U_Session
{
    /**
     * Il metodo, crea la sessione. Il tempo di scadenza dei dati server e del cookie di sessione è di 30 giorni 
     */
    public function __construct()
    {
        ini_set('session.gc_maxlifetime',MAX_TIME_SESSION);
        ini_set('session.cookie_lifetime',MAX_TIME_SESSION);
        session_start();
    }


    /**
     * Data la chiave, elimina tale valore dall'array $_SESSION
     * @param mixed $chiave
     */
    function unset_Val($chiave)
    {
        unset($_SESSION[$chiave]);
    }


    /**
     * Distrugge la sessione ed elimina il cookie per il controllo della sessione
     */
    function session_destroy()
    {
//        $cookie = new \Utilities\U_Cookie();
//        $cookie->eliminaCookie('sessione');
        session_destroy();
//        $cookie->eliminaCookie("PHPSESSID");
    }


    /**
     * Dati chiave e valore, crea un indice nell'array $_SESSION
     * @param mixed $chiave
     * @param mixed $valore
     */
    function set_Val($chiave, $valore)
    {
        $_SESSION[$chiave] = $valore;
    }


    /**
     * Data al chiave, legge il valore corrispondente e lo ritorna, oppure ritorna false
     * nel cason quella chiave non sia settata o sia null
     * @param mixed $chiave
     * @return mixed false se la chiave non esiste, mixed se la chiave esiste
     */
    function get_val($chiave)
    {
        if(isset($_SESSION[$chiave]))
        {
            return $_SESSION[$chiave];
        }
        return FALSE;
    }


}