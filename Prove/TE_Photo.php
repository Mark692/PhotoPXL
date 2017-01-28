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
    private $id;
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
        //Creazione di un oggetto E_User con dati casuali
        $this->id          = parent::rnd_str(11);
        $this->title       = parent::rnd_str(12);
        $this->description = parent::rnd_str(13);
        $this->like        = rand(-10, 10);
        $this->reserved    = TRUE;
        $this->user        = parent::rnd_str(14);

        $max_cat = rand(0, 5);
        echo("Categorie massime scelte: ".$max_cat.nl2br("\r\n"));
        for($i=0; $i<=$max_cat; $i++) //Aggiunge delle stringhe casuali alle categorie
        {
            array_push($this->categories, parent::rnd_str(rand(5, 13)));
        }

        $this->upload_date = time() - 1400000000;

        $this->e_photo = new \Entity\E_Photo($this->id, $this->title, $this->description, $this->like, $this->reserved, $this->user, $this->categories);
    }


    /**
     * Testa il costruttore di E_Photo.
     * Dato che il costruttore si basa su delle set, queste vengono testate con dati casuali
     */
    public function T_pconstr()
    {
        //Stampa l'oggetto casuale E_User
        echo("Oggetto utente con costruttore ridotto: niente timestamp.".nl2br("\r\n"));
        parent::ogg2arr($this->e_photo);

        echo(nl2br("\r\n").nl2br("\r\n"));
        var_dump($this->e_photo);
        echo(nl2br("\r\n").nl2br("\r\n"));

        //Stampa un oggetto E_User2 ma con ultimo upload fatto molto tempo fa
        $e_photo2 = new \Entity\E_Photo($this->id, $this->title, $this->description, $this->like, $this->reserved, $this->user, $this->categories, -1992);
        echo("Oggetto utente con costruttore completo: timestamp negativo.".nl2br("\r\n"));
        parent::ogg2arr($e_photo2);

        echo(nl2br("\r\n").nl2br("\r\n"));

        //Stampa un oggetto E_User2 ma con ultimo upload fatto molto tempo fa
        $e_photo3 = new \Entity\E_Photo($this->id, $this->title, $this->description, $this->like, $this->reserved, $this->user, $this->categories, $this->upload_date);
        echo("Oggetto utente con costruttore completo: timestamp nel passato.".nl2br("\r\n"));
        parent::ogg2arr($e_photo3);
    }



























}