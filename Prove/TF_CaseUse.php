<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TF_CaseUse extends \Prove\TFun
{
    private $username;
    private $password;
    private $email;
    private $tot_uploads;
    private $last_up_date;

    private $e_userSTD;
    private $e_photo;
    private $e_comment;

    protected $separate;


    /**
     * Genera un \Foundation\F_User casuale
     * @return array of F_User object
     */
    public function __construct($show_2131='')
    {
        $this->separate = nl2br("\r\n").nl2br("\r\n")."----------------------------------------------".nl2br("\r\n");

        parent::__construct($show_2131);

        $this->separate;
        //Creazione di un oggetto E_User con dati casuali
        $this->username    = parent::rnd_str(7);
        $this->password    = parent::rnd_str(10);
        $this->email       = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $this->tot_uploads = rand(-4, 14);
        $this->last_up_date = time() - 1400000000;

        $this->e_userSTD = new \Entity\E_User_Standard("STD_".parent::rnd_str(7), "A PASS 2", "STD2@mail.com", $this->tot_uploads);
    }


    public function caso_d_uso()
    {
        $this->prova_utente();
        $this->prova_foto();
//        $this->prova_BLOB();
    }


    public function prova_utente()
    {
        //---Creazione Utente Standard casuale---\\
        echo("Creato utente: ".nl2br("\r\n"));
        print_r($this->e_userSTD);
        echo($this->separate);

        //---Inserimento utente nel DB---\\
        echo("Inserimento nel DB...".nl2br("\r\n"));
        \Foundation\F_User_Standard::insert($this->e_userSTD);

        //---Fetch dell'utente dal DB---\\
        $username = $this->e_userSTD->get_Username();
        $search_values = array("username" => $username);
        print_r(\Foundation\F_User::get_All($search_values));
        echo($this->separate);
    }


    public function prova_foto()
    {
        //---Creazione Foto casuale---\\
        $this->e_photo = new \Entity\E_Photo("Un titolo", "Una descrizione...", FALSE, PAESAGGI);
        echo("Creata foto: ".nl2br("\r\n"));
        print_r($this->e_photo);
        echo($this->separate);

        //---Inserimento foto nel DB---\\
        echo("Inserimento nel DB...".nl2br("\r\n"));
        $uploader = $this->e_userSTD->get_Username();
        \Foundation\F_Photo::insert($this->e_photo, $uploader);
        echo("Insert fatta!");
        $id = $this->e_photo->get_ID();
        echo("Compare l'ID della foto? -> ".$id.nl2br("\r\n"));
        echo($this->separate);

        //---Fetch della foto dal DB---\\
        echo("Ricerca via id".nl2br("\r\n"));
        $search_values = array("id" => $id);
        print_r(\Foundation\F_Photo::get_All($search_values));
        echo($this->separate);
    }


    public function prova_BLOB()
    {
        $foto = \Foundation\F_Photo::get_PROVA();
        echo("Ciao, sono l'echo: $foto".nl2br("\r\n").nl2br("\r\n"));

        echo("Io sono il print_r: ");
        print_r($foto);

        echo(nl2br("\r\n").nl2br("\r\n")."Io sono il VAR_DUMP: ");
        var_dump($foto);
    }








}