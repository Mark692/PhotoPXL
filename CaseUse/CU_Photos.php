<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUse;

/**
 * Questa classe si occupa di testare metodi di classe per gli oggetti E_Photo
 * e le loro rispettive funzioni di Foundation
 */
class CU_Users
{
    /**
     * Carica una foto nel DB
     *
     * @param string $title Il titolo da dare alla foto
     * @param string $desc La descrizione per la foto
     * @param int $is_reserved La privacy della foto
     * @param array $cat Le categorie della foto
     * @param string $path Il percorso dal quale prendere la foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function upload_it($title, $desc, $is_reserved, $cat, $path)
    {
        try
        {

        }
        catch (Exception $ex)
        {

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
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    private function crea_Foto($title, $desc, $is_reserved, $cat, $path)
    {
        //Crea l'oggetto Entity
        try
        {
            $foto = new \Entity\E_Photo($title, $desc, $is_reserved, $cat);
            echo("Oggetto Entity creato correttamente".nl2br("\r\n"));
        }
        catch (\Exceptions\input_texts $text)
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
        $bob = new \Entity\E_Photo_Blob();
        try
        {
            $bob->on_Upload($path);
            echo("Oggetto BLOB generato correttamente".nl2br("\r\n"));
            return array($foto, $bob);
        }
        catch(\Exceptions\uploads $uploads)
        {
            echo($uploads->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }
}
