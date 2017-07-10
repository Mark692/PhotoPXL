<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUseView;

/**
 * Questa classe si occupa di testare metodi di classe di V_Registration
 */
class CU_Registration
{
    /**
     * Mostra la pagina di login con messaggio di errore 
     *
     */
    public function errorLogin()
    {
        \View\V_Registration::error_login();
    }


    /**
     * Mostra la pagina di registrazione con messaggio di errore 
     *
     */
    public function errorRegistration()
    {
        \View\V_Registration::error_registration();
    }


}