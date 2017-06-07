<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

/**
 * Classe che gestisce le varie viste relative all'homepage di default,
 * i vari messaggi di errore e di banned ed altre funzioni per la gestione dei tpl
 */
class V_Home extends V_Basic
{
    //METODI STATICI -> CONTROL\\
    /**
     * Mostra il template della Home di default per un utnete loggato
     * assrgna a smarty i vari parametri
     *
     * @param array $array_photo array con ID e Thumbnails che hanno più like.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username L'utente che sta cercando di visualizzare la pagina
     */
    public static function standardHome($array_photo, $username)
    {

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
     * Mostra la home page con messsaggio di errore = Non hai i permessi per effuttuare l'operazione'
     *
     * @param array $array_photo array con ID e Thumbnails che hanno più like.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username L'utente che sta cercando di visualizzare la pagina
     */
    public static function notAllowed($array_photo, $username)
    {
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
     * Ritorna la pagina di login per utenti non loggati in caso in cui l'utnete venga bannato
     * 
     */
    public static function bannedHome()
    {
        $home = new V_Home();
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_banner($tpl = 'banner_banned');
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'login');
        $home->display('home_default.tpl');
    }


    /**
     * Visualizza una banner di errore
     * mostra la home page con messsaggio di errore = Ops...Qualcosa è andato storto
     *
     * @param array $array_photo array con ID e Thumbnails che hanno più like.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username L'utente che sta cercando di visualizzare la pagina
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
     * Mostra le thumbanil della ricerca effettuata dall'utente
     *
     * @param array $array_photo array con ID e Thumbnails restituite dalla ricerca fatta.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username L'utente che sta cercando di visualizzare la pagina
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
     * Ritorna il template che consente di effettuare il login
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
     * Ritorna il template che permette di effettuare la registrazione al sito
     */
    public static function registration()
    {
        $home = new V_Home();
        $home->assign('foto', "templates/main/template/img/noimagefound.jpg");
        $home->set_Cont_menu_user($role = 'guest');
        $home->set_Contenuto_Home($tpl = 'registration');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\
    /**
     * La funzione imposta il contenuto principale della home_default.tpl,
     * il contenuto non è altro che il fetch di altri tpl
     * 
     * @param string $tpl Il nome del tpl del quale bisogna fare il fetch
     */
    public function set_Contenuto_Home($tpl)
    {
        $mainContent = $this->fetch_home($tpl);
        $this->assign('mainContent', $mainContent);
    }


    /**
     * La funzione imposta il contenuto della top bar della home_default.tpl,
     * il contenuto non è altro che il fetch di altri tpl
     * 
     * @param stirng $role  stringa che contine il ruolo dell'utente
     */
    public function set_Cont_menu_user($role)
    {
        $cont = $this->fetch_Bar($role);
        $this->assign('menu_user', $cont);
    }


    /**
     * La funzione imposta il contenuto del banner della home_default.tpl, 
     * il quale di defautl è impostato a "&nbsp;"
     * il contenuto non è altro che il fetch di altri tpl
     * 
     * @param string $tpl Il nome del tpl del quale bisogna fare il fetch
     */
    public function set_banner($tpl)
    {
        $cont = $this->fetch_banner($tpl);
        $this->assign('banner', $cont);
    }


    /**
     * Restituisce il contnto del tpl richiesto
     *
     * @param stirng $role  stringa che contine il ruolo dell'utente
     * @return tpl content che contine il fetch del tpl
     */
    public function fetch_Bar($role)
    {
        return $this->fetch('menu_user_'.$role.'.tpl');
    }


    /**
     * Restituisce il contento del tpl richiesto
     *
     * @param string $tpl  nome del tpl da fetchare
     * @return tpl content che contine il fetch del tpl
     */
    public function fetch_home($tpl)
    {
        return $this->fetch($tpl.'.tpl');
    }


    /**
     * Restituisce il contento del tpl richiesto
     *
     * @param string $tpl nome del tpl da fetchare
     * @return string $cotenuto che contine il fetch del tpl
     */
    public function fetch_banner($tpl)
    {
        return $this->fetch($tpl.'.tpl');
    }


    /**
     * Controlla se nell'array_photo ci sono elementi e li assegna a smarty, altrimenti assegna un messaggio
     * 
     * @param array $array_photo array con ID e Thumbnails restituite dalla ricerca fatta.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => it's thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     */
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