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
    private $e_userSTD;
    private $e_userPRO;
    private $e_userMOD;
    private $e_userAdmin;

    private $parent_path = "Entity\E_User";



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
        $this->tot_uploads = rand(-4, 14);
        $this->last_up_date = time() - 1400000000;

        $this->e_prove = new \Entity\E_User_Standard($this->username, $this->password, $this->email, $this->tot_uploads);

        $this->e_userSTD   = new \Entity\E_User_Standard("UsSTD", "A PASS...", "mail@mail.com", $this->tot_uploads);
        $this->e_userPRO   = new \Entity\E_User_PRO     ("UsPRO", "A PASS...", "mail@mail.com", $this->tot_uploads);
        $this->e_userMOD   = new \Entity\E_User_MOD     ("UsMOD", "A PASS...", "mail@mail.com", $this->tot_uploads);
        $this->e_userAdmin = new \Entity\E_User_Admin   ("UsADMIN", "A PASS...", "mail@mail.com", $this->tot_uploads);
    }


    /**
     * Testa il costruttore di E_User.
     * Dato che il costruttore si basa su delle set, queste vengono testate con dati casuali
     */
    public function T_uconstr()
    {
        echo("_______________________________________________________________________________".nl2br("\r\n"));
        echo("Prova di T_uconstr()".nl2br("\r\n").nl2br("\r\n"));
        //Stampa l'oggetto casuale e_userSTD
        echo("Oggetto utente con costruttore ridotto: niente timestamp.".nl2br("\r\n"));
        parent::ogg2arr($this->e_prove, $this->parent_path);

        echo(nl2br("\r\n").nl2br("\r\n"));

        //Stampa un oggetto $e_userPRO ma con ultimo upload fatto molto tempo fa
        $e_userPRO = new \Entity\E_User_PRO($this->username, $this->password, $this->email, $this->tot_uploads, -1992);
        echo("Oggetto utente con costruttore completo: timestamp negativo.".nl2br("\r\n"));
        parent::ogg2arr($e_userPRO, $this->parent_path);

        echo(nl2br("\r\n").nl2br("\r\n"));

        //Stampa un oggetto $e_userMOD ma con ultimo upload fatto molto tempo fa
        $e_userMOD = new \Entity\E_User_MOD($this->username, $this->password, $this->email, $this->tot_uploads, $this->last_up_date);
        echo("Oggetto utente con costruttore completo: timestamp nel passato.".nl2br("\r\n"));
        parent::ogg2arr($e_userMOD, $this->parent_path);

        echo(nl2br("\r\n").nl2br("\r\n"));

        //Stampa un oggetto $e_userADMIN ma con ultimo upload fatto molto tempo fa
        $e_userADMIN = new \Entity\E_User_Admin($this->username, $this->password, $this->email, $this->tot_uploads, $this->last_up_date);
        echo("Oggetto utente con costruttore completo: timestamp nel passato.".nl2br("\r\n"));
        parent::ogg2arr($e_userADMIN, $this->parent_path);


    }


    /**
     * Testa le funzioni Set e Get di E_User
     */
    public function T_SetGet()
    {
        echo("__________________________________________________________________".nl2br("\r\n"));
        echo("Prova di T_SetGet()".nl2br("\r\n").nl2br("\r\n"));
        //Dati da usare
        $username = array("NuovoUsername", "NùòvòUsern4m3", "|V(_)0\/0 (_)532|V4|\/|3");
        $password = array("Nuova Password", "Nu0v5 P455wòr|)", "|V(_)0\/4 |*455\/\/02[)");
        $mail = array("chiocciola@libero.it", "ch1òcc101à@118320.17", "(|-|10((1014@118320.17");
        //Testa i metodi dell'oggetto con i dati di sopra
        echo("Test dei metodi Set e Get. Formato: Originale -> get_()".nl2br("\r\n").nl2br("\r\n"));
        for($i=0; $i<count($username); $i++)
        {
            $this->e_prove->set_Username($username[$i]);
            echo("Username: ".$username[$i]." -> ".$this->e_prove->get_Username().nl2br("\r\n"));

            $this->e_prove->set_Password($password[$i]);
            echo("Password: ".$password[$i]." -> ".$this->e_prove->get_Password().nl2br("\r\n"));

            $this->e_prove->set_Email($mail[$i]);
            echo("Mail: ".$mail[$i]." (".strlen($mail[$i])."), Mail impostata: ".$this->e_prove->get_Email()." (".strlen($this->e_userSTD->get_Email()).")".nl2br("\r\n"));
            echo("var_dump = ");
            var_dump($this->e_prove->get_Email());
            echo(nl2br("\r\n").nl2br("\r\n").nl2br("\r\n"));
        }
    }


    public function T_Roles()
    {
        echo("__________________________________________________________________".nl2br("\r\n"));
        echo("Prova di T_Roles()".nl2br("\r\n").nl2br("\r\n"));
        $this->e_userSTD->become_PRO();
        echo("L'utente STD usa la funzione becomePRO(), il suo ruolo deve diventare ".PRO.nl2br("\r\n"));
        parent::ogg2arr($this->e_userSTD, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));

        $this->e_userMOD->ban_user($this->e_userSTD);
        echo("L'utente MOD usa la funzione ban_user() sull'utente precedente, il suo ruolo deve diventare ".BANNED.nl2br("\r\n"));
        parent::ogg2arr($this->e_userSTD, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));

        $this->e_userAdmin->change_Role($this->e_userSTD, MOD);
        echo("L'utente Admin non approva l'operato del MOD ed usa la funzione change_Role() sull'utente precedente, il suo ruolo deve diventare ".MOD.nl2br("\r\n"));
        parent::ogg2arr($this->e_userSTD, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));

        $this->e_userSTD->ban_user($this->e_userMOD);
        echo("Il nuovo MOD, forte del suo potere e ricolmo di rabbia, prova a bannare il MOD. Il ruolo del MOD deve diventare ".BANNED.nl2br("\r\n"));
        parent::ogg2arr($this->e_userMOD, $this->parent_path);
        echo(nl2br("\r\n").nl2br("\r\n"));

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
        $e_user = new \Entity\E_User_Basic($this->username, $this->password, $this->email, $this->ruolo, 0, $this->last_up_date);
        echo("Data attuale: ".time()." = ".date('d-m-Y', time()).nl2br("\r\n"));
        //Controllo metodo get_last_Upload()
        echo("Get_last_Upload: ".$e_user->get_Last_Upload()." = ".date('d-m-Y', $this->last_up_date).nl2br("\r\n"));
        for($i=0; $i<=count($config['user']); $i++) //Per ogni ruolo, da 0 a 5
        {
            $e_user = new \Entity\E_User_Basic($this->username, $this->password, $this->email, $i, 0, $this->last_up_date);
            echo("Ruolo: ".$e_user->get_Role()." = ".$config['user'][$e_user->get_Role()].nl2br("\r\n"));

            //Impongo l'ultimo upload fatto a molto tempo fa
            for($j=0; $j<13; $j++)
            {
                //Controllo metodo can_upload()
                if($e_user->can_Upload())
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