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
use PDOException;

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
        echo("--- Controlla se esiste un Database chiamato 'my_photopxl'. In caso NON esista DEVI crearlo. ");
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


    /**
     * Sets the correct paramenter to the DB configuration file
     *
     * @param string $form_DBHost The DB host name
     * @param string $form_DBName The DataBase name
     * @param string $form_DBUsername The user connecting to the DB
     * @param string $form_DBPassword The user connecting password
     */
//    public function DB_ConnectionParameters(
//    $form_DBHost = 'localhost', //Not really necessary
//            $form_DBName = 'my_photopxl', $form_DBUsername = '', $form_DBPassword = '') //Default values for Altervista
//    {
//        try
//        {
//            $connection = $this->DB_Check($form_DBHost, $form_DBName, $form_DBUsername, $form_DBPassword);
//            $connection = NULL; //Closes DB connection
//            echo("ok, i parametri inseriti sono giusti");
//
//            //Saves connection parameters
//            //---SBAGLIATO---\\
////---NON SI DEVONO SALVARE STE COSE SU TXT---\\
//            $text = fopen($this->DBSetup_txt, "w");
//            fwrite($text, $form_DBHost."\n");
//            fwrite($text, $form_DBName."\n");
//            fwrite($text, $form_DBUsername."\n");
//            fwrite($text, $form_DBPassword."\n");
//            fclose($text);
////----SBAGLIATO!!!----\\
//            //PROSEGUI CON L'ESECUZIONE DELL'APP
//        }
//        catch(PDOException $ex)
//        {
//            echo("Il DB non è correttamente configurato. Cambia i parametri di connessione!");
//            echo(nl2br("\r\n"));
//            echo("In dettaglio: ".$ex->getMessage());
//            //Rimanda al form che usa questa funzione
//        }
//    }
//
//
//    /**
//     * Tries to connect to the DB in order to test the parameters given
//     *
//     * @throws PDOException Whether the connection parameters are not correct
//     * @return PDO The PDO connection to the DB
//     */
//    private function DB_Check($form_DBHost, $form_DBName, $form_DBUsername, $form_DBPassword)
//    {
//        $connection = new PDO(
//                'mysql:host='.$form_DBHost.'; '
//                .'dbname='.$form_DBName, $form_DBUsername, $form_DBPassword
//        );
//        return $connection;
////        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
//        //Usala nella funzione che richiama DB_Check se la connessione va bene
//    }
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
     */
    private function set_asInstalled()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "1\n"); //The app is correctly installed
        fclose($text);
    }


    /**
     * Writes to the installation text file that the app is not correctly installed
     */
    private function set_asInvalidInstallation()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "0\n"); //The app is not correctly installed
        fclose($text);
    }


}