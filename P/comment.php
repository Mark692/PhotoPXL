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


    public function INSERT()
    {
        $users = array("AllUser", "Marco", "Fede");
        $photos = array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);
        for($i = 1; $i < 26; $i++)
        {
            $text = parent::rnd_str();
            $ku = rand(0, count($users) - 1);
            $kp = rand(0, count($photos) - 1);

            $this->com = new E_Comment($text, $users[$ku], $photos[$kp]);
            F_Comment::insert($this->com);
            echo("Commento ID: ".$this->com->get_ID()." - Aggiunto commento di $users[$ku] sulla foto $photos[$kp].");
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
        $text = "Questa è la prova UPDATE";
            echo(nl2br("\r\n"));

        for($i = 1; $i < 26; $i++)
        {
            $newcom = new E_Comment($text, 1, 1);
            $newcom->set_ID($i);
            F_Comment::update($newcom);
            echo("Modificato il commento $i");
            echo(nl2br("\r\n"));
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