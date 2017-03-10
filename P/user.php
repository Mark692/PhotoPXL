<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use Entity\E_Photo_Blob;
use Entity\E_User;
use Foundation\F_User;
use Utilities\Roles;

class user extends prova
{
    private $user;


    /*
     * Crea un utente standard casuale
     */
    public function __construct()
    {
        $username = parent::rnd_str();
        $password = parent::rnd_str(15);
        $email = "std@ita.it";

        $this->username = $username;
        $this->user = new E_User($username, $password, $email);
    }


    /*
     * Istanzia un oggetto E_User_* in base al ruolo.
     */
    public function GET_USERDETAILS()
    {
        $nomi = array("Marco", "Bene", "AllUser", "NonEsisteNelDB");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Dettagli: ");
            var_dump(F_User::get_UserDetails($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Controlla se l'username è disponibile, restituisce un BOOLEANO.
     * Ricorda che è case sensitive quindi prova più username simili!!
     */
    public function IS_AVAILABLE()
    {
        $nomi = array("AllUser", "allusers", "NonEsiste", "Marco", "ChissàSeQuestoVaBene", "dAquwO1kDF");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("E' disponibile: ");
            var_dump(F_User::is_Available($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende solo password e ruolo dell'utente. Se l'utente non viene trovato,
     * DEVE tornare boolean FALSE
     */
    public function GET_LOGININFO()
    {
        $nomi = array("AllUser", "NonEsiste", "oCOXiFp17P", "ChissàSeQuestoVaBene", "dAquwO1kDF");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Login Info: ");
            var_dump(F_User::get_LoginInfo($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende il ruolo dell'utente selezionato. Se l'utente non esiste ritorna
     * un booleano FALSE
     */
    public function GET_ROLE()
    {
        $nomi = array("AllUser", "NonEsiste", "4NJTwjzfBC", "ChissàSeQuestoVaBene", "dAquwO1kDF");
        foreach($nomi as $n)
        {
            echo("Nome: $n");
            echo(nl2br("\r\n"));
            echo("Ruolo: ");
            var_dump(F_User::get_Role($n));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Prende il ruolo dell'utente selezionato.
     * Divide il totale di record trovati in pagine con limite impostato in USER_PER_PAGE
     * Se l'utente non esiste ritorna un booleano FALSE
     */
    public function GET_BY_ROLE()
    {
        $ruolo = array(
            "Bannato"   => 0,
            "STD"       => 1,
            "PRO"       => 2,
            "MOD"       => 3,
            "ADMIN"     => 4,
            "Non Usato" => 5);
        $pageToView = 1;
        foreach($ruolo as $k => $r)
        {
            echo("Ruolo: $k");
            echo(nl2br("\r\n"));
            echo("Utenti trovati: ");
            var_dump(F_User::get_By_Role($r, $pageToView));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Cambia i dettagli di un utente. Alterna le funzioni con il parametro $change_Function
     * Per cambiare il ruolo, ricorda che solo l'admin può farlo, quindi guarda F_Admin
     */
    public function CHANGE_DETAILS()
    {
        $new_Username2Save = "CambiatoUsername"; //NUOVO USERNAME!!!
        $old = "Bene"; //QUELLO SALVATO NEL DB!!!!

        $password = "tanto viene hashata...";
        $email = "update@pro.va";
        $changed = new E_User($new_Username2Save, $password, $email);
        $changed->set_Role(Roles::ADMIN);

        for($i = 1; $i < 4; $i++)
        {
            if($i == 1)
            {
                echo("1. Change_Username:");
                echo(nl2br("\r\n"));
                echo("Vecchio: ".$old);
                echo(nl2br("\r\n"));
                echo("Nuovo: ".$new_Username2Save);
                F_User::change_Username($changed, $old);
            }
            elseif($i == 2)
            {
                echo("2. Change_Password:");
                echo(nl2br("\r\n"));
                echo("Nuova password: ".$password);
                echo(nl2br("\r\n"));
                echo("Hashata: ".hash("sha512", $password));
                echo(nl2br("\r\n"));
                echo("Vedi Username: ".$new_Username2Save);
                F_User::change_Password($changed);
            }
            elseif($i == 3)
            {
                echo("3. Change_Email:");
                echo(nl2br("\r\n"));
                echo("Nuova email: ".$email);
                echo(nl2br("\r\n"));
                echo("Vedi Username: ".$new_Username2Save);
                F_User::change_Email($changed);
            }
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Questa funzione ha il solo scopo di usare più volte le funzioni qui sotto
     * per l'aggiornamento della foto profilo e far visualizzare le varie foto,
     * come cambiano, quella di default, quella caricata ecc
     */
    public function CASODUSO_UPDATE_PRO_PIC()
    {
        echo("Default già presente: ");
        $this->GET_PROFILEPIC();

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->SET_PROFILEPIC();
        echo("Cambiata con una già esistente nel DB: ");
        $this->GET_PROFILEPIC();

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->REMOVE_CURRENTPROPIC();
        echo("Rimossa la foto ed impostata quella di default: ");
        $this->GET_PROFILEPIC();

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->UPLOAD_NEWCOVER();
        echo("Caricata nuova foto solo come PROPIC: ");
        $this->GET_PROFILEPIC();
    }


    /*
     * Aggiorna la foto profilo di un utente con una foto già presente nel DB
     */
    public function SET_PROFILEPIC()
    {
        $user = "Marco";
        $pic = 3;
        F_User::set_ProfilePic($user, $pic);
        echo("L'utente ".$user." cambia la sua ProfilePic in ".$pic);
        echo(nl2br("\r\n"));
    }


    /*
     * Carica una nuova foto da impostare SOLO nella tabella Profile_pic
     */
    public function UPLOAD_NEWCOVER()
    {
        $user = "Marco";
        $install_dir = ".".DIRECTORY_SEPARATOR
                ."Utilities".DIRECTORY_SEPARATOR
                ."Install".DIRECTORY_SEPARATOR;
        $my_propic = $install_dir."marco.png";
        $bob = new E_Photo_Blob();
        $bob->on_Upload($my_propic);
        F_User::upload_NewCover($user, $bob);
    }


    /*
     * Riprende la foto profilo dell'utente
     */
    public function GET_PROFILEPIC()
    {
        $user = "Marco";
        $r = F_User::get_ProfilePic($user);
        $mime = image_type_to_mime_type($r["type"]);
        $pic = $r["photo"];
        echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
    }


    /*
     * Toglie la ProPic corrente ed imposta quella di default
     */
    public function REMOVE_CURRENTPROPIC()
    {
        $user = "Marco";
        F_User::remove_CurrentProPic($user);
    }


    /*
     * Aggiunge la coppia USERNAME-PHOTO alla tabella "likes"
     */
    public function ADD_LIKE_TO()
    {
        $users = array("Marco", "Fede", "AllUser");

        $photos = array(3, 4, 5, 6, 7, 8, 9);

        foreach($users as $u)
        {
            foreach($photos as $p)
            {
                F_User::add_Like_to($p, $u);
                echo("Utente $u likes $p");
                echo(nl2br("\r\n"));
            }
        }
    }


    /*
     * Rimuove la coppia USERNAME-PHOTO dalla tabella "likes"
     */
    public function REMOVE_LIKE()
    {
        $user = "AllUser";
        $photo = 6;
        F_User::remove_Like($user, $photo);
        echo("User $user remove like from $photo");
        echo(nl2br("\r\n"));
    }


}