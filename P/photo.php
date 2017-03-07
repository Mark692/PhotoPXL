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


    public function UPDATE($id)
    {
        $this->photo->set_ID($id);
        \Foundation\F_Photo::update($this->photo);
    }


    public function GET_BY_USER()
    {
        $separa = "_____________________________________________________________________";

        $uploader = "AllUser";
        $user_Watching = "UnAltroUtente"; //CAMBIA QUESTO
        $B = \Utilities\Roles::BANNED; //E/O CAMBIA I RUOLI PER OTTENERE RISULTATI DIVERSI
        $S = \Utilities\Roles::STANDARD;
        $P = \Utilities\Roles::PRO;
        $M = \Utilities\Roles::MOD;
        $A = \Utilities\Roles::ADMIN;
        $roles = array($B, $S, $P, $M, $A);
        foreach($roles as $role)
        {
            $r = \Foundation\F_Photo::get_By_User($uploader, $user_Watching, $role);
            echo("Ruolo: ".$role.nl2br("\r\n"));
            echo("Risultati totali per la ricerca fatta: ".$r["tot_photo"].nl2br("\r\n"));

            $i = 0;
            foreach($r as $k => $thumb)
            {
                if($i % (PHOTOS_PER_ROW + 1) !== 0)
                {
                    if($k !== "tot_photo")
                    {
                        $mime = image_type_to_mime_type($thumb["type"]);
                        $pic = $thumb["thumbnail"];
                        echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                        echo(" ".$thumb["id"]);
                        $i++;
                    }
                }
                else
                {
                    echo(nl2br("\r\n"));
                    $i++;
                }
            }
            echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
        }
    }


}