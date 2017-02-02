<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TU_Nonce extends \Prove\TFun
{
    private $arr_nonce;
    private $h_pass;

    /**
     * Assegna i valori di $arr_nonce e $h_pass
     * Stampa i valori ottenuti da \Utilities\U_Nonce()->generate()
     *
     * @param string $hashed_pass L'HASH della password dell'utente
     */
    public function __construct($hashed_pass = '', $_2131='')
    {
        parent::__construct($_2131);
        $this->h_pass = $hashed_pass;
        if($this->h_pass === '')
        {
            $this->h_pass = parent::rnd_str(20);
        }
        $u_nonce = new \Utilities\U_Nonce();
        $this->arr_nonce = $u_nonce->generate($this->h_pass);
        print_r($this->arr_nonce);
        echo(nl2br("\r\n").nl2br("\r\n"));
    }


    /**
     * Testa il funzionamento di \Utilities\U_Nonce()->chech()
     */
    public function T_check()
    {
        $u_nonce = new \Utilities\U_Nonce();
        echo("Test #1 - Password uguale, nonce uguale".nl2br("\r\n")."Il test DEVE ridare TRUE: ");
        var_dump($u_nonce->pass_isValid($this->h_pass, $this->arr_nonce));

        echo(nl2br("\r\n").nl2br("\r\n"));
        echo("Test #2 - Password diversa, nonce uguale".nl2br("\r\n")."Il test DEVE ridare FALSE: ");
        var_dump($u_nonce->pass_isValid(parent::rnd_str(10), $this->arr_nonce));

        echo(nl2br("\r\n").nl2br("\r\n"));
        echo("Test #3. Password uguale, nonce diverso".nl2br("\r\n")."Il test DEVE ridare FALSE: ");
        $u_nonce3 = new \Utilities\U_Nonce();
        $arr3 = $u_nonce3->generate(parent::rnd_str(20));
        var_dump($u_nonce->pass_isValid($this->h_pass, $arr3));

        echo(nl2br("\r\n").nl2br("\r\n"));
        echo("Test #4. Password diversa, nonce diverso".nl2br("\r\n")."Il test DEVE ridare FALSE: ");
        $nonce4 = array("questo è un salt", "questa è la pass+nonce".nl2br("\r\n"));
        var_dump($u_nonce->pass_isValid(parent::rnd_str(15), $nonce4));


    }
}