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
    protected $separate;


    /**
     * Genera un \Foundation\F_User casuale
     * @return array of F_User object
     */
    public function __construct($show_2131='')
    {
        $this->separate = nl2br("\r\n")."----------------------------------------------".nl2br("\r\n").nl2br("\r\n");

        parent::__construct($show_2131);

        $this->separate;
        //Creazione di un oggetto E_User con dati casuali
        $this->username    = parent::rnd_str(7);
        $this->password    = parent::rnd_str(10);
        $this->email       = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $this->tot_uploads = rand(-4, 14);
        $this->last_up_date = time() - 1400000000;

        $this->e_prove = new \Entity\E_User_Standard($this->username, $this->password, $this->email, $this->tot_uploads);

        $this->e_userSTD   = new \Entity\E_User_Standard("STD".parent::rnd_str(7), "A PASS...", "STD@mail.com", $this->tot_uploads);
        $this->e_userPRO   = new \Entity\E_User_PRO     ("PRO".parent::rnd_str(7), "A PASS...", "PRO@mail.com", $this->tot_uploads);
        $this->e_userMOD   = new \Entity\E_User_MOD     ("MOD".parent::rnd_str(7), "A PASS...", "MOD@mail.com", $this->tot_uploads);
        $this->e_userAdmin = new \Entity\E_User_Admin   ("ADMIN".parent::rnd_str(7), "A PASS...", "ADMIN@mail.com", $this->tot_uploads);
    }


    /**
     * Prova delle insert e delle get per ogni ruolo. Creano utenti casuali, li
     * salvano sul DB e provano le get con vari parametri
     */
    public function insert_and_get()
    {
        parent::ogg2arr($this->e_userSTD, $this->parent_path);
        echo(nl2br("\r\n"));
        \Foundation\F_User_Standard::insert($this->e_userSTD);
        echo("Funzione get_by( _username_ ) - Risultati: ".nl2br("\r\n"));
        $getby_STD = \Foundation\F_User::get_by($this->e_userSTD->get_Username());
        print_r($getby_STD);
        echo($this->separate);


//        parent::ogg2arr($this->e_userPRO, $this->parent_path);
//        echo(nl2br("\r\n"));
//        \Foundation\F_User_PRO::insert($this->e_userPRO);
//        echo("Funzione get_by( _password_ ) - Risultati: ".nl2br("\r\n"));
//        $getby_PRO = \Foundation\F_User::get_by($this->e_userPRO->get_Username());
//        print_r($getby_PRO);
//        echo($this->separate);
//
//        parent::ogg2arr($this->e_userMOD, $this->parent_path);
//        echo(nl2br("\r\n"));
//        \Foundation\F_User_MOD::insert($this->e_userMOD);
//        echo("Funzione get_by( _email_ ) - Risultati: ".nl2br("\r\n"));
//        $getby_MOD = \Foundation\F_User::get_by($this->e_userMOD->get_Username());
//        print_r($getby_MOD);
//        echo($this->separate);
//
//        parent::ogg2arr($this->e_userAdmin, $this->parent_path);
//        echo(nl2br("\r\n"));
//        \Foundation\F_User_Admin::insert($this->e_userAdmin);
//        echo("Funzione get_by( _ruolo_ ) - Risultati: ".nl2br("\r\n"));
//        $getby_Admin = \Foundation\F_User::get_by($this->e_userAdmin->get_Username());
//        print_r($getby_Admin);
//        echo($this->separate);
    }

    public function update()
    {
        $getby_STD = \Foundation\F_User::get_by("MODFdVZVXI");
        print_r($getby_STD);
        echo(nl2br("\r\n"));







//        $getby_PRO = \Foundation\F_User::get_by($this->e_userPRO->get_Username());
//        $getby_MOD = \Foundation\F_User::get_by($this->e_userMOD->get_Username());
//        $getby_Admin = \Foundation\F_User::get_by($this->e_userAdmin->get_Username());

        $newSTD = array(
            "username" => "MODFdVZVXI",
            "password" => "CAMBIATA",
            "email" => "DOH@beh.boh",
            "role" => "4",
            "up_Count" => 1,
            "last_Upload" => 5215435);

        $newPRO = array(
            "username" => "PRO1?",
            "password" => "PROpass",
            "email" => "boh@boh.boh",
            "role" => "3",
            "up_Count" => 99,
            "last_Upload" => 55435);

        $newMOD = array(
            "username" => "MOD!",
            "password" => "MODDDDDDD",
            "email" => "boh@boh.boh",
            "role" => "3",
            "up_Count" => 99,
            "last_Upload" => 55435);

        $newAD = array(
            "username" => "ADADAD-",
            "password" => "eh eh -",
            "email" => "boh@boh.boh",
            "role" => "3",
            "up_Count" => 99,
            "last_Upload" => 55435);

        $set = '';
        foreach($getby_STD as $key => $value)
        {
            if($getby_STD[$key] !== $newSTD[$key])
            {
                $set .= '`'.$key.'`=\''.$newSTD[$key].'\',';
            }
            $value = 3;
        }

        $_table = "users";
        $_primaryKey = "username";

        $set = substr($set, 0, -1); //Removes the trailing char: ","
        $where = $getby_STD['username'];
        $query = "UPDATE `$_table` "
               . "SET $set "
               . "WHERE `$_primaryKey`='$where'";
        echo("My query: ".nl2br("\r\n").$query.nl2br("\r\n").nl2br("\r\n"));

        echo("Foundation Query: ".nl2br("\r\n"));
        echo(\Foundation\F_User::update($newSTD, $getby_STD));

        \Foundation\F_User::update($getby_PRO, $newPRO);
        \Foundation\F_User::update($getby_MOD, $newMOD);
        \Foundation\F_User::update($getby_Admin, $newAD);
    }
}