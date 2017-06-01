<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Home extends V_Basic
{
    //METODI STATICI -> CONTROL\\
    /**
     * Mostra il template della Home di default
     *
     * @param type $username Description username utente
     * @param array $array_photo array An array with the IDs and Thumbnails of the most liked photos.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     */
    public static function standardHome($array_photo = [], $username = FALSE)
    {
        //da vedere come sistemare le foto per mettere l'id 
        $home = new V_Home();
        $home->assign('username', $username);
        if(isset($array_photo))
        {
            $home->assign('array_photo', $home->thumbnail($array_photo));
        }
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        if($username === FALSE)
        {
            $role = 'guest';
            //da prendere una foto dal db...questa è una a caso ci vuole uno screen del sito interno
            $home->assign('photo', "templates/main/template/img/noimagefound.jpg");
        }
        else
        {
            $role = $home->imposta_ruolo(\Entity\E_User::get_DB_Role($username));
        }
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /**
     * mostra la home page con messsaggio di errore = Non hai i permessi per effuttuare l'operazione'
     *
     * @param type $array_photo Description foto con + like
     * @param type $username Description username 
     */
    public static function notAllowed($array_photo, $username)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_no_permessi');
        $home->assign('username', $username);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra un banner per dire ad un utente che è stato bannato
     *

     */
    public static function bannedHome()
    {
        $home = new V_Home();
        //da prendere una foto dal db...questa è una a caso ci vuole uno screen del sito interno
        $home->assign('photo', "templates/main/template/img/noimagefound.jpg");
        $home->set_banner($tpl = 'banner_banned');
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'home_guest');
        $home->display('home_default.tpl');
    }


//questa è da vedere perchè scritta anche in v_registration ed è uguale..
    /**
     * visualizza una banner di errore
     *
     * @param type $array_photo Description foto con + like
     * @param type $username  
     */
    public static function error($array_photo, $username)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_error');
        $home->assign('username', $username);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /*
     * restituisce una vista con le foto della ricerca
     *
     * @param type username Description username
     * @param type array_photo Description thumbanils restituite dalla ricerca
     * @param type categories Description la categoria per cui è stata fatta la ricerca, array
     */
    public static function showPhotoCollection($array_photo, $username,$categories)
    {
        $home = new V_Home();
        $home->assign('username', $username);
        $cat = $home->imposta_categoria($categories);
        $home->assign('categories', $cat);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'SearchPhoto');
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra il tamplete per effettuare il login
     */
    public static function login()
    {
        $home = new V_Home();
        //da prendere una foto dal db...questa è una a caso ci vuole uno screen del sito interno
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'login');
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra il tamplete per effettuare il login
     */
    public static function registration()
    {
        $home = new V_Home();
        //da prendere una foto dal db...questa è una a caso ci vuole uno screen del sito interno
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'registration');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     * il contenuto non è altro che il fetch di altri tpl
     */
    public function set_Contenuto_Home($tpl)
    {
        $mainContent = $this->fetch_home($tpl);
        $this->assign('mainContent', $mainContent);
    }


    /**
     * 
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_Cont_menu_user($role)
    {
        $cont = $this->fetch_Bar($role);
        $this->assign('menu_user', $cont);
    }


    /**
     * 
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_banner($tpl)
    {
        $cont = $this->fetch_banner($tpl);
        $this->assign('banner', $cont);
    }


    /**
     * 
     * restituisce il contnto del tpl richiesto
     * 
     * @param type $role description stringa che contine il ruolo dell'user...non numerico
     * @return type $cotenuto che contine il etch del tpl
     */
    public function fetch_Bar($role)
    {
        $contenuto = $this->fetch('menu_user_'.$role.'.tpl');
        return $contenuto;
    }


    /**
     * 
     * restituisce il contento del tpl richiesto
     * 
     * @param type $tpl description nome del tpl da fetchare
     * @return type $cotenuto che contine il etch del tpl
     */
    public function fetch_home($tpl)
    {
        $contenuto = $this->fetch($tpl.'.tpl');
        return $contenuto;
    }


    /**
     * 
     * fa il fetch del tpl che gli viene passato come parametro
     * 
     * @param type $tpl description nome del tpl da fetchare
     * @return type $cotenuto che contine il etch del tpl
     */
    public function fetch_banner($tpl)
    {

        $contenuto = $this->fetch($tpl.'.tpl');
        return $contenuto;
    }


    /**
     * 
     * setta il contenuto della homepage in base al fatto l'utente sia loggato oppure no
     * 
     * @param type $username prende il valore da session
     * @return type tpl
     */
    public function set_home($username)
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


}