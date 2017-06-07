<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUse;

use Entity\E_User_Standard;
use Exceptions\input_texts;
use Exceptions\queries;
use Foundation\F_User;
use Foundation\F_User_Standard;
use Utilities\Roles;

class CU_Users
{
    /*
     * Questa funzione si occupa di creare un oggetto Entity\E_User_Standard ed inserirlo nel DB
     * Procede inoltre nel try catch di eventuali eccezioni
     */
    public function registration($username, $password, $email)
    {
        try
        {
            try
            {
                $user = new E_User_Standard($username, $password, $email);
                echo("Oggetto Entity creato con successo. Username = ".$username);
                echo(nl2br("\r\n"));

                if(F_User::is_Available($username) === TRUE)
                {
                    echo("Inserimento utente nel DB...");
                    echo(nl2br("\r\n"));
                    try
                    {
                        F_User_Standard::insert($user);
                    }
                    catch(queries $q)
                    {
                        echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
                        echo(nl2br("\r\n"));
                    }
                }
                echo("Purtroppo l'username scelto non è disponibile. Provane uno diverso");
                echo(nl2br("\r\n"));
            }
            catch(input_texts $u1)
            {
                echo($u1->getMessage());
                echo(nl2br("\r\n"));
            }
        }
        catch(input_texts $u2)
        {
            echo($u2->getMessage());
            echo(nl2br("\r\n"));
        }
    }


    /*
     * Questa funzione procede ai controlli per il login dell'utente
     * Procede inoltre nel try catch di eventuali eccezioni
     */
    public function login($username, $password)
    {
        try
        {
            $db_user = F_User::get_LoginInfo($username);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }

        if($db_user != FALSE)
        {
            $hashed_pass = hash('sha512', $password); //SE QUALCOSA NON DOVESSE FUNZIONARE RICORDA CHE LA PASS SUL DB è HASHATA
            if($hashed_pass !== $db_user["password"]) //PROBABILMENTE NELL'INDEX STAI METTENDO UNA PASS IN CHIARO
            {
                echo("Password non corretta!");
                echo(nl2br("\r\n"));
                return FALSE;
            }

            //Altrimenti la password corrisponde a quella del DB:
            if($db_user["role"] == Roles::BANNED)
            {
                echo("Spiacenti, sei stato bannato. Non è possibile procedere al login.");
                echo(nl2br("\r\n"));
                return FALSE;
            }

            //Se quindi la pass è giusta e l'utente non è bannato:
            echo("Perfetto, i dati sono corretti. Login completato con successo");
            echo(nl2br("\r\n"));
            //In questo caso si potrebbe usare la funzione \Foundation\F_User::get_UserDetails($username); e mostrarne l'output
            return TRUE;
        }
        echo("L'username inserito '".$username."' non esiste.");
        return FALSE;
    }


    /**
     * Questa funzione si occupa di gestire l'immagine di profilo di un utente
     * @param string $username L'username con il quale si vuole procedere al cambio di foto profilo
     * @param int $photo_ID L'ID di una foto presente nel DB con cui cambiare la foto
     */
    public function manage_profilePIC($username, $photo_ID)
    {
        try
        {
            echo("Quando un utente si registra ha un'immagine di profilo standard: ");

            $basePIC = F_User::get_ProfilePic($username);

            $mime = image_type_to_mime_type($basePIC["type"]);
            $pic = $basePIC["photo"];
            echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            echo(nl2br("\r\n").nl2br("\r\n").nl2br("\r\n").nl2br("\r\n"));
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }

        $this->cambia_PROPIC_DB($username, $photo_ID);

        echo("Prova ora a cambiare la foto profilo con una caricata al momento");
        echo(nl2br("\r\n"));

        $path = ".".DIRECTORY_SEPARATOR
                ."Utilities".DIRECTORY_SEPARATOR
                ."Install".DIRECTORY_SEPARATOR
                ."marco.png";
        $bob = new \Entity\E_Photo_Blob();
        try
        {
            $bob->on_Upload($path);
            try
            {
                F_User::upload_NewCover($username, $bob);

                $actualPIC = F_User::get_ProfilePic($username);
                echo("Nuova immagine di profilo: ");
                $mime = image_type_to_mime_type($actualPIC["type"]);
                $pic = $actualPIC["photo"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            echo(nl2br("\r\n").nl2br("\r\n").nl2br("\r\n").nl2br("\r\n"));
            }
            catch(queries $q)
            {
                echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
                echo(nl2br("\r\n"));
                return FALSE;
            }
        }
        catch(\Exceptions\uploads $uploads)
        {
            echo($uploads->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }

        echo("Infine, l'utente decide di tornare alla foto di default.");
        echo(nl2br("\r\n"));
        try
        {
            F_User::remove_CurrentProPic($username);
            $actualPIC = F_User::get_ProfilePic($username);
            echo("Nuova immagine di profilo: ");
            $mime = image_type_to_mime_type($actualPIC["type"]);
            $pic = $actualPIC["photo"];
            echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            echo(nl2br("\r\n").nl2br("\r\n").nl2br("\r\n").nl2br("\r\n"));
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }

    private function cambia_PROPIC_DB($username, $photo_ID)
    {
        try
        {
            echo("L'utente $username vuole ora cambiare la sua foto di profilo con una già presente nel DB");

            F_User::set_ProfilePic($username, $photo_ID);
            echo(nl2br("\r\n"));
            $actualPIC = F_User::get_ProfilePic($username);
            echo("Nuova immagine di profilo: ");
            $mime = image_type_to_mime_type($actualPIC["type"]);
            $pic = $actualPIC["photo"];
            echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            echo(nl2br("\r\n").nl2br("\r\n").nl2br("\r\n").nl2br("\r\n"));
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }

}