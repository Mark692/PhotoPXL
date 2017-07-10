<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUseView;

/**
 * Questa classe si occupa di testare metodi di classe di V_Home
 */
class CU_Home
{
    /**
     * Mostra la home del sito per un utente loggato
     *
     * @param string $username l'untente che è loggato
     */
    public function standardhome($username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $array_photo = \Entity\E_Photo::get_MostLiked($username, $role);
        \View\V_Home::standardHome($array_photo, $username);
    }


    /**
     * Mostra la home del sito per un utente loggato con un banner di Warning
     *
     * @param string $username l'untente che è loggato
     */
    public function notAllowed($username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $array_photo = \Entity\E_Photo::get_MostLiked($username, $role);
        \View\V_Home::notAllowed($array_photo, $username);
    }


    /**
     * Mostra la pagina di login con un banner di avviso Banned
     *
     */
    public function banned()
    {
        \View\V_Home::bannedHome();
    }


    /**
     * Mostra la home del sito per un utente loggato con un banner di Errore
     *
     * @param string $username l'untente che è loggato
     */
    public function error($username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $array_photo = \Entity\E_Photo::get_MostLiked($username, $role);
        \View\V_Home::error($array_photo, $username);
    }


    /**
     * Mostra il risultato della ricerca per una categoria
     *da contorllore perchè non funziona
     * @param string $username l'untente che è loggato
     * @param string $cats la categoria per il quale si vuole fare la ricerca
     */
    public function showPhotoCollection($username, $cats)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $array_photo = \Entity\E_Photo::get_By_Categories($cats, $username, $role);
        \View\V_Home::showPhotoCollection($array_photo, $username);
    }


    /**
     * Mostra la pagina di login 
     *
     */
    public function login()
    {
        \View\V_Home::login();
    }


    /**
     * Mostra la pagina di registrazione
     *
     */
    public function registration()
    {
        \View\V_Home::registration();
    }
    
    


}