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
    public static function standardHome($array_photo, $username)
    {

        //da vedere come sistemare le foto per mettere l'id
        $home = new V_Home();
        $home->assign('username', $username);
        $home->CheckPhotos($array_photo);
        $home->assign('categories', $home->imposta_categoria());
        $home->set_Contenuto_Home($home->set_home($username));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
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
        $home->CheckPhotos($array_photo);
        $home->assign('categories', $home->imposta_categoria());
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
        $home->showimage($photo_BANNED); //QUESTO NON VA BENE
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
        $home->CheckPhotos($array_photo);
        $home->assign('categories', $home->imposta_categoria());
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($home->set_home($username));
        $home->display('home_default.tpl');
    }


    /**
     * restituisce una vista con le foto della ricerca
     *
     * @param array $array_photo  thumbanils restituite dalla ricerca
     * @param string $username  username
     */
    public static function showPhotoCollection($array_photo, $username)
    {
        $home = new V_Home();
        $home->assign('username', $username);
        $home->CheckPhotos($array_photo);
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'SearchPhoto');
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra il tamplete per effettuare il login
     *
     * @param array $default Foto base del sito
     *               An array containing the \Entity\E_Photo object photo, its uploader, fullsize and type
     *               How to access the array:
     *               - "photo" => the photo's Entity Object
     *               - "uploader" => the user uploader
     *               - "fullsize" => the fullsize photo
     *               - "type" => its type
     */
    public static function login()
    {
        $home = new V_Home();
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'login');
        $home->display('home_default.tpl');
    }


    /**
     *
     * Mostra il tamplete per effettuare il login
     * @param array $default Foto base del sito
     *               An array containing the \Entity\E_Photo object photo, its uploader, fullsize and type
     *               How to access the array:
     *               - "photo" => the photo's Entity Object
     *               - "uploader" => the user uploader
     *               - "fullsize" => the fullsize photo
     *               - "type" => its type
     */
    public static function registration()
    {
        $home = new V_Home();
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->showimage($default);
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'registration');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
    //QUESTE FUNZIONI NON VANNO BENE
    //DEVI AGGIUNGERE UN'ISTANZA DI V_Basic per istanziare l'oggetto e quindi Smarty
    //L'HO FATTO IO. TU CONTROLLA CHE ABBIA UN SENSO QUELLO CHE HO FATTO E CHE FUNZIONI TUTTO
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
        return $this->fetch('menu_user_'.$role.'.tpl');
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
        return $this->fetch($tpl.'.tpl');
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
        return $this->fetch($tpl.'.tpl');
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


    public function CheckPhotos($array_photo)
    {
        if($array_photo['tot_photo'] != 0) //Esistono delle foto
        {
            $this->assign('array_photo', $this->thumbnail($array_photo));
        }
        else
        {
            $this->assign('no_result', 'Nessun Risulato da Visualizzare');
        }
    }


}
