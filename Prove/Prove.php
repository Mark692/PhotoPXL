<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class Prove
{


    /**
     * Genera una stringa di caratteri casuali, la lunghezza è passata come parametro
     * @param int $tot_caratteri
     * @return string
     */
    public function rnd_string($tot_caratteri)
    {
        $char_ammessi = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $range = strlen($char_ammessi);
        $randomString = '';
        for ($i = 0; $i < $tot_caratteri; $i++)
        {
            $randomString .= $char_ammessi[rand(0, $range - 1)];
        }
        return $randomString;
    }











}