<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use P\prova;

class album extends prova
{
    private $album;


    public function __construct()
    {
        $title = parent::rnd_str();
        $desc = parent::rnd_str();
        $cat = [];
        for($i = 0; $i < 6; $i++)
        {
            array_push($cat, rand(1, 8));
        }
        $cat = array_unique($cat);
        $up_Date = rand(1111, 6666);
        return $this->album = new \Entity\E_Album($title, $desc, $cat, $up_Date);
//        var_dump($this->album = new \Entity\E_Album($title, $desc, $cat, $up_Date));echo(nl2br("\r\n"));
    }


    public function INSERT($uploader)
    {
        \Foundation\F_Album::insert($this->album, $uploader);
        echo(nl2br("\r\n"));
        echo("Fatto. Controlla nelle tabelle 'album', 'cat_album', 'album_cover'");
        echo(nl2br("\r\n"));
        echo("L'id dell'album è: ".$this->album->get_ID());
    }


    public function UPDATE_DETAILS($id)
    {
        $this->album->set_ID($id);
        \Foundation\F_Album::update_Details($this->album);
    }


    PUBLIC FUNCTION SET_COVER($id)
    {
        $photos = array(1, 2, 19, 26, 32, 33, 34);
        $k = rand(0, count($photos)-1);
        \Foundation\F_Album::set_Cover($id, $photos[$k]);
//        \Foundation\F_Album::set_Cover($id, 32);
        echo("Foto scelta: ".$photos[$k]);
    }


    public function GET_BY_USER()
    {
        $uploader = "AllUser";
        $pageToView = 1; //Cambia la pagina per risultati diversi

            echo("Uploader: ".$uploader);
            echo(nl2br("\r\n"));
                $this->Guarda_Risultati___($uploader, $pageToView, TRUE);

    }


    public function GET_BY_ID()
    {
        $separa = "_____________________________________________________________________";


        $PhotoID = array("Non Esiste" => 18, "Esiste, Pubblica" => 19, "Esiste, Privata" => 26);
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
        $separa = "_____________________________________________________________________";
        $pageToView = 1;
//        $cat = [];
//        for($i = 0; $i < 2; $i++)
//        {
//            array_push($cat, rand(1, 8));
//        }
//        $cat = array_unique($cat);
        $cat = array(1, 2, 3, 4, 5, 6, 7, 8);

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
            echo("categorie scelte: ");
            foreach($cat as $c)
            {
                echo($c." ");
            }
            echo(nl2br("\r\n"));
            foreach($roles as $role)
            {

                $r = \Foundation\F_Photo::get_By_Categories($cat, $uw, $role, $pageToView);
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
        $foto = 39;
        echo("Like per la foto ".$foto.": ");
        var_dump(\Foundation\F_Photo::get_LikeList($foto));
    }


    public function GET_MOSTLIKED()
    {
        $separa = "_____________________________________________________________________";
        $pageToView = 1;

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

                $r = \Foundation\F_Photo::get_MostLiked($uw, $role, $pageToView);
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
            var_dump(\Foundation\F_Photo::get_UsernamesThatCommented($foto));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    public function DELETE()
    {
        $id = 16;
        \Foundation\F_Photo::delete($id);
        echo("Ho eliminato la foto $id. Controlla in: LIKES, COMMENT, PHOTO");
    }


    public function DELETE_ALL_FROMALBUM()
    {
        $id = 6;
        \Foundation\F_Photo::delete_ALL_fromAlbum($id);
        echo("Ho eliminato TUTTE LE FOTO prese dall'album $id. Controlla in: ALBUM, LIKES, COMMENT, PHOTO");
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


    PRIVATE FUNCTION Guarda_Risultati___($uploader, $pageToView, $orderDESC = FALSE)
    {
        $separa = "_____________________________________________________________________";

        $r = \Foundation\F_Album::get_By_User($uploader, $pageToView, $orderDESC);
        echo("Risultati totali per la ricerca fatta: ".$r["tot_album"].nl2br("\r\n"));

//            var_dump($r);



        $i = 0;
        foreach($r as $k => $thumb)
        {echo(nl2br("\r\n"));
            echo("Chiave: ");
            print_r($k);
            echo(nl2br("\r\n"));echo(nl2br("\r\n"));echo(nl2br("\r\n"));
            echo("Valori: ");
            print_r($thumb);















            if($i % (PHOTOS_PER_ROW + 1) === 0)
            { //va a capo ogni PHOTOS_PER_ROW foto
                echo(nl2br("\r\n"));
                $i++;
            }
            if($k !== "tot_album")
            {
                $mime = image_type_to_mime_type($k["type"]);
                $pic = $k["cover"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$k["id"]);
                $i++;
            }
        }
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }

}