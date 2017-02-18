<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TF_Photo extends \Foundation\F_Database
{
    public function t_countPages()
    {
        $count = "photo";
        $from = "likes";
        $where = "1";
        $tot = parent::count($count, $from, $where);
        return array("tot_photo" => $tot);
    }

}