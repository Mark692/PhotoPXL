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
class Test extends \Prove\Fun
{

    /**
     * Genera un \Entity\E_User casuale
     * @return array of E_User object
     */
    public function TE_User()
    {
        global $config;
        //Creazione di un oggetto E_User con dati casuali
        $rn_user = parent::rnd_str(7);
        $rn_pass = parent::rnd_str(10);
        $rn_email = parent::rnd_str(rand(5, 10))."@".parent::rnd_str(rand(2, 5)).".".parent::rnd_str(rand(2, 3));
        $rn_role = rand(0, 4);
        $rn_uploads = rand(-4, 14);

        $e_user = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $rn_role, $rn_uploads);



        //Stampa l'oggetto
        echo("Oggetto utente con costruttore ridotto: niente timestamp.".nl2br("\r\n"));
        parent::ogg2arr($e_user);


        //Dati da usare
        $username = array("NuovoUsername", "NùòvòUsern4m3", "|V(_)0\/0 (_)532|V4|\/|3", "|\||_|[]|/[] |_|$[-/2|\|/-\/\/\[-");
        $password = array("Nuova Password", "Nu0v5 P455wòr|)", "|V(_)0\/4 |*455\/\/02[)", "|\||_|[]|//-\ |>/-\$$\|/[]/2|)");
        $mail = array("chiocciola@libero.it", "ch1òcc101à@118320.17", "(|-|10((1014@118320.17", "(#![]((![]|_/-\@|_!|3[-/2[].!'|'");
        //Testa i metodi dell'oggetto con i dati di sopra
        echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        echo("Test dei metodi Set e Get. Formato: Originale -> get_()".nl2br("\r\n").nl2br("\r\n"));
        for($i=0; $i<count($username); $i++)
        {
            $e_user->set_username($username[$i]);
            echo("Username: ".$username[$i]." -> ".$e_user->get_username().nl2br("\r\n"));

            $e_user->set_password($password[$i]);
            echo("Password: ".$password[$i]." -> ".$e_user->get_password().nl2br("\r\n"));

            $e_user->set_email($mail[$i]);
            echo("Mail: ".$mail[$i]." (".strlen($mail[$i])."), Mail impostata: ".$e_user->get_email()." (".strlen($e_user->get_email()).")".nl2br("\r\n"));
            echo("var_dump = ");
            var_dump($e_user->get_email());
            echo(nl2br("\r\n").nl2br("\r\n"));
        }


        echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        echo("Prova di Set, Get e PROMOTE.".nl2br("\r\n").nl2br("\r\n"));
        for($i=-2; $i<7; $i++)
        {
            $e_user->set_role($i);
            echo("Set: ".$i.", Get: ".$e_user->get_role()." = ".$config['user'][$e_user->get_role()].nl2br("\r\n"));
            $e_user->promote($i);
            if($e_user->get_role()>$i && $e_user->get_role()<5) //Controllo già fatto in E_User->promote()
            {
                echo(" - Promosso a ".$e_user->get_role().nl2br("\r\n"));
            }
            else {echo(" - Fallito :(".nl2br("\r\n"));}
            echo(nl2br("\r\n"));
        }


        echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));
        echo("Prova di Set, Get e DEMOTE.".nl2br("\r\n").nl2br("\r\n"));
        for($i=-2; $i<7; $i++)
        {
            $e_user->set_role($i);
            echo("Set: ".$i.", Get: ".$e_user->get_role()." = ".$config['user'][$e_user->get_role()]);
            $e_user->demote($i);
            if($e_user->get_role()!=$i && $e_user->get_role()>=0) //Controllo già fatto in E_User->demote()
            {
                echo(" - Bocciato a ".$e_user->get_role().nl2br("\r\n"));
            }
            else {echo(" - Fallito :(".nl2br("\r\n"));}
            echo(nl2br("\r\n"));
        }


        echo("__________________________________________________________________".nl2br("\r\n").nl2br("\r\n"));

        echo("Prova metodi per upload e data upload".nl2br("\r\n").nl2br("\r\n"));
        $ttt = time() - 1400000000;
        $e_user = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $rn_role, 0, $ttt);
        echo("Data attuale: ".time()." = ".date('d-m-Y', time()).nl2br("\r\n"));
        //Controllo metodo get_last_Upload()
        echo("Get_last_Upload: ".$e_user->get_last_Upload()." = ".date('d-m-Y', $ttt).nl2br("\r\n"));
        for($i=0; $i<=count($config['user']); $i++) //Per ogni ruolo, da 0 a 5
        {
            $e_user = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $i, 0, $ttt);
            echo("Ruolo: ".$e_user->get_role()." = ".$config['user'][$e_user->get_role()].nl2br("\r\n"));
            echo("Se il ruolo riporta l'errore UNDEFINED INDEX IN [...] è perchè ".
                    nl2br("\r\n").
                    "si è cercato di accedere all'array config in indici maggiori di quelli esistenti".
                    nl2br("\r\n").nl2br("\r\n"));
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
        }
    }


    /**
     * Genera un oggetto \Entity\E_Photo casuale
     * @return E_Photo object
     */
    public function TE_Photo()
    {


    }













}