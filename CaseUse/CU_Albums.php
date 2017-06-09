<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUse;

use Entity\E_Album;
use Exceptions\input_texts;
use Exceptions\queries;
use Foundation\F_Album;

/**
 * Questa classe si occupa di testare metodi di classe per gli oggetti E_Album
 * e le loro rispettive funzioni di Foundation
 */
class CU_Albums
{
    /**
     * Carica un album nel DB
     *
     * @param string $owner Il proprietario dell'album
     * @param string $title Il titolo da dare all'album
     * @param string $desc La descrizione per l'album
     * @param array $cat Le categorie dell'album
     * @param int $creation_date Data di creazione dell'album
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function upload_it($owner, $title, $desc, $cat, $creation_date)
    {
        $E_Album = $this->crea_EAlbum($title, $desc, $cat, $creation_date);
        if($E_Album !== FALSE)
        {
            try
            {
                F_Album::insert($E_Album, $owner);
                echo("Ho inserito l'album nel DB".nl2br("\r\n"));
                return TRUE;
            }
            catch(queries $q)
            {
                echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
                echo(nl2br("\r\n"));
                return FALSE;
            }
        }
    }


    /**
     * Genera un oggetto \Entity\E_Album da usare in altre funzioni
     *
     * @param string $title Il titolo da dare all'album
     * @param string $desc La descrizione per l'album
     * @param array $cat Le categorie dell'album
     * @param int $creation_date La data di creazione dell'album
     * @return boolean|E_Album boolean Indica l'esito delle funzioni. FALSE = almeno un errore
     *                         array Contiene gli oggetti "foto" e "bob"
     */
    private function crea_EAlbum($title, $desc, $cat, $creation_date)
    {
        try
        {
            $a = new E_Album($title, $desc, $cat, $creation_date);
            echo("Creazione album avvenuta con successo".nl2br("\r\n"));
            return $a;
        }
        catch(input_texts $text)
        {
            echo("Messaggio di errore: ".$text->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }

}