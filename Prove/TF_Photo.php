<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

class TF_Photo extends \Prove\TFun
{
    private $title;
    private $description;
    private $like = 0;
    private $upload_date;
    private $reserved;
    private $user; //L'utente che ne fa l'upload
    private $categories = []; //Categorie della foto

    private $e_photo;


    /**
     * Genera un \Entity\E_Photo casuale
     * @return array of E_Photo object
     */
    public function __construct()
    {
        parent::__construct();
        //Creazione di un oggetto E_User con dati casuali
        $this->title       = parent::rnd_str(12);
        $this->description = parent::rnd_str(13);
        $this->reserved    = TRUE;
        $this->like        = rand(0, 10);
        $this->user        = parent::rnd_str(14);
        $this->upload_date = 12345;

        $max_cat = rand(0, 5);
//        echo("Categorie massime scelte: ".$max_cat.nl2br("\r\n"));
        for($i=0; $i<$max_cat; $i++) //Aggiunge delle stringhe casuali alle categorie
        {
            $to_add = rand(1, 8);
            while(in_array($to_add, $this->categories))
            {
                $to_add = rand(1, 8);
            }
            array_push($this->categories, rand(1, 8));
        }

        $this->e_photo = new \Entity\E_Photo(
                $this->title,
                $this->description,
                $this->reserved,
                $this->categories,
                $this->like,
                $this->upload_date);

//        echo("Oggetto E_Photo appena creato: ");
//        parent::ogg2arr($this->e_photo);
//        var_dump($this->e_photo);
    }


    public function insert()
    {
        $uploader = "provaDB";
        return \Foundation\F_Photo::insert($this->e_photo, $uploader);
    }


    public function update()
    {
        $this->e_photo->set_ID(28);
        $cat = array(7);
        $this->e_photo->set_Categories($cat);
        return \Foundation\F_Photo::update($this->e_photo);
    }


    public function get_By_User()
    {
        $user = "provaDB";
        $page_toView = 1;
        return \Foundation\F_Photo::get_By_User($user, $page_toView, TRUE);
    }


    public function get_By_ID()
    {
        return \Foundation\F_Photo::get_By_ID(26);
    }


    public function get_By_Album()
    {
        $albumID = 2;
        $page_toView = 1;
        return \Foundation\F_Photo::get_By_Album($albumID, $page_toView, TRUE);
    }


    public function get_By_Categories()
    {
        $cats = array(1, 3, 7);
        $page_toView = 1;
        return \Foundation\F_Photo::get_By_Categories($cats, $page_toView);
    }


    public function get_TotalLikes()
    {
        $photo_ID = 29;
        return \Foundation\F_Photo::get_TotalLikes($photo_ID);
    }


    public function get_MostLiked()
    {
        $page_toView = 1;
        return \Foundation\F_Photo::get_MostLiked($page_toView);
    }


    public function delete()
    {
        $photo_ID = 31;
        return \Foundation\F_Photo::delete($photo_ID);
    }


    public function delete_ALL_fromAlbum()
    {
        $album_ID = 152;
        return \Foundation\F_Photo::delete_ALL_fromAlbum($album_ID);
    }


    public function move_To()
    {
        $photo_ID = 26;
        $album_ID = 152;
        return \Foundation\F_Photo::move_To($album_ID, $photo_ID);
    }
}