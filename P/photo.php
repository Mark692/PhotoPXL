<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use Entity\E_Photo;
use Entity\E_Photo_Blob;
use Foundation\F_Photo;
use P\prova;
use Utilities\Roles;
use const PHOTOS_PER_ROW;

class photo extends prova
{
    private $photo;

    public function __construct()
    {
        $title = parent::rnd_str();
        $desc = parent::rnd_str();
        $is_reserved = rand(0, 1);
        $cat = [];
        for($i = 0; $i < 6; $i++)
        {
            array_push($cat, rand(1, 8));
        }
        $cat = array_unique($cat);
        $up_Date = rand(1111, 6666);
        return $this->photo = new E_Photo($title, $desc, $is_reserved, $cat, $up_Date);
    }


    public function try_Pphoto()
    {
        $separa = "_____________________________________________________________________";

        echo("Eccoci, sono la prova per le funzioni delle foto");
        echo(nl2br("\r\n"));
        echo("INSERT():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->INSERT();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("UPDATE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->UPDATE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_USER():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_BY_USER();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_ID():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_BY_ID();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_ALBUM():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_BY_ALBUM();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_CATEGORIES():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_BY_CATEGORIES();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_LIKELIST():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_LIKELIST();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_MOSTLIKED():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_MOSTLIKED();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_COMMENTSLIST():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_COMMENTSLIST();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->DELETE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE_ALL_FROMALBUM():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->DELETE_ALL_FROMALBUM();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("MOVE_TO():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->MOVE_TO();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }

    public function INSERT()
    {
        $start = rand(7, 12);
        $end = $start + 4;
        $uploader = "AllUser";

        for($i = $start; $i<=$end; $i++)
        {
        $install_dir = ".".DIRECTORY_SEPARATOR
                ."Utilities".DIRECTORY_SEPARATOR
                ."Install".DIRECTORY_SEPARATOR;
        $source_Path = $install_dir.$i;
        $bob = new E_Photo_Blob();
        $bob->on_Upload($source_Path);

        F_Photo::insert($this->photo, $bob, $uploader);
        echo("Inserita la foto: $i");
        echo(nl2br("\r\n"));
        }
        echo("Fatto. Controlla nelle tabelle 'photo', 'cat_photo'");
    }


    PRIVATE FUNCTION Guarda_Risultati___($uploader, $User_Watching, $role, $pageToView, $orderDESC = FALSE)
    {
        $separa = "_____________________________________________________________________";

        $r = F_Photo::get_By_User($uploader, $User_Watching, $role, $pageToView, $orderDESC);
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
        echo("Sono la update");
        echo(nl2br("\r\n"));
        $title = parent::rnd_str();
        $desc = parent::rnd_str();
        $is_reserved = rand(0, 1);
        $cat = [];
        for($i = 0; $i < 6; $i++)
        {
            array_push($cat, rand(1, 8));
        }
        $cat = array_unique($cat);
        $up_Date = rand(1111, 6666);
        $photo = new E_Photo($title, $desc, $is_reserved, $cat, $up_Date);
        echo("Creato l'oggetto photo da sostituire all'id $id:");
        echo(nl2br("\r\n"));
        var_dump($photo);
        echo(nl2br("\r\n"));
        $photo->set_ID($id);
        F_Photo::update($photo);
        echo("Aggiornato");
        echo(nl2br("\r\n"));
    }


    public function GET_BY_USER()
    {
        $uploader = "AllUser";
        $pageToView = 1; //Cambia la pagina per risultati diversi

        $B = Roles::BANNED;
        $S = Roles::STANDARD;
        $P = Roles::PRO;
        $M = Roles::MOD;
        $A = Roles::ADMIN;
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


        $PhotoID = array("Non Esiste" => 58, "Esiste, Pubblica" => 3, "Esiste, Privata" => 4);
        $userWatching = array("UnAltroUtente", "AllUser");
        $B = Roles::BANNED;
        $S = Roles::STANDARD;
        $P = Roles::PRO;
        $M = Roles::MOD;
        $A = Roles::ADMIN;
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
                    $r = F_Photo::get_By_ID($PID, $uw, $role);
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

        $B = Roles::BANNED;
        $S = Roles::STANDARD;
        $P = Roles::PRO;
        $M = Roles::MOD;
        $A = Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);
        $usersWatching = array("UnAltroUtente", "AllUser");
        foreach($usersWatching as $uw)
        {
            echo("User watching: ".$uw);
            echo(nl2br("\r\n"));
            foreach($roles as $role)
            {

                $r = F_Photo::get_By_Album($album_ID, $uw, $role, $pageToView);
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
        $separa = "_____________________________________________________________________";
        $pageToView = 1;
//        $cat = [];
//        for($i = 0; $i < 2; $i++)
//        {
//            array_push($cat, rand(1, 8));
//        }
//        $cat = array_unique($cat);
        $cat = array(1, 2, 3, 4, 5, 6, 7, 8);

        $B = Roles::BANNED;
        $S = Roles::STANDARD;
        $P = Roles::PRO;
        $M = Roles::MOD;
        $A = Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);
        $usersWatching = array("UnAltroUtente", "AllUser");
        foreach($usersWatching as $uw)
        {
            echo("User watching: ".$uw);
            echo(nl2br("\r\n"));
            echo("categorie scelte: ");
            foreach($cat as $c)
            {
                echo($c." ");
            }
            echo(nl2br("\r\n"));
            foreach($roles as $role)
            {

                $r = F_Photo::get_By_Categories($cat, $uw, $role, $pageToView);
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


    public function GET_LIKELIST()
    {
        $fotos = array(3, 4, 5, 876);
        foreach($fotos as $foto)
        {
        echo("Like per la foto ".$foto.": ");
        var_dump(F_Photo::get_LikeList($foto));
        echo(nl2br("\r\n"));
        }
    }


    public function GET_MOSTLIKED()
    {
        $separa = "_____________________________________________________________________";
        $pageToView = 1;

        $B = Roles::BANNED;
        $S = Roles::STANDARD;
        $P = Roles::PRO;
        $M = Roles::MOD;
        $A = Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);
        $usersWatching = array("UnAltroUtente", "AllUser");
        foreach($usersWatching as $uw)
        {
            echo("User watching: ".$uw);
            echo(nl2br("\r\n"));
            foreach($roles as $role)
            {

                $r = F_Photo::get_MostLiked($uw, $role, $pageToView);
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


    public function GET_COMMENTSLIST()
    {
        $fotos = array(16, 21, 23, 26, 27, 28, 31, 32, 33, 34);
        foreach($fotos as $foto)
        {
            echo("Commenti per la foto: ".$foto);
            echo(nl2br("\r\n"));
            var_dump(F_Photo::get_UsernamesThatCommented($foto));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    public function DELETE()
    {
        $id = 5;
        F_Photo::delete($id);
        echo("Ho eliminato la foto $id. Controlla in: LIKES, COMMENT, PHOTO");
    }


    public function DELETE_ALL_FROMALBUM()
    {
        $id = 2;
        F_Photo::delete_ALL_fromAlbum($id);
        echo("Ho eliminato TUTTE LE FOTO prese dall'album $id. Controlla in: ALBUM, LIKES, COMMENT, PHOTO");
    }


    public function MOVE_TO()
    {
        $albums = array(1, 5, 6, 7);
        $photos = array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17);
        while(count($photos) > 0)
        {
            $ak = rand(0, count($albums) - 1);
            $pk = rand(0, count($photos) - 1);
            F_Photo::move_To($albums[$ak], $photos[$pk]);
            echo("Foto $photos[$pk] mossa in $albums[$ak]".nl2br("\r\n"));
            unset($photos[$pk]);
            $photos = array_values($photos);
        }
    }


}