<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class USession
{
    /**
     * Il metodo, crea la sessione. Imposta la frequenza di passaggio del garbage collector
     * sul server a 1 passaggio ogni 20 richieste e il tempo di scadenza dei dati server a 1 ora
     */
    public function __construct()
    {
        ini_set('session.gc_divisor', 0);
        ini_set('session.gc_maxlifetime', 600);
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
    function unset_session()
    {
        $cookie = USingleton::getInstance('UCookie');
        $cookie->eliminaCookie('sessione');
        session_destroy();
        $cookie->eliminaCookie("PHPSESSID");
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