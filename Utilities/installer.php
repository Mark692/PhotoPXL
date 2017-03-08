<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

use \PDO,
    \PDOException;

class installer
{
    private $default_DBuser;
    private $installer_txt;
    private $DBSetup_txt;


    public function __construct()
    {
        $this->default_DBuser = "AllUser";
        $this->installer_txt = ".".DIRECTORY_SEPARATOR."installed.txt";
        $this->DBSetup_txt = ".".DIRECTORY_SEPARATOR."DBSetup.txt";
    }


    /**
     * Sets the correct paramenter to the DB configuration file
     *
     * @param string $form_DBHost The DB host name
     * @param string $form_DBName The DataBase name
     * @param string $form_DBUsername The user connecting to the DB
     * @param string $form_DBPassword The user connecting password
     */
    public function DB_ConnectionParameters(
            $form_DBHost = 'localhost', //Not really necessary
            $form_DBName = 'my_photopxl',
            $form_DBUsername = '',
            $form_DBPassword = '') //Default values for Altervista
    {
        try
        {
            $connection = $this->DB_Check($form_DBHost, $form_DBName, $form_DBUsername, $form_DBPassword);
            $connection = NULL; //Closes DB connection
            echo("ok, i parametri inseriti sono giusti");

            //Saves connection parameters
            //---SBAGLIATO---\\
//---NON SI DEVONO SALVARE STE COSE SU TXT---\\
            $text = fopen($this->DBSetup_txt, "w");
            fwrite($text, $form_DBHost."\n");
            fwrite($text, $form_DBName."\n");
            fwrite($text, $form_DBUsername."\n");
            fwrite($text, $form_DBPassword."\n");
            fclose($text);
//----SBAGLIATO!!!----\\

            //PROSEGUI CON L'ESECUZIONE DELL'APP
        }
        catch(PDOException $ex)
        {
            echo("Il DB non è correttamente configurato. Cambia i parametri di connessione!");
            echo(nl2br("\r\n"));
            echo("In dettaglio: ".$ex->getMessage());
            //Rimanda al form che usa questa funzione
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
                .'dbname='.$form_DBName,
                $form_DBUsername,
                $form_DBPassword
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
        return $connection;
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
     */
    public function set_asInstalled()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "1\n"); //The app is correctly installed
        fclose($text);
    }


    /**
     * Writes to the installation text file that the app is not correctly installed
     */
    public function set_asInvalidInstallation()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "0\n"); //The app is not correctly installed
        fclose($text);
    }


    public function createDB()
    {
        //Prendi il dump sql e usalo per creare il DB.
        //Altervista non permette di avere più di 1 DB o di DROPpare
        //quello esistente.
        //Bisogna fare una CREATE DATABASE IF NOT EXISTS my_photopxl
        //Anche il nome del DB non può essere cambiato e dobbiamo usare
        //il nome datoci da Altervista: my_photopxl
    }


    public function DB_Users()
    {
        $insertInto = "users";

        $AllUser = array(
            "username" => $this->default_DBuser,
            "password" => "password0",
            "role"     => \Utilities\Roles::ADMIN
        );

        $Marco = array(
            "username" => "Marco",
            "password" => "password1",
            "role"     => \Utilities\Roles::ADMIN
        );

        $Bene = array(
            "username" => "Bene",
            "password" => "password2",
            "role"     => \Utilities\Roles::ADMIN
        );

        $Fede = array(
            "username" => "Fede",
            "password" => "password3",
            "role"     => \Utilities\Roles::ADMIN
        );

        $set = array($AllUser, $Marco, $Bene, $Fede);
        foreach($set as $user)
        {
            \Foundation\F_Database::insert_Query($insertInto, $user);
        }
    }


    public function DB_Photos()
    {
        $noAlbumCover = ".".DIRECTORY_SEPARATOR."zzzImmagini".DIRECTORY_SEPARATOR."NoPhoto.jpg";
        $title = "NO ALBUM COVER";
        $desc = "In case no cover has been selected for the album";
        $is_Reserved = TRUE;
        $albumCover = new Entity\E_Photo($title, $desc, $is_Reserved);

        $albumCoverBlob = new \Entity\E_Photo_Blob();
        $albumCoverBlob->on_Upload($noAlbumCover);


        $noProPic = ".".DIRECTORY_SEPARATOR."zzzImmagini".DIRECTORY_SEPARATOR."NoProPic.jpg";
        $title = "NO PROFILE PIC";
        $desc = "In case no image has been selected for the profile";
        $is_Reserved = FALSE;
        $proPic = new Entity\E_Photo($title, $desc, $is_Reserved);

        $proPicBlob = new \Entity\E_Photo_Blob();
        $proPicBlob->on_Upload($noProPic);


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
            \Foundation\F_Photo::insert($v, $e_photo_Blob[$k], $this->default_DBuser);
        }
    }


}