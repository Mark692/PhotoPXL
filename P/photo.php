<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use P\prova;

class photo extends prova
{
    private $photo;


    public function __construct()
    {
        $title = parent::rnd_str();
        $desc = parent::rnd_str();
        $is_reserved = rand(0, 1);
        $i = 0;
        $cat = [];
        for($i = 0; $i < 6; $i++)
        {
            array_push($cat, rand(1, 8));
        }
        $cat = array_unique($cat);
        $up_Date = rand(1111, 6666);
        return $this->photo = new \Entity\E_Photo($title, $desc, $is_reserved, $cat, $up_Date);
    }


    public function INSERT($percorso, $uploader)
    {
        $source_Path = ".".DIRECTORY_SEPARATOR."zzzImmagini".DIRECTORY_SEPARATOR.$percorso;
        $bob = new \Entity\E_Photo_Blob();
        $bob->on_Upload($source_Path);

        \Foundation\F_Photo::insert($this->photo, $bob, $uploader);
        echo("Fatto. Controlla nelle tabelle 'photo', 'cat_photo'");
    }


    PRIVATE FUNCTION Guarda_Risultati___($uploader, $User_Watching, $role, $pageToView, $orderDESC = FALSE)
    {
        $separa = "_____________________________________________________________________";

        $r = \Foundation\F_Photo::get_By_User($uploader, $User_Watching, $role, $pageToView, $orderDESC);
        echo("Ruolo: ".$role.nl2br("\r\n"));
        echo("Risultati totali per la ricerca fatta: ".$r["tot_photo"].nl2br("\r\n"));

        $i = 0;
        foreach($r as $k => $thumb)
        {
            if($i % (PHOTOS_PER_ROW + 1) === 0)
            { //va a capo ogni PHOTOS_PER_ROW foto
                echo(nl2br("\r\n"));
                $i++;
            }
            if($k !== "tot_photo")
            {
                $mime = image_type_to_mime_type($thumb["type"]);
                $pic = $thumb["thumbnail"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$thumb["id"]);
                $i++;
            }
        }
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }


    public function UPDATE($id)
    {
        $this->photo->set_ID($id);
        \Foundation\F_Photo::update($this->photo);
    }


    public function GET_BY_USER()
    {
        $uploader = "AllUser";
        $pageToView = 1; //Cambia la pagina per risultati diversi

        $B = \Utilities\Roles::BANNED;
        $S = \Utilities\Roles::STANDARD;
        $P = \Utilities\Roles::PRO;
        $M = \Utilities\Roles::MOD;
        $A = \Utilities\Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);
        $usersWatching = array("UnAltroUtente", "AllUser");
        foreach($usersWatching as $uw)
        {
            echo("Uploader: ".$uploader);
            echo(nl2br("\r\n"));
            echo("User watching: ".$uw);
            echo(nl2br("\r\n"));
            foreach($roles as $role)
            {
                $this->Guarda_Risultati___($uploader, $uw, $role, $pageToView);
            }
        }
    }


    public function GET_BY_ID()
    {
        $separa = "_____________________________________________________________________";


        $PhotoID = array("Non Esiste" => 18, "Esiste, Pubblica" => 19, "Esiste, Privata" => 16);
        $userWatching = array("UnAltroUtente", "AllUser");
        $B = \Utilities\Roles::BANNED;
        $S = \Utilities\Roles::STANDARD;
        $P = \Utilities\Roles::PRO;
        $M = \Utilities\Roles::MOD;
        $A = \Utilities\Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);

        foreach($userWatching as $uw)
        {
            echo("Uploader: AllUser");
            echo(nl2br("\r\n"));
            echo("User watching: ".$uw);
            echo(nl2br("\r\n"));
            foreach($PhotoID as $k => $PID)
            {
                foreach($roles as $role)
                {

                    echo("ID: ".$PID." Questa foto: ".$k.nl2br("\r\n"));
                    $r = \Foundation\F_Photo::get_By_ID($PID, $uw, $role);
                    echo("Ruolo: ".$role.nl2br("\r\n"));
                    if($r !== FALSE)
                    {
                        $mime = image_type_to_mime_type($r["type"]);
                        $pic = $r["fullsize"];
                        echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                    }
                    echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
                }
            }
        }
    }


    public function GET_BY_ALBUM($album_ID)
    {
        $separa = "_____________________________________________________________________";
        $pageToView = 1; //Cambia la pagina per risultati diversi

        $B = \Utilities\Roles::BANNED;
        $S = \Utilities\Roles::STANDARD;
        $P = \Utilities\Roles::PRO;
        $M = \Utilities\Roles::MOD;
        $A = \Utilities\Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);
        $usersWatching = array("UnAltroUtente", "AllUser");
        foreach($usersWatching as $uw)
        {
            echo("User watching: ".$uw);
            echo(nl2br("\r\n"));
            foreach($roles as $role)
            {

                $r = \Foundation\F_Photo::get_By_Album($album_ID, $uw, $role, $pageToView);
                echo("Ruolo: ".$role.nl2br("\r\n"));
                echo("Risultati totali per la ricerca fatta: ".$r["tot_photo"].nl2br("\r\n"));

                $i = 0;
                foreach($r as $k => $thumb)
                {
                    if($i % (PHOTOS_PER_ROW + 1) === 0)
                    { //va a capo ogni PHOTOS_PER_ROW foto
                        echo(nl2br("\r\n"));
                        $i++;
                    }
                    if($k !== "tot_photo")
                    {
                        $mime = image_type_to_mime_type($thumb["type"]);
                        $pic = $thumb["thumbnail"];
                        echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                        echo(" ".$thumb["id"]);
                        $i++;
                    }
                }
                echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
            }
        }
    }


    public function GET_BY_CATEGORIES()
    {

    }


    public function GET_LIKELIST()
    {

    }


    public function GET_COMMENTSLIST()
    {

    }


    public function GET_MOSTLIKED()
    {

    }


    public function DELETE()
    {

    }


    public function DELETE_ALL_FROMALBUM()
    {

    }


    public function MOVE_TO()
    {
        $albums = array(1, 5, 6, 7);
        $photos = array(16, 19, 21, 23, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39);
        while(count($photos) > 0)
        {
            $ak = rand(0, count($albums) - 1);
            $pk = rand(0, count($photos) - 1);
            \Foundation\F_Photo::move_To($albums[$ak], $photos[$pk]);
            echo("Foto $photos[$pk] mossa in $albums[$ak]".nl2br("\r\n"));
            unset($photos[$pk]);
            $photos = array_values($photos);
        }
    }


}