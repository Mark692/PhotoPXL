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
     * $array_photo array An array with the IDs and Thumbnails of the most liked photos.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function standardHome($user_datails, $array_photo)
    {
        //da vedere come sistemare le foto per mettere l'id e il type
        $home = new V_Home();
        $home->assign('user_datails', $user_datails);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $home->set_Cont_menu_user($home->imposta_ruolo($user_datails['role']));
        $home->set_Contenuto_Home($home->set_home($user_datails['username']));
        $home->display('home_default.tpl');
        //DEVI AGGIUNGERE L'ID AD OGNI FOTO
        //DEVI AGGIUNGERE IL TYPE AD OGNI FOTO ALTRIMENTI NON SI VEDONO CORRETTAMENTE
    }


    /**
     * mostra la home page con messsaggio di errore = Non hai i permessi per effuttuare l'operazione'
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function notAllowed($user_datails, $array_photo)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_no_permessi');
        $home->assign('username', $user_datails['username']);
        $home->assign('array_photo', $array_photo);
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $role = $home->imposta_ruolo($user_datails['role']);
        $home->set_Cont_menu_user($role);
        $home->set_Contenuto_Home($home->set_home($user_datails['username']));
        $home->assign('array_photo',$home->thumbnail($array_photo));
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra un banner per dire ad un utemte che è stato bannato
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function bannedHome($array_photo) //CONTROLLARE I PARAMETRI DA PASSARE
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_banned');
        $home->assign('array_photo', $array_photo);
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $home->set_Cont_menu_user($role='guest');
        $home->set_Contenuto_Home($tpl='home_guest');
        $home->assign('array_photo',$home->thumbnail($array_photo));
        $home->display('home_default.tpl');
    }


//questa è da vedere perchè scritta anche in v_registration ed è uguale..
    /**
     * visualizza una banner di errore 
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $array_photo Description foto con + like
     */
    public static function error($user_datails, $array_photo)
    {
        $home = new V_Home();
        $home->set_banner($tpl = 'banner_error');
        $home->assign('username', $user_datails['username']);
        $home->assign('array_photo', $array_photo);
        $categories = $home->imposta_categoria();
        $home->assign('categories', $categories);
        $home->set_Cont_menu_user($home->imposta_ruolo($user_datails['role']));
        $home->set_Contenuto_Home($home->set_home($user_datails['username']));
        $home->assign('array_photo',$home->thumbnail($array_photo));
        $home->display('home_default.tpl');
    }

    /*
     * 
     * 
     * @param type $user_datails Description i dati dell'utente
     * @param type $photos Description thumbanils restituite dalla ricerca
     */
    public static function showPhotoCollection($photos,$user_datails)
    {
        $home=new V_Home();
        $home->assign('username',$user_datails['username']);
        $home->assign('photos', $photos);
        $home->set_Cont_menu_user($home->imposta_ruolo($user_datails['role']));
        $home->set_Contenuto_Home($tpl = 'SearchPhoto');
        $home->assign('array_photo',$home->thumbnail($photos));
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra il tamplete per effettuare il login
     */
    public static function login() 
    {
        $home=new V_Home(); 
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
        $home=new V_Home(); 
        $home->set_Cont_menu_user($role = 'guest'); 
        $home->set_Contenuto_Home($tpl = 'registration'); 
        $home->display('home_default.tpl');
    }
    
    //METODI BASE - NON STATICI!!!\\




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
        $this->assign('mainContent', $mainContent);
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
        $this->assign('mainContent', $mainContent);
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_Cont_menu_user($role)
    {
        $cont = $this->fetch_Bar($role);
        $this->assign('menu_user', $cont);
    }


    /**
     * imposta il contenuto principale alla variabile privata della classe
     * Scrive nel tpl gli attributi della classe
     */
    public function set_banner($tpl)
    {
        $cont = $this->fetch_banner($tpl);
        $this->assign('banner', $cont);
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


    /*
     * fa il fetch del tpl che gli viene passato come parametro
     */
    public function fetch_banner($tpl)
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


}
