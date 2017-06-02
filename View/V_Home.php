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
     * @param array $array_photo array An array with the IDs and Thumbnails of the most liked photos.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username username utente
     */
    public static function standardHome($array_photo, $username = FALSE)
    {
        //da vedere come sistemare le foto per mettere l'id
        $home = new V_Home();
        $home->assign('username', $username);
        if($array_photo["tot_photo"] != 0) //Esistono delle foto
        {
            $home->assign('array_photo', $home->thumbnail($array_photo));
        }
        else
        {
            //FAI STA ROBA.
            //DOVREBBE COMPARIRE LA SCRITTA:
            //"Nessuna foto corrispondente alla ricerca fatta"

            //TI CONSIGLIO DI FARTI UNA FUNZIONE CHE FA QUESTO if-else
            //ED USARLA PER OGNI FUNZIONE CHE MOSTRI DELLE FOTO.
            //RISPARMI UN SACCO DI TEMPO ED è ANCHE FATTO BENE
            //- TI SCRIVO UN ACCENNO DI FUNZIONE: V_Home->CheckPhotos
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
        //A CHE SERVE PASSARE $array_photo ? CHE COSA BISOGNA PASSARE, LE FOTO PIù PIACIUTE?
        //IN OGNI CASO, QUANDO RICEVI ARRAY DI FOTO DEVI SEMPRE FARE IL CONTROLLO SU "tot_photo"
        //SEMPRE.
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
     * @param array $photo_BANNED Foto base del sito
     *               An array containing the \Entity\E_Photo object photo, its uploader, fullsize and type
     *               How to access the array:
     *               - "photo" => the photo's Entity Object
     *               - "uploader" => the user uploader
     *               - "fullsize" => the fullsize photo
     *               - "type" => its type
     */
    public static function bannedHome($photo_BANNED)
    {
        //LA FOTO DA PRENDERE FATTELA PASSARE COME PARAMETRO!
        //USA IL PARAMETRO CHE HO MESSO IO ED ASSUMI SIA UNA FOTO FULLSIZE
        $home = new V_Home();
        //da prendere una foto dal db...questa è una a caso ci vuole uno screen del sito interno
        $home->assign('photo', "templates/main/template/img/noimagefound.jpg"); //QUESTO NON VA BENE
        $home->set_banner($tpl = 'banner_banned');
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'home_guest');
        $home->display('home_default.tpl');
    }


//questa è da vedere perchè scritta anche in v_registration ed è uguale..
    /**
     * visualizza una banner di errore
     *
     * @param array $array_photo foto con + like
     * @param string $username
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


    /**
     * restituisce una vista con le foto della ricerca
     *
     * @param array $array_photo  thumbanils restituite dalla ricerca
     * @param string $username  username
     * @param array $categories  la categoria per cui è stata fatta la ricerca, array
     */
    public static function showPhotoCollection($array_photo, $username, $categories)
    {
        $home = new V_Home();
        $home->assign('username', $username);
        $cat = $home->imposta_categoria($categories); //Non ho capito a che serve...
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
    public static function login($default)
    {
        //LA FOTO DA PRENDERE FATTELA PASSARE COME PARAMETRO!
        //USA IL PARAMETRO CHE HO MESSO IO ED ASSUMI SIA UNA FOTO FULLSIZE
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
    public static function registration($default)
    {
        //LA FOTO DA PRENDERE FATTELA PASSARE COME PARAMETRO!
        //USA IL PARAMETRO CHE HO MESSO IO ED ASSUMI SIA UNA FOTO FULLSIZE
        $home = new V_Home();
        //da prendere una foto dal db...questa è una a caso ci vuole uno screen del sito interno
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'registration');
        $home->display('home_default.tpl');
    }


    //FUNZIONE PROPOSTA - SISTEMA
    public static function welcome($default, $switch)
    {
        $home = new V_Home();
        $home->assign('foto', $default["fullize"]);
        //il TYPE dove lo metti?

        $home->set_Cont_menu_user($role = 'guest');
        switch($switch)
        {
            case 0: //Utente bannato
                $home->set_banner($tpl = 'banner_banned');
                $home->set_Contenuto_Home($tpl = 'home_guest');
                break;

            case 1: //Login
                $home->set_Contenuto_Home($tpl = 'login');
                break;

            case 2: //Registrazione
                $home->set_Contenuto_Home($tpl = 'registration');
                break;

            default: //MOSTRA IL LOGIN
                $home->set_Contenuto_Home($tpl = 'login');
                break;
        }

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