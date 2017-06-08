<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUse;

use Entity\E_Photo;
use Entity\E_Photo_Blob;
use Exceptions\input_texts;
use Exceptions\queries;
use Exceptions\uploads;
use Foundation\F_Photo;

/**
 * Questa classe si occupa di testare metodi di classe per gli oggetti E_Photo
 * e le loro rispettive funzioni di Foundation
 */
class CU_Photos
{
    /**
     * Carica una foto nel DB
     *
     * @param string $title Il titolo da dare alla foto
     * @param string $desc La descrizione per la foto
     * @param int $is_reserved La privacy della foto
     * @param array $cat Le categorie della foto
     * @param string $path Il percorso dal quale prendere la foto
     * @param string $uploader L'utente che vuole caricare la foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function upload_it($title, $desc, $is_reserved, $cat, $path, $uploader)
    {
        $results = $this->crea_Foto($title, $desc, $is_reserved, $cat, $path);
        if($results !== FALSE)
        {
            try
            {
                F_Photo::insert($results["foto"], $results["bob"], $uploader);
                echo("Ho inserito la foto nel DB".nl2br("\r\n"));
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
     * Genera un oggetto E_Photo ed uno E_Photo_Blob pronti all'uso per le altre funzioni
     *
     * @param string $title Il titolo da dare alla foto
     * @param string $desc La descrizione per la foto
     * @param int $is_reserved La privacy della foto
     * @param array $cat Le categorie della foto
     * @param string $path Il percorso dal quale prendere la foto
     * @return mixes boolean Indica l'esito delle funzioni. FALSE = almeno un errore
     *               array Contiene gli oggetti "foto" e "bob"
     */
    private function crea_Foto($title, $desc, $is_reserved, $cat, $path)
    {
        //Crea l'oggetto Entity
        try
        {
            $foto = new E_Photo($title, $desc, $is_reserved, $cat);
            echo("Oggetto Entity creato correttamente".nl2br("\r\n"));
        }
        catch(input_texts $text)
        {
            echo($text->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }

        //Generazione del BLOB
        //
//        $path = ".".DIRECTORY_SEPARATOR
//                ."Utilities".DIRECTORY_SEPARATOR
//                ."Install".DIRECTORY_SEPARATOR
//                ."marco.png";
        $bob = new E_Photo_Blob();
        try
        {
            $bob->on_Upload($path);
            echo("Oggetto BLOB generato correttamente".nl2br("\r\n"));
            return array("foto" => $foto, "bob" => $bob);
        }
        catch(uploads $uploads)
        {
            echo($uploads->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


}