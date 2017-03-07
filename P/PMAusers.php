<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace P;

use Entity\E_User_Admin;
use Entity\E_User_MOD;
use Entity\E_User_PRO;
use Foundation\F_User_PRO;

class PMAusers extends prova
{
    private $pro;
    private $mod;
    private $admin;


    public function __construct()
    {
        $usernamep = parent::rnd_str();
        $usernamem = parent::rnd_str();
        $usernamea = parent::rnd_str();
        $password = parent::rnd_str(15);
        $emailp = "pro@ita.it";
        $emailm = "mod@ita.it";
        $emaila = "admin@ita.it";

        $this->pro = new E_User_PRO($usernamep, $password, $emailp);
        $this->mod = new E_User_MOD($usernamem, $password, $emailm);
        $this->admin = new E_User_Admin($usernamea, $password, $emaila);
    }


    public function PRO_SET_PHOTOPRIVACY($res)
    {
        $photoPRIV = array(4, 6, 8, 10, 11, 12, 13, 14);
        $photoPUB = array(5, 7, 9, 11, 12, 13, 15);
        $priv = TRUE;
        $pub = FALSE;
        if($res == 1)
        {
            foreach($photoPRIV as $photo)
            {
                F_User_PRO::set_PhotoPrivacy($photo, $priv);
            }
        }
        elseif($res == 0)
        {
            foreach($photoPUB as $photo)
            {
                F_User_PRO::set_PhotoPrivacy($photo, $pub);
            }
        }
    }


    public function MOD_GET_USERSLIST()
    {
        echo("Lista completa fino ai primi 100 utenti: ");
//        \Foundation\F_User_MOD::get_UsersList();
        var_dump(\Foundation\F_User_MOD::get_UsersList(1, 'A'));


        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Lista degli stessi utenti, pagina 2, max 3user/pag: ");
//        \Foundation\F_User_MOD::get_UsersList(2, '', 3);
        var_dump(\Foundation\F_User_MOD::get_UsersList(2, '', 3));


        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Lista utenti che iniziano per 'A': ");
//        \Foundation\F_User_MOD::get_UsersList(1, "A");
        var_dump(\Foundation\F_User_MOD::get_UsersList(1, "A"));


        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Lista utenti: pagina 2, iniziano per 'C', max 4users/page: ");
//        \Foundation\F_User_MOD::get_UsersList(2, 'C', 4);
        var_dump(\Foundation\F_User_MOD::get_UsersList(2, 'C', 4));
    }

}