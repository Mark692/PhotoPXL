<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

/**
 * Questa classe testa Foundation\F_User
 */
class TF_User extends TFun
{
    private $username;
    private $password;
    private $email;
    private $tot_uploads;
    private $last_up_date;

    private $e_prove;
    private $e_userSTD;
    private $e_userPRO;
    private $e_userMOD;
    private $e_userAdmin;

    private $parent_path = "Entity\E_User";


    /**
     * Genera un \Foundation\F_User casuale
     * @return array of F_User object
     */
    public function __construct($show_2131='')
    {
        parent::__construct($show_2131);
        //Creazione di un oggetto E_User con dati casuali
        $this->username    = parent::rnd_str(7);
        $this->password    = parent::rnd_str(10);
        $this->email       = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $this->tot_uploads = rand(-4, 14);
        $this->last_up_date = time() - 1400000000;

        $this->e_prove = new \Entity\E_User_Standard($this->username, $this->password, $this->email, $this->tot_uploads);

        $this->e_userSTD   = new \Entity\E_User_Standard("UsSTD", "A PASS...", "STD@mail.com", $this->tot_uploads);
        $this->e_userPRO   = new \Entity\E_User_PRO     ("UsPRO", "A PASS...", "PRO@mail.com", $this->tot_uploads);
        $this->e_userMOD   = new \Entity\E_User_MOD     ("UsMOD", "A PASS...", "MOD@mail.com", $this->tot_uploads);
        $this->e_userAdmin = new \Entity\E_User_Admin   ("UsADMIN", "A PASS...", "ADMIN@mail.com", $this->tot_uploads);

    }


    public function get_query()
    {
        parent::ogg2arr($this->e_userSTD, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));
        \Foundation\F_User_Standard::insert_this($this->e_userSTD);

        parent::ogg2arr($this->e_userPRO, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));
        \Foundation\F_User_PRO::insert_this($this->e_userPRO);

        parent::ogg2arr($this->e_userMOD, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));
        \Foundation\F_User_MOD::insert_this($this->e_userMOD);

        parent::ogg2arr($this->e_userAdmin, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));
        \Foundation\F_User_Admin::insert_this($this->e_userAdmin);
    }
}