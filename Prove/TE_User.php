<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

/**
 * Questa classe testa i vari oggetti Entity ed i metodi di classe. Viene fornito
 * output per ogni metodo testato
 */
class TE_User extends \Prove\TFun
{
    private $username;
    private $password;
    private $email;
    private $ruolo;
    private $tot_uploads;
    private $last_up_date;

    private $e_user;


    /**
     * Genera un \Entity\E_User casuale
     * @return array of E_User object
     */
    public function __construct()
    {
        //Creazione di un oggetto E_User con dati casuali
        $this->username    = parent::rnd_str(7);
        $this->password    = parent::rnd_str(10);
        $this->email       = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $this->ruolo       = rand(0, 4);
        $this->tot_uploads = rand(-4, 14);
        $this->last_up_date = time() - 1400000000;

        $this->e_user = new \Entity\E_User($this->username, $this->password, $this->email, $this->ruolo, $this->tot_uploads);
    }


    /**
     * Testa il costruttore di E_User.
     * Dato che il costruttore si basa su delle set vengono testate con dati casuali
     */
    public function T_uconstr()
    {
        //Stampa l'oggetto casuale E_User
        echo("Oggetto utente con costruttore ridotto: niente timestamp.".nl2br("\r\n"));
        parent::ogg2arr($this->e_user);

        echo(nl2br("\r\n").nl2br("\r\n"));

        //Stampa un oggetto E_User2 ma con ultimo upload fatto molto tempo fa
        $e_user2 = new \Entity\E_User($this->username, $this->password, $this->email, $this->ruolo, $this->tot_uploads, $this->last_up_date);
        echo("Oggetto utente con costruttore completo: timestamp nel passato.".nl2br("\r\n"));
        parent::ogg2arr($e_user2);
    }


    /**
     * Testa le funzioni Set e Get di E_User
     */
    public function T_SetGet()
    {
        //Dati da usare
        $username = array("NuovoUsername", "NùòvòUsern4m3", "|V(_)0\/0 (_)532|V4|\/|3", "|\||_|[]|/[] |_|$[-/2|\|/-\/\/\[-");
        $password = array("Nuova Password", "Nu0v5 P455wòr|)", "|V(_)0\/4 |*455\/\/02[)", "|\||_|[]|//-\ |>/-\$$\|/[]/2|)");
        $mail = array("chiocciola@libero.it", "ch1òcc101à@118320.17", "(|-|10((1014@118320.17", "(#![]((![]|_/-\@|_!|3[-/2[].!'|'");
        //Testa i metodi dell'oggetto con i dati di sopra
        echo("Test dei metodi Set e Get. Formato: Originale -> get_()".nl2br("\r\n").nl2br("\r\n"));
        for($i=0; $i<count($username); $i++)
        {
            $this->e_user->set_username($username[$i]);
            echo("Username: ".$username[$i]." -> ".$this->e_user->get_username().nl2br("\r\n"));

            $this->e_user->set_password($password[$i]);
            echo("Password: ".$password[$i]." -> ".$this->e_user->get_password().nl2br("\r\n"));

            $this->e_user->set_email($mail[$i]);
            echo("Mail: ".$mail[$i]." (".strlen($mail[$i])."), Mail impostata: ".$this->e_user->get_email()." (".strlen($this->e_user->get_email()).")".nl2br("\r\n"));
            echo("var_dump = ");
            var_dump($this->e_user->get_email());
            echo(nl2br("\r\n"));
            echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        }
    }


    public function T_PromoteDemote()
    {
        //$e_user viene preso dalla precedente T_E_User_rnd
        global $config;
        echo("Prova di Set, Get e PROMOTE.".nl2br("\r\n").nl2br("\r\n"));
        for($i=-2; $i<7; $i++)
        {
            $this->e_user->set_role($i);
            echo("Set: ".$i.", Get: ".$this->e_user->get_role()." = ".$config['user'][$this->e_user->get_role()].nl2br("\r\n"));
            $this->e_user->promote($i);
            if($this->e_user->get_role()>$i && $this->e_user->get_role()<5) //Controllo già fatto in E_User->promote()
            {
                echo(" - Promosso a ".$this->e_user->get_role().nl2br("\r\n"));
            }
            else {echo(" - Fallito :(".nl2br("\r\n"));}
            echo(nl2br("\r\n"));
        }


        echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        echo("Prova di Set, Get e DEMOTE.".nl2br("\r\n").nl2br("\r\n"));
        for($i=-2; $i<7; $i++)
        {
            $this->e_user->set_role($i);
            echo("Set: ".$i.", Get: ".$this->e_user->get_role()." = ".$config['user'][$this->e_user->get_role()]);
            $this->e_user->demote($i);
            if($this->e_user->get_role()!=$i && $this->e_user->get_role()>=0) //Controllo già fatto in E_User->demote()
            {
                echo(" - Bocciato a ".$this->e_user->get_role().nl2br("\r\n"));
            }
            else {echo(" - Fallito :(".nl2br("\r\n"));}
            echo(nl2br("\r\n"));
        }
        echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
    }


    public function T_Data()
    {
        global $config;
        echo("Prova metodi per upload e data upload".nl2br("\r\n").nl2br("\r\n").
                "----------------------------------------------------------------------------------------------".nl2br("\r\n"));
        echo("NOTA BENE: Se il ruolo riporta l'errore UNDEFINED INDEX IN [...] è perchè QUI,".
                    nl2br("\r\n").
                    "IN TESTING, si è cercato di accedere all'array config in indici maggiori di quelli esistenti".
                    nl2br("\r\n").
                "----------------------------------------------------------------------------------------------".nl2br("\r\n").nl2br("\r\n"));
        $e_user = new \Entity\E_User($this->username, $this->password, $this->email, $this->ruolo, 0, $this->last_up_date);
        echo("Data attuale: ".time()." = ".date('d-m-Y', time()).nl2br("\r\n"));
        //Controllo metodo get_last_Upload()
        echo("Get_last_Upload: ".$e_user->get_last_Upload()." = ".date('d-m-Y', $this->last_up_date).nl2br("\r\n"));
        for($i=0; $i<=count($config['user']); $i++) //Per ogni ruolo, da 0 a 5
        {
            $e_user = new \Entity\E_User($this->username, $this->password, $this->email, $i, 0, $this->last_up_date);
            echo("Ruolo: ".$e_user->get_role()." = ".$config['user'][$e_user->get_role()].nl2br("\r\n"));

            //Impongo l'ultimo upload fatto a molto tempo fa
            for($j=0; $j<13; $j++)
            {
                //Controllo metodo can_upload()
                if($e_user->can_upload())
                {
                    echo("Up fatti: ".$e_user->get_up_Count()." Up ok! ");
                    $e_user->add_up_Count();
                }
                else {echo("L'utente NON può uppare :( ");}
                //Controllo metodo add_up_count() in base al totale di upload fatti
                //Controllo metodo get_up_count() e dei metodi privati reset_up_Count() e set_last_Upload()
                echo("Upload attuali: ".$e_user->get_up_Count().nl2br("\r\n"));
            }
            echo(nl2br("\r\n"));
            echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        }
    }
}