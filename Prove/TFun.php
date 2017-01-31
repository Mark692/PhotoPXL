<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TFun
{
    /**
     * Genera una stringa di caratteri casuali, la lunghezza è passata come parametro
     * @param int $tot_caratteri
     * @return string
     */
    protected function rnd_str($tot_caratteri)
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


    /**
     * Permette di stampare l'oggetto in forma di array
     * @param obj $obj l'oggetto da stampare
     * @param string $parent_path il percorso Namespace/Parent da eliminare negli attributi dell'oggetto
     */
    protected function ogg2arr($obj, $parent_path='')
    {
        $ref = new \ReflectionClass($obj);
        foreach((array) $obj as $field=>$value)
        {
            if($parent_path==='')
            {
                //NOTA: $ref->getName() NON funziona con classi ereditate
                $field = str_replace($ref->getName(), '', $field); //Rimozione di Namespace/Class da ogni $field
            }
            else //Caso in cui si ha una classe figlia
            {
                $field = str_replace($parent_path, '', $field);
            }
            $field = filter_var($field, FILTER_SANITIZE_STRING); //Rimuove i caratteri non voluti

            if(!is_array($value))
            {
                echo(ucfirst($field)." = ".$value.nl2br("\r\n"));
            }
            else
            {
                print_r($value);
                echo(nl2br("\r\n"));
            }
        }
    }










}