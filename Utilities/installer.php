<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Utilities;

class installer
{
    private $default_DB_user;
    private $installer_txt;

    public function __construct()
    {
        $this->default_DB_user = "AllUser";
        $this->installer_txt = ".".DIRECTORY_SEPARATOR."installed.txt";
    }


    /**
     * Sets the correct paramenter to the DB configuration file
     *
     * @param string $form_DBHost
     * @param string $form_DBName
     * @param string $form_DBUsername
     * @param string $form_DBPassword
     */
    public function DB_Setup($form_DBHost, $form_DBName, $form_DBUsername, $form_DBPassword)
    {
        //Prendi questi valori dal FORM
        //Imposta i valori all'array globale $config
        global $config;

        $config['mysql_host'] = $form_DBHost;
        $config['mysql_database'] = $form_DBName;
        $config['mysql_user'] = $form_DBUsername;
        $config['mysql_password'] = $form_DBPassword;

        $this->DB_Check(); //Controlla che questi parametri siano corretti facendo
                           //una query al DB e verificando la tabella "installed"
    }


    /**
     * Checks whether the app is installed or not opening a txt file. If the file
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
        fwrite($text, "1"); //The app is installed
        fclose($text);
    }


    /**
     * Writes to the installation text fle that the app is not correctly installed
     */
    public function set_asInvalidInstallation()
    {
        $text = fopen($this->installer_txt, "w"); //Creates if does not exists and writes to the file
        fwrite($text, "0"); //The app is not correctly installed
        fclose($text);
    }


    /**
     * Checks that the DB connection paramenters are correct and performs a query
     * to check whether the app is installed or not
     *
     * @global array $config
     */
    public function DB_Check()
    {

//---CREATION OF A DB TABLE: CHECKING INSTALLATION---\\
        global $config;
        $DB_Name = $config['mysql_database'];

        $query = "CREATE DATABASE IF NOT EXISTS ".$DB_Name."; "
                ."CREATE TABLE IF NOT EXISTS `installed` "
                ."( "
                    ."`check` tinyint(1) NOT NULL DEFAULT '0', "
                    ."UNIQUE KEY `installed` (`check`)"
                .")";

        //TRY
            //Fai una query
                //-> seleziona il valore di "check"
                    //-> se installed.check === 1
                        //-> l'app è già stata installata. Prosegui normalmente

                    //->se installed.check === 0
                        //-> l'app NON è stata installata ma la query ha avuto successo
                        //quindi i parametri di connessione sono giusti
                            //?!? bisogna impostare gli utenti predefiniti e le foto di default?!?!?!!??
        //CATCH
            //E' stata catturata un'eccezione di PDO
            //Il DB può non essere presente
                //-> FORM DI INSTALLAZIONE
    }


    public function createDB()
    {

    }



    public function DB_Users()
    {
//---DEFAULT USERS---\\
        $insertInto = "users";

        $AllUser = array(
            "username" => $this->default_DB_user,
            "password" => "password0",
            "role" => \Utilities\Roles::ADMIN
                );

        $Marco = array(
            "username" => "Marco",
            "password" => "password1",
            "role" => \Utilities\Roles::ADMIN
                );

        $Bene = array(
            "username" => "Bene",
            "password" => "password2",
            "role" => \Utilities\Roles::ADMIN
                );

        $Fede = array(
            "username" => "Fede",
            "password" => "password3",
            "role" => \Utilities\Roles::ADMIN
                );

        $set = array($AllUser, $Marco, $Bene, $Fede);
        foreach($set as $user)
        {
            \Foundation\F_Database::insert_Query($insertInto, $user);
        }
//---END DEFAULT USERS---\\
    }


    public function DB_Photos()
    {
//---DEFAULT IMAGES---\\
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
            \Foundation\F_Photo::insert($v, $e_photo_Blob[$k], $this->default_DB_user);
        }

//---END DEFAULT IMAGES---\\
    }


}