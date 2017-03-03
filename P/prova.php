<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

class prova
{
    public function rnd_str($tot_caratteri=10)
    {
        $char_ammessi = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //62 caratteri totali
        $max_chars = strlen($char_ammessi) - 1; //=61
        $randomString = '';
        for ($i = 0; $i < $tot_caratteri; $i++)
        {
            $randomString .= $char_ammessi[rand(0, $max_chars)]; //$char_ammessi[0, 61] quindi sono 62 caratteri
        }
        return $randomString;
    }
}