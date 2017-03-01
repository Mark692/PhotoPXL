<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

/**
 * Description of C_Album
 *
 * @author Benedetta
 */
class C_Album {
    
    public function see($albumId){
        // Un utente accede alla sua pagina profilo, clicca su un album e lo
        // apre
    }
    
    public function edit($albumId, $title, $categories, $description){
        // Un utente dopo aver aperto un album, clicca su "modifica", da cui poi
        // può modificare titolo, categorie, descrizione
    }
    
    public function delete($albumId){
        // Un utente dopo aver cliccato su "modiica", può eliminare l'album
    }
    
    public function create($title, $categories, $description){
        // Un utente va nella sua pagina profilo e clicca su "crea album", in cui
        // poi può aggiungere foto, aggiungere titlo, categorie e descrizione
    }
}
