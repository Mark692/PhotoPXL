<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

/**
 * Questa classe testa i vari metodi di E_User.
 * Viene fornito output per ogni metodo testato.
 */
class TE_User extends \Prove\TFun
{
    private $username;
    private $password;
    private $email;
    private $tot_uploads;
    private $last_up_date;
    private $e_prove;


    /**
     * Genera un \Entity\E_User casuale
     * @return array of E_User object
     */
    public function __construct()
    {
        parent::__construct();
        //Creazione di un oggetto E_User con dati casuali
        $this->username = parent::rnd_str(7);
        $this->password = parent::rnd_str(10);
        $this->email = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $this->tot_uploads = rand(-4, 14);
        $this->last_up_date = time() - 1400000000;

        $this->e_prove = new \Entity\E_User_Standard($this->username, $this->password, $this->email, $this->tot_uploads);
    }


    /**
     * Testa le funzioni Set e Get di E_User
     */
    public function T_SetGet($i)
    {
        echo("__________________________________________________________________".nl2br("\r\n"));
        echo("Prova di T_SetGet()".nl2br("\r\n").nl2br("\r\n"));

        $username = array(
            "NuovoUsername",
            "Nu0v0_Username.",
            "|V(_)0\/0 (_)532|V4|\/|3");

        $password = array(
            "Nuova Password",
            "Nu0v5 P455wòr|)",
            "|V(_)0\/4 |*455\/\/02[)");

        $mail = array(
            "chiocciola@libero.it",
            "ch1òcc101à@118320.17",
            "(|-|10((1014@118320.17");

        echo("Test dei metodi Set e Get. Formato: Originale -> get_()".nl2br("\r\n").nl2br("\r\n"));

        $this->e_prove->set_Username($username[$i]);
        echo("Username: ".$username[$i]." -> ".$this->e_prove->get_Username().nl2br("\r\n"));

        $this->e_prove->set_Password($password[$i]);
        echo("Password: ".$password[$i]." -> ".$this->e_prove->get_Password().nl2br("\r\n"));

        $this->e_prove->set_Email($mail[$i]);
        echo("Mail: ".$mail[$i]." (".strlen($mail[$i])."),"
        ." Mail impostata: ".$this->e_prove->get_Email()." (".strlen($this->e_prove->get_Email()).")"
        .nl2br("\r\n"));

        echo("var_dump = ");
        var_dump($this->e_prove->get_Email());
        echo(nl2br("\r\n").nl2br("\r\n").nl2br("\r\n"));
    }


    public function try_it()
    {
        for($i = 0; $i < 3; $i++)
        {
            try //UN TRY E' SUFFICIENTE, NON SO PERCHè
            {
                try
                {
                    $this->T_SetGet($i);
                }
                catch(\Exceptions\input_texts $ex)
                {
                    echo("Catch #1!! -> ".$ex->getMessage());
                }
            }
            catch(\Exceptions\input_texts $ex) //INUTILE. MAI LANCIATO
            {
                echo("Catch #2!! -> ".$ex->getMessage());
            }
        }
    }


    public function test()
    {
        $parole = array(
            "Username",
            "User name",
            "User_Name",
            "User.-.",
            "     3       ",
            "User9m"
        );

        foreach($parole as $stringa)
        {
            echo($stringa);
            $allowed = array('-', '_', '.'); //Allows -_. inside a Username
            if(ctype_alnum(str_replace($allowed, '', $stringa))) //Removes the allowed chars and checks whether the string is Alphanumeric
            {
                echo(" Ok!");
                echo(nl2br("\r\n"));
            }
            else
            {
                echo(" Sbagliato!");
                echo(nl2br("\r\n"));
            }
        }
    }


}