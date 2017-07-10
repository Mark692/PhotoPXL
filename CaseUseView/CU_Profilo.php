<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUseView;

/**
 * Questa classe si occupa di testare metodi di classe di V_Profilo
 */
class CU_Profilo
{
    /**
     * Mostra la pagina con le informazioni riguardanti un dato utente con le relative
     * thumbnail foto/album
     *
     * @param string $username l'utente per il quale si vuole visualizzare il profilo
     * @param string $user_Watching L'utente loggato
     */
    public function home_profile($username, $user_Watching)
    {
        $role = \Entity\E_User::get_DB_Role($user_Watching);
        $array_photo = \Entity\E_Photo::get_By_User($username, $user_Watching, $role);
        $user_details = \Entity\E_User::get_UserDetails($username);
        \View\V_Profilo::home($user_Watching, $user_details, $array_photo);
    }


    /**
     * Mostra la home del sito per un utente loggato con un banner di Successo
     *
     * @param string $username l'untente che è loggato
     */
    public function banner($username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $array_photo = \Entity\E_Photo::get_MostLiked($username, $role);
        \View\V_Profilo::banner($array_photo, $username);
    }


    /**
     * Mostra la pagina di modifica delle informazioni riguardanti un dato utente con le relative
     * thumbnail foto/album
     *
     * @param string $username L'utente loggato
     */
    public function showEditProfile($username)
    {
        $role = \Entity\E_User::get_DB_Role($username);
        $user_details = \Entity\E_User::get_UserDetails($username);
        $array_photo = \Entity\E_Photo::get_By_User($username, $username, $role);
        \View\V_Profilo::showEditProfile($user_details, $array_photo);
    }


}