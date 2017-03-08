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
    private $com;

    public function __construct()
    {
        $text = parent::rnd_str();
        $users = array("00uqya5vSg", "9hwQW4f4ld", "ABn3ftfzT8",
                    "AllUser", "Ang3wIY4Qy", "HIXyiQiyyh",
                    "N4sYKtHH84", "uk6BdFFsWD", "VK6q7yMZDU", "ynGzbTNgy5");
        $photos = array(16, 19, 21, 23, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39);

        $ku = rand(0, count($users)-1);
        $kp = rand(0, count($photos)-1);

        $this->com = new \Entity\E_Comment($text, $users[$ku], $photos[$kp]);
    }


    public function INSERT()
    {

    }


    public function GET_BY_PHOTO()
    {

    }


    public function UPDATE()
    {

    }


    public function REMOVE()
    {

    }




















































}

