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
        $separa = "_____________________________________________________________________";


        echo("Lista completa fino ai primi 100 utenti: ");
        echo(nl2br("\r\n"));
//        \Foundation\F_User_MOD::get_UsersList();
        $r = \Foundation\F_User_MOD::get_UsersList();
        foreach($r as $k => $u)
        {
            if($k !== "total_inDB")
            {
                $mime = image_type_to_mime_type($u["type"]);
                $pic = $u["photo"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$u["user"]);
                echo(nl2br("\r\n"));
            }
        }
        echo("Risultati totali per la ricerca fatta: ".$r["total_inDB"]);

        echo(nl2br("\r\n").$separa);


        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Lista degli stessi utenti, pagina 2, max 3user/pag: ");
        echo(nl2br("\r\n"));
//        \Foundation\F_User_MOD::get_UsersList(2, '', 3);
        $r = \Foundation\F_User_MOD::get_UsersList(2, '', 3);
        foreach($r as $k => $u)
        {
            if($k !== "total_inDB")
            {
                $mime = image_type_to_mime_type($u["type"]);
                $pic = $u["photo"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$u["user"]);
                echo(nl2br("\r\n"));
            }
        }
        echo("Risultati totali per la ricerca fatta: ".$r["total_inDB"]);

        echo(nl2br("\r\n").$separa);

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Lista utenti che iniziano per 'A': ");
        echo(nl2br("\r\n"));
//        \Foundation\F_User_MOD::get_UsersList(1, "A");
        $r = \Foundation\F_User_MOD::get_UsersList(1, "A");
        foreach($r as $k => $u)
        {
            if($k !== "total_inDB")
            {
                $mime = image_type_to_mime_type($u["type"]);
                $pic = $u["photo"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$u["user"]);
                echo(nl2br("\r\n"));
            }
        }
        echo("Risultati totali per la ricerca fatta: ".$r["total_inDB"]);

        echo(nl2br("\r\n").$separa);

        echo(nl2br("\r\n"));
        echo(nl2br("\r\n"));
        echo("Lista utenti: pagina 2, iniziano per 'C', max 4users/page: ");
        echo(nl2br("\r\n"));
//        \Foundation\F_User_MOD::get_UsersList(2, 'C', 4);
        $r = \Foundation\F_User_MOD::get_UsersList(2, 'C', 4);
        foreach($r as $k => $u)
        {
            if($k !== "total_inDB")
            {
                $mime = image_type_to_mime_type($u["type"]);
                $pic = $u["photo"];
                echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                echo(" ".$u["user"]);
                echo(nl2br("\r\n"));
            }
        }
        echo("Risultati totali per la ricerca fatta: ".$r["total_inDB"]);

        echo(nl2br("\r\n").$separa);
    }


    public function MOD_BAN()
    {
        $list = array("AllUser", "P1", "NonEsiste");
        foreach($list as $v)
        {
            echo("Provo a bannare l'utente: ".$v);
            echo(nl2br("\r\n"));
            \Foundation\F_User_MOD::ban($v);
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


    public function ADMIN_CHANGE_ROLE()
    {
        $list = array("AllUser", "P1", "NonEsiste");
        foreach($list as $v)
        {
            $role = rand(0, 4);
            echo("Provo a cambiare il ruolo dell'utente: ".$v." in ".$role);
            echo(nl2br("\r\n"));
            \Foundation\F_User_Admin::change_Role($v, $role);
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
    }


}