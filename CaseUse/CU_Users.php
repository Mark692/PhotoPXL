<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUse;

use Entity\E_Photo_Blob;
use Entity\E_User_Standard;
use Exceptions\input_texts;
use Exceptions\queries;
use Exceptions\uploads;
use Foundation\F_User;
use Foundation\F_User_Admin;
use Foundation\F_User_MOD;
use Foundation\F_User_PRO;
use Foundation\F_User_Standard;
use ReflectionClass;
use Utilities\Roles;

/**
 * Questa classe si occupa di testare metodi di classe per gli oggetti E_User_*
 * e le loro rispettive funzioni di Foundation
 */
class CU_Users
{
    /**
     * Registrazione e Login di un utente
     *
     * @param string $username Il nuovo username
     * @param string $password La password per l'utente
     * @param string $email L'email con cui registrarsi
     */
    public function Registrazione_Login($username, $password, $email)
    {
        echo("Inizio fase di registrazione: ".nl2br("\r\n").nl2br("\r\n"));
        $esito = $this->insert($username, $password, $email);

        if($esito === TRUE)
        {
            echo(nl2br("\r\n").nl2br("\r\n")."Fase di login: ".nl2br("\r\n").nl2br("\r\n"));
            $this->get_LoginInfo($username, $password);
        }
        else
        {
            echo(nl2br("\r\n")."Registrazione fallita, non si procede al login con queste credenziali");
        }
    }


    /**
     * Questa funzione si occupa di gestire l'immagine di profilo di un utente
     *
     * @param string $username L'username con il quale si vuole procedere al cambio di foto profilo
     * @param int $photo_ID L'ID di una foto presente nel DB con cui cambiare la foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function manage_profilePIC($username, $photo_ID)
    {
        $this->get_ProfilePic($username);

        $this->set_ProfilePic($username, $photo_ID);

        $this->upload_NewCover($username);

        $this->remove_CurrentProPic($username);
    }


    /**
     * Questa funzione si occupa di creare un oggetto Entity\E_User_Standard ed inserirlo nel DB
     * Procede inoltre nel try catch di eventuali eccezioni
     *
     * @param string $username Il nick per il nuovo utente in fase di registrazione
     * @param string $password La password scelta
     * @param string $email L'email dell'utente
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function insert($username, $password, $email)
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
                        echo("Inserito con successo!");
                        echo(nl2br("\r\n"));
                        return TRUE;
                    }
                    catch(queries $q)
                    {
                        echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
                        echo(nl2br("\r\n"));
                        return FALSE;
                    }
                }
                echo("Purtroppo l'username scelto non è disponibile. Provane uno diverso");
                echo(nl2br("\r\n"));
                return FALSE;
            }
            catch(input_texts $u1)
            {
                echo($u1->getMessage());
                echo(nl2br("\r\n"));
                return FALSE;
            }
        }
        catch(input_texts $u2)
        {
            echo($u2->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Questa funzione procede ai controlli per il login dell'utente
     * Procede inoltre nel try catch di eventuali eccezioni
     *
     * @param string $username L'utente che vuole effettuare il login
     * @param string $password La password di tale utente. Se ne prende l'impronta sha512 e la si confronta con il valore salvato nel DB
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_LoginInfo($username, $password)
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
            echo("Perfetto, i dati sono corretti. Benvenuto $username");
            echo(nl2br("\r\n"));
//In questo caso si potrebbe usare la funzione \Foundation\F_User::get_UserDetails($username); e mostrarne l'output
            return TRUE;
        }
        echo("L'username inserito '".$username."' non esiste.");
        return FALSE;
    }


    /**
     * Mostra all'utente la sua foto profilo attualmente impostata. Da utilizzare per l'immagine di default
     *
     * @param string $username Il nick dell'utente che vuole visualizzare la propria foto profilo
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_ProfilePic($username)
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
    }


    /**
     * Cambia la foto profilo attualmente impostata con una scelta dal DB delle foto
     *
     * @param string $username Il nick dell'utente che vuole cambiare la propria foto profilo
     * @param int $photo_ID L'ID della foto da utilizzare
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function set_ProfilePic($username, $photo_ID)
    {
        try
        {
            echo("L'utente $username vuole ora cambiare la sua foto di profilo con una già presente nel DB");

            F_User::set_ProfilePic($username, $photo_ID);
            echo(nl2br("\r\n"));
            $this->display_it($username);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Carica una nuova foto profilo per l'utente selezionato
     *
     * @param type $username Il nick dell'utente che vuole caricare la propria foto profilo
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function upload_NewCover($username)
    {
        echo("Prova ora a cambiare la foto profilo con una caricata al momento");
        echo(nl2br("\r\n"));

        $path = ".".DIRECTORY_SEPARATOR
                ."Utilities".DIRECTORY_SEPARATOR
                ."Install".DIRECTORY_SEPARATOR
                .$username;
        $bob = new E_Photo_Blob();
        try
        {
            $bob->on_Upload($path);
            try
            {
                F_User::upload_NewCover($username, $bob);
                $this->display_it($username);
            }
            catch(queries $q)
            {
                echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
                echo(nl2br("\r\n"));
                return FALSE;
            }
        }
        catch(uploads $uploads)
        {
            echo($uploads->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Rimuove la foto profilo attualmente impostata e reimposta quella di default
     *
     * @param type $username Il nick dell'utente che vuole rimuovere la propria foto profilo
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function remove_CurrentProPic($username)
    {
        echo("Infine, l'utente decide di tornare alla foto di default.");
        echo(nl2br("\r\n"));
        try
        {
            F_User::remove_CurrentProPic($username);
            $this->display_it($username);
            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Mostra all'utente la sua foto profilo attualmente impostata
     *
     * @param string $username Il nick dell'utente che vuole visualizzare la propria foto profilo
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    private function display_it($username)
    {
        try
        {
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


    /**
     * Permette l'aggiunta di un like ad una foto
     *
     * @param int $photo_ID La foto alla quale si vuole lasciare un like
     * @param string $username L'username che vuole lasciare il like
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function add_Like_to($photo_ID, $username)
    {
        try
        {
            echo("L'utente $username prova ad aggiungere il like alla foto con ID = $photo_ID");
            echo(nl2br("\r\n"));
            $esito = F_User::add_Like_to($photo_ID, $username);
            echo("Il like è stato aggiunto? ");
            return var_dump($esito);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Permette la rimozione di un like da una foto
     *
     * @param string $username L'username che vuole rimuovere il like
     * @param int $photo_ID La foto dalla quale si vuole rimuovere il like
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function remove_Like($username, $photo_ID)
    {
        try
        {
            echo("L'utente $username prova rimuovere il like dalla foto con ID = $photo_ID");
            echo(nl2br("\r\n"));
            $esito = F_User::remove_Like($username, $photo_ID);
            echo("Il like è stato rimosso? ");
            return var_dump($esito);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Permette di controllare la possibilità di fare ulteriori upload per l'utente selezionato.
     * L'utente cercato deve essere Standard
     *
     * @param string $username L'utente per il quale si vogliono controllare i parametri di upload
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function can_Upload($username)
    {
        try
        {
            echo("Prendo l'utente dal database.".nl2br("\r\n"));
            $E_User_STD = F_User::get_UserDetails($username);
        }
        catch(queries $q1)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q1->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }


        if(!($E_User_STD instanceof E_User_Standard)) //Se NON è un utente standard
        {
            echo("L'utente immesso ha ruolo ".$E_User_STD->get_Role()." per cui ");
            if($E_User_STD->can_Upload() === TRUE)
            {
                echo("gli è sempre permesso caricare foto");
            }
            else
            {
                echo("non gli è permesso caricare foto");
            }
            return FALSE;
        }


        if($E_User_STD->can_Upload()) //Uploads permessi
        {
            echo("Perfetto, procedo con l'upload...".nl2br("\r\n"));
            $time = time();
            echo("Imposto l'ultima data di upload al timestamp $time ovvero ".date('d-m-y', $time).nl2br("\r\n"));
            $E_User_STD->add_up_Count();
            echo("Aggiungo 1 al contatore di upload. Totale upload fatti oggi: ".$E_User_STD->get_up_Count().nl2br("\r\n").nl2br("\r\n"));
        }
        else //Ha raggiunto 10 uploads
        {
            echo("L'utente ha totalizzato ".$E_User_STD->get_up_Count()." uploads oggi. Non gli è più permesso farne per 24 ore.");
            return FALSE;
        }

        echo("Finita la parte con Entity. Procedo all'aggiornamento nel DB...".nl2br("\r\n"));

        try
        {
            F_User_Standard::update_Counters($E_User_STD);
            echo("Aggiornamento dei contatori avvenuto con successo");
            echo(nl2br("\r\n"));
            return TRUE;
        }
        catch(queries $q2)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q2->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Cambia la privacy ad una foto
     *
     * @param string $username L'utente che vuole cambiare la privacy
     * @param int $photo_ID L'ID della foto da modificare
     * @param int $privacy La nuova privacy per la foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function set_PhotoPrivacy($username, $photo_ID, $privacy)
    {
        try
        {
            F_User_PRO::set_PhotoPrivacy($username, $photo_ID, $privacy);
            echo("L'esito di questa funzione va verificato nel DB. L'utente che sta modificando la privacy DEVE essere l'uploader della foto");
            echo(nl2br("\r\n"));
            echo("Inoltre, non viene controllato il ruolo dell'utente. Questo controllo andrebbe fatto in Control, non in Foundation");
            return TRUE;
        }
        catch(queries $q2)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q2->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Genera una lista degli utenti che matchano una query specifica.
     * Vengono mostrate anche le loro immagini di profilo
     *
     * @param int $pageToView Pagina di risultati che si vuole visualizzare
     * @param string $starts_With Testo con il quale inizia l'username cercato
     * @param int $limit_PerPage Quanti risultati mostrare per ogni pagina
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_UsersList($pageToView = 1, $starts_With = '', $limit_PerPage = 10)
    {
        try
        {
            $lista = F_User_MOD::get_UsersList($pageToView, $starts_With, $limit_PerPage);
            $tot = $lista["total_inDB"];
            echo("Lista degli utenti che iniziano per '$starts_With'. Pagina $pageToView, risultati totali = $tot");
            echo(nl2br("\r\n"));
            foreach($lista as $k => $v)
            {
                if($k !== "total_inDB")
                {
                    echo($v["user"]." ");
                    $mime = image_type_to_mime_type($v["type"]);
                    $pic = $v["photo"];
                    echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                    echo(nl2br("\r\n").nl2br("\r\n"));
                }
            }
            return TRUE;
        }
        catch(queries $q2)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q2->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Assegna il ruolo BANNED all'utente scelto
     *
     * @param string $username L'utente da bannare
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function ban($username)
    {
        try
        {
            $esito = F_User_MOD::ban($username);
            if($esito === TRUE)
            {
                echo("L'utente $username è stato bannato.");
                echo(nl2br("\r\n").nl2br("\r\n"));
            }
            else
            {
                echo("L'utente $username NON è stato bannato.".nl2br("\r\n"));
                echo("L'username non esiste OPPURE si è cercato di bannare un ADMIN");
                echo(nl2br("\r\n").nl2br("\r\n"));
            }
        }
        catch(queries $q2)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q2->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }

        echo("Ruolo attuale: ".nl2br("\r\n"));
        try
        {
            $role = F_User::get_Role($username);

            if($role !== FALSE)
            {
                $gestisci_Costanti = new ReflectionClass('\Utilities\Roles');
                $ruoli_Utenti = $gestisci_Costanti->getConstants();

                foreach($ruoli_Utenti as $nome_Ruolo => $valore_Ruolo)
                {
                    if($valore_Ruolo == $role)
                    {
                        echo($nome_Ruolo);
                        return TRUE;
                    }
                }
            }
            else
            {
                echo("L'username non esiste. Non è possibile determinarne il ruolo.");
                return TRUE;
            }
        }
        catch(queries $q2)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q2->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Cambia il ruolo ad un utente
     *
     * @param string $username L'utente al quale si vuole cambiare il ruolo
     * @param int $nuovo_Ruolo Il nuovo ruolo da attribuirgli
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function change_Role($username, $nuovo_Ruolo)
    {
        try
        {
            $esito = F_User_Admin::change_Role($username, $nuovo_Ruolo);
            if($esito === TRUE)
            {
                try
                {
                    $role = F_User::get_Role($username);

                    if($role !== FALSE)
                    {
                        $gestisci_Costanti = new ReflectionClass('\Utilities\Roles');
                        $ruoli_Utenti = $gestisci_Costanti->getConstants();

                        foreach($ruoli_Utenti as $nome_Ruolo => $valore_Ruolo)
                        {
                            if($valore_Ruolo == $role)
                            {
                                echo("Ruolo attuale: ".$nome_Ruolo);
                                return TRUE;
                            }
                        }
                    }
                    else
                    {
                        echo("L'username non esiste. Non è possibile determinarne il ruolo.");
                        return TRUE;
                    }
                }
                catch(queries $q2)
                {
                    echo("E' avvenuto un errore contattando il DB: ".$q2->getMessage());
                    echo(nl2br("\r\n"));
                    return FALSE;
                }
            }
            else
            {
                echo("Non è stato cambiato il ruolo dell'utente.");
                return TRUE;
            }
        }
        catch(queries $q3)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q3->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /*
     * Dati pronti per i test
     *
     *
//$CU = new CaseUse\CU_Users();
//$username = "Marco";
//$password = "password";
//$email = "email@mail.it";
//
//$photo_ID = 7;
//$CU->insert($username, $password, $email);
//$CU->get_LoginInfo($username, $password);
//$CU->manage_profilePIC($username, $photo_ID);
//$CU->add_Like_to($photo_ID, $username);
//$CU->remove_Like($username, $photo_ID);
//$CU->can_Upload($username);
//
//$privacy = 0;
//$CU->set_PhotoPrivacy($username, $photo_ID, $privacy);
//
//$pageToView = 1;
//$starts_With = "Mar";
//$limit_PerPage = 5;
//$CU->get_UsersList($pageToView, $starts_With, $limit_PerPage);
//
//$CU->ban($username);
//
//$nuovo_Ruolo = 3;
//$CU->change_Role("Fede", $nuovo_Ruolo);
     *
     */
}