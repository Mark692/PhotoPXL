<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;

/**
 * Questa classe testa i vari metodi di E_Photo.
 * Viene fornito output per ogni metodo testato.
 */
class TE_Photo extends \Prove\TFun
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
        echo("Categorie massime scelte: ".$max_cat.nl2br("\r\n"));
        for($i=0; $i<=$max_cat; $i++) //Aggiunge delle stringhe casuali alle categorie
        {
            array_push($this->categories, rand(1, 8));
        }

        $this->e_photo = new \Entity\E_Photo(
                $this->title,
                $this->description,
                $this->reserved,
                $this->categories,
                $this->like,
                $this->upload_date);

        echo("Oggetto E_Photo appena creato: ");
        var_dump($this->e_photo);
    }


    public function insert()
    {
        $uploader = "provaDB";
        \Foundation\F_Photo::insert($this->e_photo, $uploader);
    }




























}