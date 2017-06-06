<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

use Entity\E_Photo;
use Entity\E_Photo_Blob;
use Entity\E_User_Standard;
use Exceptions\queries;
use Foundation\F_Database;
use Foundation\F_Photo;
use Foundation\F_User_Admin;
use Foundation\F_User_Standard;
use P\album;
use P\comment;
use P\photo;
use P\PMAusers;
use P\std_user;
use P\user;
use PDO;
use PDOException;
use Utilities\Roles;

class installer extends F_Database
{
    private $default_DBuser;
    private $installer_txt;
    private $DBSetup_txt;
    private $noAlbumCover_txt;
    private $noProPic;


    public function __construct()
    {
        $this->default_DBuser = "AllUser";
        $install_dir = ".".DIRECTORY_SEPARATOR
                ."Utilities".DIRECTORY_SEPARATOR
                ."Install".DIRECTORY_SEPARATOR;
        $this->installer_txt = $install_dir."installed.txt";
        $this->DBSetup_txt = $install_dir."my_photopxl.txt";
        $this->noAlbumCover_txt = $install_dir."noCover.jpg";
        $this->noProPic = $install_dir."noProPic.jpg";
    }


    /**
     * Proceeds to creation of the Database and populates it with default data
     */
    public function DB_FirstInstallation()
    {
        echo("Elimino le tabelle se già esistenti...");
        echo(nl2br("\r\n"));
        $this->drop_it();


        echo("Procedo alla creazione del DB... ");
        try
        {
            $this->createDB();
        }
        catch(queries $e)
        {
            return $this->debug_Connection($e);
        }

        echo(nl2br("\r\n"));
        echo("Inserisco delle foto base. Può richiedere del tempo... ");
        try
        {
            try
            {
                $this->DB_Photos();
            }
            catch(queries $e)
            {
                return $this->debug_Connection($e);
            }
        }
        catch(queries $e2)
        {
            return $this->debug_Connection($e2);
        }

        echo(nl2br("\r\n"));
        echo("Inserisco degli utenti base... ");
        try
        {
            $this->DB_Users();
        }
        catch(queries $e)
        {
            return $this->debug_Connection($e);
        }

        echo(nl2br("\r\n"));
        echo("Ora puoi procedere nell'uso dell'applicazione :)");
    }


    /**
     * Drops every table in the DB to enable a correct installation
     */
    private function drop_it()
    {
        $query = "DROP TABLE `profile_pic`; "
                ."DROP TABLE `comment`; "
                ."DROP TABLE `likes`; "
                ."DROP TABLE `photo_album`; "
                ."DROP TABLE `album_cover`; "
                ."DROP TABLE `cat_photo`; "
                ."DROP TABLE `cat_album`; "
                ."DROP TABLE `categories`; "
                ."DROP TABLE `album`; "
                ."DROP TABLE `photo`; "
                ."DROP TABLE `users`;";
        $toBind = [];
        try
        {
            parent::execute_Query($query, $toBind);
        }
        catch(PDOException $e)
        {
            return FALSE;
        }
    }


    /**
     * Creates the DB
     */
    private function createDB()
    {
        $text = fopen($this->DBSetup_txt, "r");
        $query = fread($text, filesize($this->DBSetup_txt));
        fclose($text);
        $toBind = [];
        parent::execute_Query($query, $toBind);
        echo("Fatto!");
    }


    /**
     * Sends messages about a connection error in the installation phase
     *
     * @param PDOException $error A connection problem
     */
    private function debug_Connection($error)
    {
        echo(nl2br("\r\n"));
        echo("Oooops! Sembra che qualcosa sia andato storto. Controlla questi dati per favore e poi riprova:");
        echo(nl2br("\r\n"));
        echo("- Apri XAMPP");
        echo(nl2br("\r\n"));
        echo("-- Accedi a PhpMyAdmin");
        echo(nl2br("\r\n"));
        echo("--- Controlla se esiste un Database chiamato 'my_photopxl'. In caso NON esista BISOGNA crearlo. ");
        echo(nl2br("\r\n"));
        echo("Nome del Database: 'my_photopxl'. Codifica dei Caratteri: 'utf8_unicode_ci'");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("- In caso continuassi a vedere questa schermata riporta questo errore: '".$error->getMessage()."'");
    }


    /**
     * Inserts basic users to work with
     */
    private function DB_Users()
    {
        $Marco = new E_User_Standard("Marco", "password1", "email@pro.va");
        $Bene = new E_User_Standard("Bene", "password2", "email@pro.va");
        $Fede = new E_User_Standard("Fede", "password3", "email@pro.va");

        $set = array($Marco, $Bene, $Fede);
        foreach($set as $user)
        {
            F_User_Standard::insert($user);
            F_User_Admin::change_Role($user->get_Username(), Roles::ADMIN);
        }
        echo("Fatto!");
    }


    /**
     * Inserts basic photos used in the app
     */
    private function DB_Photos()
    {
//NEED to create this user and let him upload the standard photos
//so the other users can have a default pic
        $AllUser = new E_User_Standard($this->default_DBuser, "password0", "email@pro.va");
        F_User_Standard::insert($AllUser);
        F_User_Admin::change_Role($AllUser->get_Username(), Roles::ADMIN);


        $title = "NO ALBUM COVER";
        $desc = "In case no cover has been selected for the album";
        $is_Reserved = TRUE;
        $albumCover = new E_Photo($title, $desc, $is_Reserved);

        $albumCoverBlob = new E_Photo_Blob();
        $albumCoverBlob->on_Upload($this->noAlbumCover_txt);


        $title = "NO PROFILE PIC";
        $desc = "In case no image has been selected for the profile";
        $is_Reserved = TRUE;
        $proPic = new E_Photo($title, $desc, $is_Reserved);

        $proPicBlob = new E_Photo_Blob();
        $proPicBlob->on_Upload($this->noProPic);


        $e_photo = array(
            $albumCover,
            $proPic
        );

        $e_photo_Blob = array(
            $albumCoverBlob,
            $proPicBlob
        );

        foreach($e_photo as $k => $v)
        {
            F_Photo::insert($v, $e_photo_Blob[$k], $this->default_DBuser);
        }
        echo("Fatto!");
    }


    public function try_Functions()
    {
        $separa = "_____________________________________________________________________";

        $user = new user();
        $comment = new comment();

        echo("Aggiungo 3 utenti standard...");
        echo("1: ");
        $std_user = new std_user();
        $std_user->INSERT();

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("UPDATECOUNTERS: ".nl2br("\r\n"));
        echo("2: ");
        $std_user = new std_user();
        $std_user->INSERT();
        $std_user->UPDATECOUNTERS();

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("BECOMEPRO: ".nl2br("\r\n"));
        echo("3: ");
        $std_user = new std_user();
        $std_user->INSERT();
        $std_user->BECOMEPRO();



        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));


        echo("GET_USERDETAILS():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->GET_USERDETAILS();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("IS_AVAILABLE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->IS_AVAILABLE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_LOGININFO():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->GET_LOGININFO();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_ROLE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->GET_ROLE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_ROLE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->GET_BY_ROLE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("CHANGE_DETAILS():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->CHANGE_DETAILS();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));



        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));


        echo("Per poter proseguire devo inserire delle foto...");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        for($i = 1; $i < 18; $i++)
        {
            $photo = new photo();
            $photo->INSERT($i);
        }
        echo("Modifico i dettagli di alcune foto con UPDATE()");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        for($i = 1; $i < 4; $i++)
        {
            $photo = new photo();
            $photo->UPDATE(rand(3, 19));
        }

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Alcuni utenti decidono di cambiare la privacy alle loro foto:");
        $PMAusers = new PMAusers();

        echo("PRO_SET_PHOTOPRIVACY():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $PMAusers->PRO_SET_PHOTOPRIVACY();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("MOD_GET_USERSLIST():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $PMAusers->MOD_GET_USERSLIST();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("MOD_BAN():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $PMAusers->MOD_BAN();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("ADMIN_CHANGE_ROLE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $PMAusers->ADMIN_CHANGE_ROLE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("FOTO: ");
        echo(nl2br("\r\n"));

        echo("GET_BY_USER():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_BY_USER();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_ID():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_BY_ID();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_CATEGORIES():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_BY_CATEGORIES();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("Ora che ci sono delle foto gli utenti cambiano le loro foto profilo");
        echo(nl2br("\r\n"));
        $user->CASODUSO_UPDATE_PRO_PIC();



        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));



        echo("ADD_LIKE_TO():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->ADD_LIKE_TO();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("REMOVE_LIKE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $user->REMOVE_LIKE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));



        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));


        echo("Ora gli utenti decidono di commentare le foto");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $comment->INSERT();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_PHOTO():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $comment->GET_BY_PHOTO();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("UPDATE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $comment->UPDATE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("REMOVE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $comment->REMOVE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));


        echo("Vengono creati degli album: ");

        for($i = 1; $i < 9; $i++)
        {
            $album = new album();
            $album->INSERT();
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo("Aggiornamento dei dettagli:");
            echo(nl2br("\r\n"));
            $album->UPDATE_DETAILS($i);
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
            echo("Cambio cover:");
            echo(nl2br("\r\n"));
            $album->SET_COVER($i);
        }


        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
        echo("Bisogna ora popolare gli album con delle foto");

        echo(nl2br("\r\n"));
        $photo->MOVE_TO();

        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_LIKELIST():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_LIKELIST();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_MOSTLIKED():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_MOSTLIKED();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_COMMENTSLIST():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_COMMENTSLIST();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));


        echo("TORNIAMO AGLI ALBUM: ");
        echo(nl2br("\r\n"));

        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
        echo("GET_BY_USER():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $album->GET_BY_USER();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_ID():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $album->GET_BY_ID();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_CATEGORIES():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $album->GET_BY_CATEGORIES();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $album->DELETE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE_ALBUM_AND_PHOTOS():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $album->DELETE_ALBUM_AND_PHOTOS();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("Infine, facciamo le ultime operazioni con le foto: ");

        echo(nl2br("\r\n"));

        echo("GET_BY_ALBUM():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_BY_ALBUM(1);
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
        echo("GET_BY_ALBUM():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_BY_ALBUM(2);
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
        echo("GET_BY_ALBUM():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->GET_BY_ALBUM(3);
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->DELETE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE_ALL_FROMALBUM():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $photo->DELETE_ALL_FROMALBUM();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }


    /**
     * Sets the correct paramenter to the DB configuration file
     *
     * @param string $form_DBHost The DB host name
     * @param string $form_DBName The DataBase name
     * @param string $form_DBUsername The user connecting to the DB
     * @param string $form_DBPassword The user connecting password
     */
    public function set_DB_ConnectionParameters() //Default values for Altervista
    {
        try
        {
            global $config;
            $connection = $this->DB_Check(
                    $config['mysql_host'],
                    $config['mysql_database'],
                    $config['mysql_user'],
                    $config['mysql_password']);
            $connection = NULL; //Closes DB connection
        }
        catch(PDOException $ex)
        {
            //Sets default connection parameters to enstablish a basic connection
            $config['mysql_user'] = '';
            $config['mysql_password'] = '';
        }
    }


    /**
     * Tries to connect to the DB in order to test the parameters given
     *
     * @throws PDOException Whether the connection parameters are not correct
     * @return PDO The PDO connection to the DB
     */
    private function DB_Check($form_DBHost, $form_DBName, $form_DBUsername, $form_DBPassword)
    {
        $connection = new PDO(
                'mysql:host='.$form_DBHost.'; '
                .'dbname='.$form_DBName, $form_DBUsername, $form_DBPassword
        );
        return $connection;
//        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
    }


    /**
     * Checks whether the app is installed (or not) opening a txt file. If the file
     * does not exists or 0 is written into it, FALSE will be returned.
     *
     * @return boolean Whether the app is already installed or not
     */
    public function is_Installed()
    {
        if(file_exists($this->installer_txt))
        {
            $text = fopen($this->installer_txt, "r");
            $installed = fgetc($text); //Gets the first char of the file only
            fclose($text);

            if($installed === "1") //The app is installed
            {
                return TRUE;
            }
        }
        return FALSE;
    }


    /**
     * Writes to the installation text file that the app is correctly installed
     * UNSTABLE! It generates an infinite loop!! DO NOT USE IT!
     */
    private function set_asInstalled()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "1\n"); //The app is correctly installed
        fclose($text);
    }


    /**
     * Writes to the installation text file that the app is not correctly installed
     * UNSTABLE! It generates an infinite loop!! DO NOT USE IT!
     */
    private function set_asInvalidInstallation()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "0\n"); //The app is not correctly installed
        fclose($text);
    }


}