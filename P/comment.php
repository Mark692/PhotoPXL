<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use P\prova;

class comment extends prova
{
    private $com;


    public function __construct()
    {
        $text = parent::rnd_str();
        $users = array("00uqya5vSg", "9hwQW4f4ld", "ABn3ftfzT8",
            "AllUser", "Ang3wIY4Qy", "HIXyiQiyyh",
            "N4sYKtHH84", "uk6BdFFsWD", "VK6q7yMZDU", "ynGzbTNgy5");
        $photos = array(16, 19, 21, 23, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39);

        $ku = rand(0, count($users) - 1);
        $kp = rand(0, count($photos) - 1);

        $this->com = new \Entity\E_Comment($text, $users[$ku], $photos[$kp]);
    }


    public function INSERT()
    {
        \Foundation\F_Comment::insert($this->com);
        echo("Ecco il suo ID: ".$this->com->get_ID());
        echo(nl2br("\r\n"));
    }


    public function GET_BY_PHOTO()
    {
        $fotos = array(16, 21, 23, 26, 27, 28, 31, 32, 33, 34);
        foreach($fotos as $foto)
        {
            echo("Commenti per la foto: ".$foto);
            echo(nl2br("\r\n"));
            var_dump(\Foundation\F_Comment::get_By_Photo($foto));
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    public function UPDATE()
    {
        $text = "Questa EST la prova UPDATE";

        for($i = 1; $i < 26; $i++)
        {
            $newcom = new \Entity\E_Comment($text, 1, 1);
            $newcom->set_ID($i);
            \Foundation\F_Comment::update($newcom);
        }
    }


    public function REMOVE()
    {
        for($i = 1; $i < 11; $i++)
        {
            $id = rand(1, 25);
            \Foundation\F_Comment::remove($id);
            echo("Ho cancellato il commento ".$id);
            echo(nl2br("\r\n"));
        }
    }
}