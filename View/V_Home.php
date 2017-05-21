<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace View;

use Entity\E_Photo;

class V_Home extends V_Basic
{

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
    public static function standardHome()
    {
        //Nuovo - Da vedere!!!!!!!!
        $v = new V_Basic();
        $home=new V_Home();
        $username = $_SESSION["username"];
        echo($username.nl2br("\r\n"));
        $array_photo=E_Photo::get_MostLiked($_SESSION["username"], $_SESSION["role"]);
        $v->assign('username', $username);
        $v->assign('array_photo',$array_photo);
        $role =$v->imposta_ruolo($_SESSION["role"]);
        echo($role.nl2br("\r\n"));
        $tpl = $home->set_home($username);
        $cont = $home->fetch_Bar($role);
        $v->assign('menu_user', $cont);
        $mainContent = $home->fetch_home($tpl);
        $v->assign('mainContent',$mainContent);
        //$array_photo=$home->thumbnail($array_photo);
        //$v->assign('array_photo',$array_photo);
        $v->display('home_default.tpl');
        //DEVI AGGIUNGERE L'ID AD OGNI FOTO
        //DEVI AGGIUNGERE IL TYPE AD OGNI FOTO ALTRIMENTI NON SI VEDONO CORRETTAMENTE

    }


    /**
     * mostra la home page con messsaggio di errore = Non hai i permessi per effuttuare l'operazione'
     */
    public static function notAllowed()
    {
        $v = new V_Basic();
        $home = new V_Home();
        $banner = $v->fetch('banner_no_permessi.tpl');
        $v->assign('banner', $banner);
        self::standardHome();

    }


    /**
     *
     * Mostra un banner per dire ad un utemte che è stato bannato
     */
    public static function bannedHome()
    {
        $v = new V_Basic();
        $home = new V_Home();
        $banner = $home->fetch_banner($tpl = 'banner_banned');
        $v->assign('banner', $banner);
        self::standardHome();
    }


//questa è da vedere perchè scritta anche in v_registration ed è uguale..
    /**
     * visualizza una banner di errore 
     * @param type $messaggio
     */
    public static function error()
    {
        $v = new V_Basic();
        $home = new V_Home();
        $banner = $home->fetch_banner($tpl = 'banner_error');
        $v->assign('banner', $banner);
        self::standardHome();
    }


    //METODI BASE - NON STATICI!!!\\


    /**
     *
     * Mostra il tamplete della Home di per i non loggati
     */
    public function login()
    {
        $v = new V_Basic();
        $tpl = 'login';
        $this->set_Cont_menu_user($role = 'ospite');
        $this->set_Contenuto_Home($tpl);
        $v->display('home_default.tpl');
    }

    /**
     *
     * Mostra il tamplete della Home di utenti per la registrazione
     */
    public function registration()
    {
        
        $tpl = 'registration';
        $this->set_Cont_menu_user($role = 'ospite');
        $this->set_Contenuto_Home($tpl);
        $this->display('home_default.tpl');
    }

    /**
     * questa funzione serve per impostare qualsiasi pagina del sito
     * @param type $username
     * @param type $role
     * @param type $contenuto è il fetch di un tpl
     */
    public function home_default($role, $tpl)
    {
        
        $cont = $this->fetch_Bar($role);
        $this->assign('menu_user', $cont);
        $mainContent = $this->fetch_home($tpl);
        $this->assign('mainContent',$mainContent);
        $this->display('home_default.tpl');
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     * il contenuto non è altro che il fetch di altri tpl
     */
    public function set_Contenuto_Home($tpl)
    { 
        $mainContent = $this->fetch_home($tpl);
        $this->assign('mainContent',$mainContent);
    }

    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_Cont_menu_user($role)
    {
        echo('$username'.nl2br("\r\n"));
        $cont = $this->fetch_Bar($role);
        $this->assign('menu_user', $cont);
    }


    /**
     * restituisce il contnto del tpl in base all'utente
     */
    public function fetch_Bar($role)
    { 
        $contenuto = $this->fetch('menu_user_'.$role.'.tpl');
        return $contenuto;
    }


    /**
     * restituisce il contnto del tpl in base all'utente
     */
    public function fetch_home($tpl)
    {
        $contenuto = $this->fetch($tpl.'.tpl');
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
        
        $banner = $this->fetch($tpl.'.tpl');
        return $banner;
    }


}

