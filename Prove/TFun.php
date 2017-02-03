<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TFun
{
    protected $separate;


    /**
     * Stampa a video classi e funzioni che necessitano di ulteriore implementazione
     * @param bool $show_2131 TRUE mostra i file con codice 2131, FALSE li nasconde
     */
    public function __construct($show_2131='')
    {
        $this->separate = nl2br("\r\n")."----------------------------------------------".nl2br("\r\n").nl2br("\r\n");

        if($show_2131===2131)
        {

            echo("Error Code 2131 (To Be Implemented):".nl2br("\r\n").nl2br("\r\n"));
            echo("E_Comment:".nl2br("\r\n"));
            echo("1. set_User".nl2br("\r\n"));
            echo("2. get_User".nl2br("\r\n"));
            echo("3. set_Photo".nl2br("\r\n"));
            echo("4. get_User".$this->separate);


            echo("E_Photo:".nl2br("\r\n"));
            echo("1. add_Comment".nl2br("\r\n"));
            echo("2. get_Comment".nl2br("\r\n"));
            echo("3. remove_Comment".$this->separate);

            echo("E_User_PRO:".nl2br("\r\n"));
            echo("1. set_privacy".$this->separate);

            echo("E_User_MOD:".nl2br("\r\n"));
            echo("1. ban_user".$this->separate);

            echo("E_User_Admin:".nl2br("\r\n"));
            echo("1. change_Role".$this->separate);


            //Separa gli output
            echo("______________________________________________________________");
            echo(nl2br("\r\n").nl2br("\r\n"));
        }
    }


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


    protected static function arr_2format($array)
    {
        foreach((array) $array as $chiave => $valore)
        {
            echo($chiave." => ".$valore.nl2br("\r\n"));
        }
    }








}