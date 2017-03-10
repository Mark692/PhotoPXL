<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use Entity\E_Album;
use Foundation\F_Album;
use P\prova;
use const PHOTOS_PER_ROW;

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
        return $this->album = new E_Album($title, $desc, $cat, $up_Date);
//        var_dump($this->album = new \Entity\E_Album($title, $desc, $cat, $up_Date));echo(nl2br("\r\n"));
    }


    public function try_Palbum()
    {
        $separa = "_____________________________________________________________________";

        echo("Eccoci, sono la prova per le funzioni degli album");
        echo(nl2br("\r\n"));
        echo("INSERT():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->INSERT();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("UPDATE_DETAILS():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->UPDATE_DETAILS();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("SET_COVER():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->SET_COVER();
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

        echo("GET_BY_CATEGORIES():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_BY_CATEGORIES();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->DELETE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("DELETE_ALBUM_AND_PHOTOS():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->DELETE_ALBUM_AND_PHOTOS();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }


    public function INSERT($uploader = "Marco")
    {
        F_Album::insert($this->album, $uploader);
        echo(nl2br("\r\n"));
        echo("Fatto. L'utente $uploader ha creato un album. Controlla nelle tabelle 'album', 'cat_album', 'album_cover'");
        echo(nl2br("\r\n"));
        echo("L'id dell'album è: ".$this->album->get_ID());
    }


    public function UPDATE_DETAILS($id = 1)
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
        $this->album = new E_Album($title, $desc, $cat, $up_Date);
        $this->album->set_ID($id);
        F_Album::update_Details($this->album);
        echo("I nuovi dettagli: ");
        var_dump($this->album);
        echo(nl2br("\r\n"));

    }


    PUBLIC FUNCTION SET_COVER($id = 1)
    {
        $photos = array(1, 2, 19, 26, 32, 33, 34);
        $k = rand(0, count($photos) - 1);
        F_Album::set_Cover($id, $photos[$k]);
//        \Foundation\F_Album::set_Cover($id, 32);
        echo("L'album $id ha cambiato cover. Foto scelta: ".$photos[$k]);
    }


    public function GET_BY_USER()
    {
        $uploaders = array("AllUser", "ABn3ftfzT8");
        $pageToView = 1; //Cambia la pagina per risultati diversi

        foreach($uploaders as $uploader)
        {
            echo("Uploader: ".$uploader);
            echo(nl2br("\r\n"));

            $separa = "_____________________________________________________________________";

            $r = F_Album::get_By_User($uploader, $pageToView);
            echo("Risultati totali per la ricerca fatta: ".$r["tot_album"].nl2br("\r\n"));

            $i = 0;
            foreach($r as $k => $thumb)
            {
                if($i % (PHOTOS_PER_ROW + 1) === 0)
                { //va a capo ogni PHOTOS_PER_ROW foto
                    echo(nl2br("\r\n"));
                    $i++;
                }
                if($k !== "tot_album")
                {
                    $mime = image_type_to_mime_type($thumb["type"]);
                    $pic = $thumb["cover"];
                    echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                    echo(" ".$thumb["id"]);
                    $i++;
                }
            }
            echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
        }
    }


    public function GET_BY_ID()
    {
        $separa = "_____________________________________________________________________";

        $albums = array("Non Esiste" => 1, "Esiste, di AllUser" => 7, "Esiste, di ABn3ftfzT8" => 8);

        foreach($albums as $k => $val)
        {
            echo("ID: ".$val." Questo album: ".$k.nl2br("\r\n"));
            $r = F_Album::get_By_ID($val);

            if($r !== FALSE)
            {
                echo("Trovato l'album: ");
                var_dump($r["album"]);
                echo(nl2br("\r\n"));
                $mime = image_type_to_mime_type($r["type"]);
                $pic = $r["cover"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            }
            echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
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

        echo(nl2br("\r\n"));
        echo("Categorie scelte: ");
        foreach($cat as $c)
        {
            echo($c." ");
        }
        echo(nl2br("\r\n"));
        $r = F_Album::get_By_Categories($cat, $pageToView);
        echo("Risultati totali per la ricerca fatta: ".$r["tot_album"].nl2br("\r\n"));

        $i = 0;
        foreach($r as $k => $thumb)
        {
            if($i % (PHOTOS_PER_ROW + 1) === 0)
            { //va a capo ogni PHOTOS_PER_ROW foto
                echo(nl2br("\r\n"));
                $i++;
            }
            if($k !== "tot_album")
            {
                $mime = image_type_to_mime_type($thumb["type"]);
                $pic = $thumb["cover"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$thumb["id"].": ".$thumb["title"]." ");
                $i++;
            }
        }
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }


    public function DELETE()
    {
        $id = 5;
        F_Album::delete($id);
        echo("Ho eliminato l'album $id. Controlla in: ALBUM, PHOTO_ALBUM.".nl2br("\r\n"));
        echo("Verifica che le sue foto associate vengano preservate in PHOTO");
    }


    public function DELETE_ALBUM_AND_PHOTOS()
    {
        $id = 7;
        F_Album::delete_Album_AND_Photos($id);
        echo("Ho eliminato l'album $id e tutte le sue foto. Controlla in:".nl2br("\r\n"));
        echo("- ALBUM".nl2br("\r\n")."- PHOTO_ALBUM".nl2br("\r\n")."- LIKES".nl2br("\r\n")."-  COMMENT".nl2br("\r\n")."- PHOTO".nl2br("\r\n")."- CAT_ALBUM".nl2br("\r\n")."- CAT_PHOTO");
    }

}