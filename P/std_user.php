<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

class std_user extends \P\prova
{
    private $username;
    private $std;

    /*
     * Crea un utente standard casuale
     */
    public function __construct()
    {
        $username = parent::rnd_str();
        $password = parent::rnd_str(15);
        $email = "prova@ita.it";

        $this->username = $username;
        $this->std = new \Entity\E_User_Standard($username, $password, $email);
    }

    /*
     * Inserisce l'utente nel DB
     */
    public function INSERT()
    {
        \Foundation\F_User_Standard::insert($this->std);
        var_dump($this->std);
        echo(nl2br("\r\n"));
        echo("Controlla: ".nl2br("\r\n"));
        echo(" - 'users': contiene i dettagli qui sopra scritti".nl2br("\r\n"));
        echo(" - 'profile_pic': contiene l'username, la pic base ed il tipo giusto di pic");
    }

    /*
     * Cambia i valori di LastUpload e UpCount nel DB
     */
    public function UPDATECOUNTERS()
    {
        $this->std->set_Last_Upload(rand(1000, 40000));
        $this->std->set_up_Count(rand(0, 15));
        \Foundation\F_User_Standard::update_Counters($this->std);
        var_dump(array(
            "Username" => $this->std->get_Username(),
            "Last Upload" => $this->std->get_Last_Upload(),
            "UpCount" => $this->std->get_up_Count())
                );
        echo(nl2br("\r\n"));
        echo("Controlla: ".nl2br("\r\n"));
        echo(" - 'users': contiene i dettagli qui sopra scritti".nl2br("\r\n"));
    }

    /*
     * Cambia il ruolo dell'utente in PRO
     */
    public function BECOMEPRO()
    {
        \Foundation\F_User_Standard::becomePRO($this->std->get_Username());
        echo(nl2br("\r\n"));
        echo("Controlla: ".nl2br("\r\n"));
        echo(" - 'users': contiene l'utente \"".$this->std->get_Username()."\" con il ruolo 2".nl2br("\r\n"));
    }
}