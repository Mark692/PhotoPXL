<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TF_Comment extends TFun
{

    public function insert()
    {
        $testo = parent::rnd_str(20);
        $user = "US_".parent::rnd_str(5);
        $photo = "PH_".parent::rnd_str(5);

        $commento = new \Entity\E_Comment($testo, $user, $photo);
        \Foundation\F_Comment::insert($commento);
        echo("We, io sono l'ultimo ID inserito: ".$commento->get_ID());
    }
}