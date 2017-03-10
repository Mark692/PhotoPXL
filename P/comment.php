<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use Entity\E_Comment;
use Foundation\F_Comment;
use P\prova;

class comment extends prova
{
    private $com;


    public function __construct()
    {
        $text = parent::rnd_str();
        $users = array("AllUser", "Marco", "Bene", "Fede");
        $photos = array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);

        $ku = rand(0, count($users) - 1);
        $kp = rand(0, count($photos) - 1);

        $this->com = new E_Comment($text, $users[$ku], $photos[$kp]);
    }


    public function try_Pcomment()
    {
        $separa = "_____________________________________________________________________";

        echo("Eccoci, sono la prova per le funzioni dei commenti");
        echo(nl2br("\r\n"));
        echo("INSERT():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->INSERT();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("GET_BY_PHOTO():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->GET_BY_PHOTO();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("UPDATE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->UPDATE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));

        echo("REMOVE():");
        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        $this->REMOVE();
        echo(nl2br("\r\n").$separa.nl2br("\r\n").nl2br("\r\n"));
    }


    public function INSERT()
    {
        $users = array("AllUser", "Marco", "Bene", "Fede");
        $photos = array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);
        for($i = 1; $i < 26; $i++)
        {
            $text = parent::rnd_str();
            $ku = rand(0, count($users) - 1);
            $kp = rand(0, count($photos) - 1);

            $this->com = new E_Comment($text, $users[$ku], $photos[$kp]);
            F_Comment::insert($this->com);
            echo("Aggiunto commento con ID: ".$this->com->get_ID());
            echo(nl2br("\r\n"));
        }
    }


    public function GET_BY_PHOTO()
    {
        $fotos = array(16, 21, 23, 26, 27, 28, 31, 32, 33, 34);
        foreach($fotos as $foto)
        {
            echo("Commenti per la foto: ".$foto);
            echo(nl2br("\r\n"));
            var_dump(F_Comment::get_By_Photo($foto));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    public function UPDATE()
    {
        $text = "Questa EST la prova UPDATE";

        for($i = 1; $i < 26; $i++)
        {
            $newcom = new E_Comment($text, 1, 1);
            $newcom->set_ID($i);
            F_Comment::update($newcom);
        }
    }


    public function REMOVE()
    {
        for($i = 1; $i < 11; $i++)
        {
            $id = rand(1, 25);
            F_Comment::remove($id);
            echo("Ho cancellato il commento ".$id);
            echo(nl2br("\r\n"));
        }
    }


}