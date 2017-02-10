<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UCookie
{
    public function __construct()
    {
        //vuoto
    }


    /**
     * Setta un cookie
     */
    public function set_Cookie($cookie = 'cookieCheck', $value = 'activated', $path = '/')
    {
        setcookie($cookie, $value, 0, $path);
    }


    /**
     * Controlla se il cookie "cookieCheck" è settato.
     * @return bool
     */
    public function check_Cookie()
    {
        if (isset($_COOKIE['cookieCheck']))
            return true;
        else
            return false;
    }


    /**
     * Dato un nome, elimina il cookie con quel nome
     * @param string $cookie nome del cookie
     */
    public function unset_cookie($cookie, $posizione = '/')
    {
        setcookie($cookie, "", time() - 3600, $posizione);
    }


}