<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Home extends V_Basic
{
    //private $mainContent; //QUESTA VARIABILE NON è USATA. CHE CI STA A FARE?

    //METODI STATICI -> CONTROL\\

    /**
     * Mostra il template della Home di default
     *
     * $array_photo array An array with the IDs and Thumbnails of the most liked photos.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     */
    public static function standardHome($array_photo)
    {
        //Nuovo - Da vedere!!!!!!!!
        $v = new V_Basic();
        $username = $_SESSION["username"]; //è giusto?
        $tpl = $this->set_home($username);
        $this->set_Contenuto_Home($tpl);
        $v->assign('thumbnail',$array_photo["thumbnail"]);
        $v->display('home_default.tpl');
        //DEVI AGGIUNGERE L'ID AD OGNI FOTO
        //DEVI AGGIUNGERE IL TYPE AD OGNI FOTO ALTRIMENTI NON SI VEDONO CORRETTAMENTE


        //Precedente
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $role=$this->imposta_ruolo($role);
        $tpl = $this->set_home($username);
        $this->set_Cont_menu_user($role);
        $this->set_Contenuto_Home($tpl);
        $smarty->assign('thumbanil',$thumbanil);
        $smarty->display('home_default.tpl');
    }


    /**
     * mostra la home page con messsaggio di errore
     */
    public static function notAllowed()
    {
        //NON TE LO SCRIVO PER TUTTE LE FUNZIONI MA:
        //1) VEDI SE FUNZIONA LA standardHome($array_photo)
        //2) QUANDO SEI SICURO CHE FUNZIONI FAI SIMILMENTE LE ALTRE FUNZIONI

        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $smarty->assign('messagio_errore', 'non consentito');
        $this->standardHome();
    }


    /**
     *
     * Mostra il tamplete per dire ad un utemte che è stato bannato
     */
    public static function bannedHome($username)
    {
        //TI SERVE DAVVERO L'USERNAME COME PARAMETRO DELLA FUNZIONE?
        //SE VIENE USATA QUESTA FUNZIONE DOVRESTI MANDARE DIRETTAMENTE FUORI DAL SITO



        //NON TE LO SCRIVO PER TUTTE LE FUNZIONI MA:
        //1) VEDI SE FUNZIONA LA standardHome($array_photo)
        //2) QUANDO SEI SICURO CHE FUNZIONI FAI SIMILMENTE LE ALTRE FUNZIONI

        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $smarty->assign('username',$username);
        $tpl = 'banned';
        $this->set_Cont_menu_user($role = 'banned');
        $this->set_Contenuto_Home($tpl);
        $smarty->display('home_default.tpl');
    }


//questa è da vedere
    /**
     * visualizza una pagina di errore per caricamento foto
     * @param type $messaggio
     */
    public static function error()
    {
        //NON TE LO SCRIVO PER TUTTE LE FUNZIONI MA:
        //1) VEDI SE FUNZIONA LA standardHome($array_photo)
        //2) QUANDO SEI SICURO CHE FUNZIONI FAI SIMILMENTE LE ALTRE FUNZIONI

        $messaggio_di_prova = "Oops, qualcosa è andato storto";

        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $this->assign('messaggio', $messaggio_di_prova);
        $contenuto = $smarty->fetch('pagina_errore.tpl');
        return $contenuto;
    }


    //METODI BASE - NON STATICI!!!\\


    /**
     *
     * Mostra il tamplete della Home di per i non loggati
     */
    public function login()
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $tpl = 'login';
        $this->set_Cont_menu_user($role = 'ospite');
        $this->set_Contenuto_Home($tpl);
        $smarty->display('home_default.tpl');
    }

    /**
     *
     * Mostra il tamplete della Home di utenti per la registrazione
     */
    public function registration()
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $tpl = 'registration';
        $this->set_Cont_menu_user($role = 'ospite');
        $this->set_Contenuto_Home($tpl);
        $smarty->display('home_default.tpl');
    }

    /**
     * questa funzione serve per impostare qualsiasi pagina del sito
     * @param type $username
     * @param type $role
     * @param type $contenuto è il fetch di un tpl
     */
    public function home($role, $tpl)
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $this->set_Cont_menu_user($role);
        $this->set_Contenuto_Home($tpl);
        $smarty->display('home_default.tpl');
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     * il contenuto non è altro che il fetch di altri tpl
     */
    public function set_Contenuto_Home($tpl)
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $mainContent = $this->fetch_home($tpl);
        $smarty->assign('content', $mainContent);
    }

    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_Cont_menu_user($role)
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $cont = $this->fetch_Bar($role);
        $smarty->assign('menu_user', $cont);
    }


    /**
     * restituisce il contnto del tpl in base all'utente
     */
    public function fetch_Bar($role)
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $contenuto = $smarty->fetch('menu_user_'.$role.'.tpl');
        return $contenuto;
    }


    /**
     * restituisce il contnto del tpl in base all'utente
     */
    public function fetch_home($tpl)
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $contenuto = $smarty->fetch($tpl.'.tpl');
        return $contenuto;
    }


    /**
     * setta il contenuto della homepage in base al fatto l'utente sia loggato oppure no
     * @param type $username prende il valore da session
     * @return type tpl
     */
    public function set_home($username = FALSE)
    {
        if($username === FALSE)
        {
            return $tpl = 'home_guest';
        }
        else
        {
            return $tpl = 'home_loggati';
        }
    }


    /*
     * fa il fetch del tpl che gli viene passato come parametro
    */
    public function fetch_banner($tpl)
    {
        $smarty = new \Smarty(); //DEVE ESSERE $v = new V_Basic();
        $banner = $smarty->fetch($tpl.'.tpl');
        return $banner;
    }


}