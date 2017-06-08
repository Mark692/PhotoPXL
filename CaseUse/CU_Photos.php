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
        $E_Photo = $this->crea_Foto_Entity($title, $desc, $is_reserved, $cat);
        $Blob = $this->crea_Foto_Bob($path);
        if($E_Photo !== FALSE && $Blob !== FALSE)
        {
            try
            {
                F_Photo::insert($E_Photo, $Blob, $uploader);
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
     * Aggiorna i dettagli di una foto salvata nel DB
     *
     * @param int $ID L'ID della foto da modificare
     * @param string $title Il nuovo titolo
     * @param string $desc La nuova descrizione
     * @param boolean $is_reserved La nuova privacy
     * @param array $cat Le nuove categorie
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function update_Details($ID, $title, $desc, $is_reserved, $cat)
    {
        $foto = $this->crea_Foto_Entity($title, $desc, $is_reserved, $cat);
        if($foto !== FALSE)
        {
            $foto->set_ID($ID);
            try
            {
                \Foundation\F_Photo::update($foto);
                echo("Finito l'update. Controlla nel DB le tabelle 'photo', 'cat_photo'");
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
     * Mostra le miniature delle foto che corrispondono alla query fatta
     *
     * @param string $uploader L'utente che ha caricato la foto
     * @param string $user_Watching L'utente che vuole visualizzare le foto
     * @param int $user_Role Il ruolo dell'utente che visualizza
     * @param int $page_toView Pagina di risultati alla quale fare riferimento
     * @param boolean $order_DESC Ordinamento dei risultati
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_Thumbs_fromUser($uploader, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
    {
        try
        {
            $DB_result = \Foundation\F_Photo::get_By_User($uploader, $user_Watching, $user_Role, $page_toView, $order_DESC);
            echo("Ho preso le miniature dal DB".nl2br("\r\n"));
            echo("Per ogni risultato sono disponibili: titolo, descrizione, privacy, categorie, uploader".nl2br("\r\n"));

            $this->display_Thumbs($DB_result, $user_Role);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    public function get_Fullsize($id, $user_Watching, $user_Role)
    {
        try
        {
            $DB_result = \Foundation\F_Photo::get_By_ID($id, $user_Watching, $user_Role);
            echo("Ho preso la foto dal DB".nl2br("\r\n"));

            $this->display_Full($DB_result, $user_Role);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Genera un oggetto E_Photo pronto all'uso per le altre funzioni
     *
     * @param string $title Il titolo da dare alla foto
     * @param string $desc La descrizione per la foto
     * @param int $is_reserved La privacy della foto
     * @param array $cat Le categorie della foto
     * @return E_Photo|boolean  boolean Indica l'esito delle funzioni. FALSE = almeno un errore
     *               array Contiene gli oggetti "foto" e "bob"
     */
    private function crea_Foto_Entity($title, $desc, $is_reserved, $cat)
    {
        try
        {
            $foto = new E_Photo($title, $desc, $is_reserved, $cat);
            echo("Oggetto Entity creato correttamente".nl2br("\r\n"));
            return $foto;
        }
        catch(input_texts $text)
        {
            echo("Messaggio di errore: ".$text->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Genera l'oggetto Blob con Fullsize, Thumbnail, Type e Size
     *
     * @param string $path Il percorso dal quale prendere la foto
     * @return E_Photo_Blob|boolean
     */
    private function crea_Foto_Bob($path)
    {
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
            return $bob;
        }
        catch(uploads $err)
        {
            echo($err->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Mostra le miniature delle foto
     *
     * @param array $DB_result Array di risultati preso dal DB
     * @param int $Function_role Il ruolo dell'utente che sta guardando le foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    private function display_Thumbs($DB_result, $Function_role)
    {
        if($DB_result !== [])
        {
            $ruolo = "NON DISPONIBILE"; //Per motivi di compatibilità qualora venisse passato un "ruolo" non valido
            $gestisci_Costanti = new \ReflectionClass('\Utilities\Roles');
            $ruoli_Utenti = $gestisci_Costanti->getConstants();

            foreach($ruoli_Utenti as $nome_Ruolo => $valore_Ruolo)
            {
                if($valore_Ruolo == $Function_role)
                {
                    $ruolo = $nome_Ruolo;
                    break;
                }
            }


            echo("Si visualizzano i risultati in base al ruolo ".$ruolo.nl2br("\r\n"));
            echo("Risultati totali per la ricerca fatta: ".$DB_result["tot_photo"].nl2br("\r\n"));

            $i = 0;
            foreach($DB_result as $k => $thumb)
            {
                if($i % (PHOTOS_PER_ROW + 1) === 0) //va a capo ogni PHOTOS_PER_ROW foto
                {
                    echo(nl2br("\r\n"));
                    $i++;
                }

                if($k !== "tot_photo")
                {
                    $mime = image_type_to_mime_type($thumb["type"]);
                    $pic = $thumb["thumbnail"];
                    //header('Content-Type: image/'.$mime); //Scarica la pagina html...
                    echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                    echo(" ".$thumb["id"]);
                    $i++;
                }
            }
        }
    }


    /**
     * Mostra la foto a grandezza massima (per il sito, ovvero FULL_WIDTH x FULL_HEIGHT)
     *
     * @param array $DB_result Array di risultati preso dal DB
     * @param int $Function_role Il ruolo dell'utente che sta guardando le foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    private function display_Full($DB_result, $Function_role)
    {
        if($DB_result !== [])
        {
            $ruolo = "NON DISPONIBILE"; //Per motivi di compatibilità qualora venisse passato un "ruolo" non valido
            $gestisci_Costanti = new \ReflectionClass('\Utilities\Roles');
            $allowed = $gestisci_Costanti->getConstants();

            foreach($allowed as $nome => $valore)
            {
                if($valore == $Function_role)
                {
                    $ruolo = $nome;
                    break;
                }
            }

            echo("Si visualizza il risultato in base al ruolo ".$ruolo.nl2br("\r\n"));

            //Scala l'immagine per adattarla alle costanti di sistema FULL_WIDTH, FULL_HEIGHT
            $mime = image_type_to_mime_type($DB_result["type"]);
            $image = imagecreatefromstring($DB_result["fullsize"]);
            $width = imagesx($image);
            $height = imagesy($image);
            $bob = new \Entity\E_Photo_Blob();
            list($lungh, $alt) = $bob->adapt_Dimensions($width, $height, FULL_WIDTH, FULL_HEIGHT);

            $pic = imagescale($image, $lungh, $alt);
            ob_start();
            if($mime == IMAGETYPE_JPEG)
            {
                imagejpeg($pic);
            }
            else
            {
                imagepng($pic);
            }
            $contents = ob_get_contents();
            ob_end_clean();
            echo("Titolo: ".$DB_result["photo"]->get_Title().nl2br("\r\n"));
            echo("Descrizione: ".$DB_result["photo"]->get_Description().nl2br("\r\n"));

            echo '<img src="data:'.$mime.'; base64, '.base64_encode($contents).'"/>';
            imagedestroy($pic);
        }
    }


}