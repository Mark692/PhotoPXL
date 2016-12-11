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
     * Genera un \Entity\E_User casuale
     * @return E_User object
     */
    public function rnd_E_User()
    {
        $rn_user = $this->rnd_string(7);
        $rn_pass = $this->rnd_string(10);
        $rn_email = $this->rnd_string(rand(8, 10))."@".$this->rnd_string(rand(3, 6)).".".$this->rnd_string(rand(2, 3));
        $rn_role = rand(0, 4);
        $rn_uploads = rand(0, 14);

        return $e_user = new \Entity\E_User($rn_user, $rn_pass, $rn_email, $rn_role, $rn_uploads);
    }


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


    /**
     * Crea query per salvare nel DB
     */
    public function query($oggetto)
    {
        $prima_iterazione=TRUE; //Usata per modificare $campi e $valori
        $campi = '';
        $valori = '';
        $ref = new \ReflectionClass($oggetto);
        foreach((array) $oggetto as $field=>$value)
        {
            $field = str_replace($ref->getName(), '', $field);

            if($prima_iterazione)
            {
                $campi = '`'.$field.'`';
                $valori = '\''.$value.'\'';
                $prima_iterazione=FALSE;
            }
            else
            {   $campi  = $campi.', `'.$field.'`'; //Concatena il primo valore a tutte le altre $key
                $valori = $valori.', \''.$value.'\'';
            }
        }
        return [$campi, $valori];
    }










}