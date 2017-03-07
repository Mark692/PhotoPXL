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
        for($i = 0; $i<6; $i++)
        {
            array_push($cat, rand(1, 8));
        }
        $cat = array_unique($cat);
        $up_Date = rand(1111, 6666);
        $this->photo = new \Entity\E_Photo($title, $desc, $is_reserved, $cat, $up_Date);
        echo("Foto creata: ");
        var_dump($this->photo);
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
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

}