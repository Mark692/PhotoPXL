<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;
class TF_Album extends TFun
{
    private function rnd_album()
    {
        return new \Entity\E_Album(
                parent::rnd_str(), //TITOLO
                parent::rnd_str(), //DESCRIZIONE
                parent::rnd_array(), //CATEGORIE
                1234500); //DATA CREAZIONE
    }


    public function T_insert()
    {
        //L'utente "provaDB" sarà sempre con noi
        $album = $this->rnd_album();
        var_dump($album);
        echo(nl2br("\r\n").nl2br("\r\n"));
        try
        {
            \Foundation\F_Album::insert($album, "provaDB");
        }
        catch (\Exceptions\queries $e)
        {
            echo($e->getMessage());
        }
    }


    public function T_update()
    {
        $album = $this->rnd_album();
        $id = 1;
        $album->set_ID($id);
        var_dump($album);

        $array_album = array(
            "id" => $album->get_ID(),
            "title" => $album->get_Title(),
            "description" => $album->get_Description(),
            "creation_date" => $album->get_Creation_Date()
                );

        echo(nl2br("\r\n").nl2br("\r\n"));
        try
        {
            \Foundation\F_Album::update($album, $id);
        }
        catch (\PDOException $e)
        {
            echo($e->getMessage());
        }
    }

    public function T_getUser()
    {
        $rilsutati = \Foundation\F_Album::get_By_User("provaDB");
        print_r($rilsutati);
        echo(nl2br("\r\n").nl2br("\r\n"));

        foreach($rilsutati as $k => $v)
        {
            echo 'Chiave '.$k.' ';
            print_r($v);
            echo(nl2br("\r\n").nl2br("\r\n"));
        }

    }


    public function T_getCats()
    {
        $cats = parent::rnd_array();
        print_r($cats);
        echo(nl2br("\r\n").nl2br("\r\n"));
        $rilsutati = \Foundation\F_Album::get_By_Categories($cats);
        print_r($rilsutati);
        echo(nl2br("\r\n").nl2br("\r\n"));

        foreach($rilsutati as $k => $v)
        {
            echo 'Chiave '.$k.' ';
            print_r($v);
            echo(nl2br("\r\n").nl2br("\r\n"));
        }

    }







}