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
use ReflectionClass;
use const FULL_HEIGHT;
use const FULL_WIDTH;
use const PHOTOS_PER_ROW;

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
    public function insert($title, $desc, $is_reserved, $cat, $path, $uploader)
    {
        $E_Photo = $this->create_EPhoto($title, $desc, $is_reserved, $cat);
        $Blob = $this->create_EBlob($path);
        if($E_Photo !== FALSE && $Blob !== FALSE)
        {
            try
            {
                F_Photo::insert($E_Photo, $Blob, $uploader);
                $id = $E_Photo->get_ID();
                echo("Ho inserito la foto nel DB. Il suo ID è ".$id.nl2br("\r\n"));
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
        $foto = $this->create_EPhoto($title, $desc, $is_reserved, $cat);
        if($foto !== FALSE)
        {
            $foto->set_ID($ID);
            try
            {
                F_Photo::update($foto);
                echo("Finito l'update. Controlla nel DB le tabelle 'photo', 'cat_photo'".nl2br("\r\n"));
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
    public function get_By_User($uploader, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
    {
        try
        {
            $DB_result = F_Photo::get_By_User($uploader, $user_Watching, $user_Role, $page_toView, $order_DESC);
            echo("Ho preso le miniature dal DB".nl2br("\r\n"));

            $this->display_Thumbs($DB_result, $user_Role);
            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Mostra una foto a dimensione massima (per l'app) ed i relativi dettagli
     *
     * @param int $id L'ID della foto da visualizzare
     * @param string $user_Watching L'utente che vuole visualizzare la foto
     * @param int $user_Role Il ruolo dell'utente che vuole visualizzare la foto
     * @param boolean $order_DESC Determina l'ordinamento dei commenti
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function mostra_FULL($id, $user_Watching, $user_Role, $order_DESC)
    {
        $esito = $this->get_By_ID($id, $user_Watching, $user_Role);
        if($esito === TRUE)
        {
            $comment = new \CaseUse\CU_Comments();
            echo(nl2br("\r\n"));
            $comment->get_By_Photo($id, $order_DESC);
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Visualizza una foto ridimensionandola alle dimensioni massime imposte dall'app
     *
     * @param int $id L'ID della foto da visualizzare
     * @param string $user_Watching L'utente che vuole visualizzare la foto
     * @param int $user_Role Il ruolo dell'utente che vuole visualizzare la foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_By_ID($id, $user_Watching, $user_Role)
    {
        try
        {
            $DB_result = F_Photo::get_By_ID($id, $user_Watching, $user_Role);
            echo("Ho eseguito la query al DB".nl2br("\r\n"));

            if($DB_result === FALSE)
            {
                echo("Spiacenti, nessuna foto corrisponde alla ricerca fatta.");
                echo(nl2br("\r\n"));
                echo("Assicurarsi che la foto esista o che si disponga del ruolo adeguato alla visualizzazione");
                echo(nl2br("\r\n"));
                return FALSE;
            }

            return $this->display_Full($DB_result, $user_Role);
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Vengono mostrate le miniature di tutte le foto appartenenti alle categorie scelte
     *
     * @param array $cats Le categorie che si vogliono usare per filtrare i risultati
     * @param string $user_Watching L'utente che sta richiedendo le foto
     * @param int $user_Role Il ruolo dell'utente
     * @param int $page_toView Determina quale pagina di risultati mostrare
     * @param boolean $order_DESC Determina l'ordinamento dei risultati
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_By_Categories($cats, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
    {
        try
        {
            $DB_result = F_Photo::get_By_Categories($cats, $user_Watching, $user_Role, $page_toView, $order_DESC);
            echo("Ho eseguito la query al DB".nl2br("\r\n"));

            $this->display_Thumbs($DB_result, $user_Role);
            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Genera una lista di utenti che hanno messo "like" alla foto scelta
     *
     * @param int $ID L'ID della foto per la quale
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_LikeList($ID)
    {
        try
        {
            $array_utenti = F_Photo::get_LikeList($ID);
            echo("Utenti ai quali piace la foto $ID: ");
            $s = '';
            foreach($array_utenti as $u)
            {
                echo($u." ");
            }
            echo(substr($s, -2));
            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Mostra le foto più piaciute partendo da quella con il maggior numero di like
     *
     * @param string $user_Watching L'utente che vuole visualizzare la lista di foto
     * @param int $user_Role Il suo ruolo all'interno dell'app
     * @param int $page_toView Determina quale pagina di risultati consultare
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_MostLiked($user_Watching, $user_Role, $page_toView)
    {
        try
        {
            $liked = F_Photo::get_MostLiked($user_Watching, $user_Role, $page_toView);
            echo("<pre>");
            print_r($liked);
            echo("<\pre>");
            echo("Ho eseguito la query al DB".nl2br("\r\n"));

            $this->display_Thumbs($liked, $user_Role);
            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Vengono mostrate le miniature di tutte le foto appartenenti ad un determinato album
     *
     * @param array $album_ID L'album nel quale cercare le foto
     * @param string $user_Watching L'utente che sta richiedendo le foto
     * @param int $user_Role Il ruolo dell'utente
     * @param int $page_toView Determina quale pagina di risultati mostrare
     * @param boolean $order_DESC Determina l'ordinamento dei risultati
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView = 1, $order_DESC = FALSE)
    {
        try
        {
            $DB_result = F_Photo::get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView, $order_DESC);
            echo("Ho eseguito la query al DB".nl2br("\r\n"));

            $this->display_Thumbs($DB_result, $user_Role);
            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Sposta una foto in un altro album. Per rimuovere la foto dall'album usare move_To($photo_ID, 0)
     *
     * @param int $photo_ID La foto da spostare
     * @param int $album_ID L'album in cui inserire la foto
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function move_To($photo_ID, $album_ID)
    {
        try
        {
            \Foundation\F_Photo::move_To($photo_ID, $album_ID);
            echo("Query completata con successo".nl2br("\r\n"));

            return TRUE;
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Elimina una foto dal DB
     *
     * @param int $photo_ID La foto da eliminare assieme ai suoi riferimenti in Likes, Comments e Album
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function delete($photo_ID)
    {
        try
        {
            F_Photo::delete($photo_ID);
            echo("Richiesta al DB completata.".nl2br("\r\n"));
            echo("Verificare che la foto con id $photo_ID sia stata effettivamente eliminata".nl2br("\r\n"));
            return TRUE;
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
     *                          E_Photo Contiene l'oggetto creato
     */
    private function create_EPhoto($title, $desc, $is_reserved, $cat)
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
     * @return E_Photo_Blob|boolean  boolean Indica l'esito delle funzioni. FALSE = almeno un errore
     *                          E_Photo_Blob Contiene l'oggetto creato
     */
    private function create_EBlob($path)
    {
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
            $gestisci_Costanti = new ReflectionClass('\Utilities\Roles');
            $ruoli_Utenti = $gestisci_Costanti->getConstants();

            foreach($ruoli_Utenti as $nome_Ruolo => $valore_Ruolo)
            {
                if($valore_Ruolo == $Function_role)
                {
                    $ruolo = $nome_Ruolo;
                    $const_val = $valore_Ruolo;
                    break;
                }
            }
            if($const_val == \Utilities\Roles::BANNED)
            {
                echo("Spiacente, sei stato Bannato. Non hai accesso alla foto.");
                echo(nl2br("\r\n"));
                echo(nl2br("\r\n"));
                return FALSE;
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
                    echo(" ".$thumb["id"].", ");
                    $i++;
                }
            }
            echo(nl2br("\r\n"));
            echo(nl2br("\r\n"));
        }
        else
        {
            echo("Non è stato preso niente dal DB");
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
        if($DB_result !== FALSE)
        {
            $ruolo = "NON DISPONIBILE"; //Per motivi di compatibilità qualora venisse passato un "ruolo" non valido
            $const = new ReflectionClass('\Utilities\Roles');
            $allowed = $const->getConstants();

            foreach($allowed as $nome => $valore)
            {
                if($valore == $Function_role)
                {
                    $ruolo = $nome;
                    $cons_val = $valore;
                    break;
                }
            }
            if($cons_val == \Utilities\Roles::BANNED)
            {
                echo("Spiacente, sei stato Bannato. Non hai accesso alla foto.");
                echo(nl2br("\r\n"));
                echo(nl2br("\r\n"));
                return FALSE;
            }

            echo("Si visualizza il risultato in base al ruolo ".$ruolo.nl2br("\r\n").nl2br("\r\n"));

            //Scala l'immagine per adattarla alle costanti di sistema FULL_WIDTH, FULL_HEIGHT
            $mime = image_type_to_mime_type($DB_result["type"]);
            $image = imagecreatefromstring($DB_result["fullsize"]);
            $width = imagesx($image);
            $height = imagesy($image);
            $bob = new E_Photo_Blob();
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
            echo("Categorie: ");

            $const = new ReflectionClass('\Utilities\Categories');
            $APP_cats = $const->getConstants();
            $DB_cats = $DB_result["photo"]->get_Categories();
            $categs = '';
            foreach($DB_cats as $c)
            {
                foreach($APP_cats as $k => $v)
                {
                    if($c == $v)
                    {
                        $categs = $categs.$k.', ';
                    }
                }
            }
            echo(substr($categs, 0, -2).nl2br("\r\n"));
            $date = $DB_result["photo"]->get_Upload_Date();
            echo("Data di caricamento: ".date("d/m/y", $date)." alle ore ".date("H:i", $date).nl2br("\r\n"));
            echo("Utente che ha caricato la foto: ".$DB_result["uploader"].nl2br("\r\n"));

            echo '<img src="data:'.$mime.'; base64, '.base64_encode($contents).'"/>';
            imagedestroy($pic);

            echo(nl2br("\r\n"));
            $likes = $DB_result["photo"]->get_NLikes();
            echo("Questa foto piace a ".$likes);
            if($likes == 1)
            {
                echo(" persona".nl2br("\r\n"));
            }
            else
            {
                echo(" persone".nl2br("\r\n"));
            }
            return TRUE;
        }
        else
        {
            echo("Impossibile visualizzare la foto. Non è stato preso niente dal DB".nl2br("\r\n"));
            echo("E' possibile che l'utente scelto non abbia un ruolo adeguato a poter visualizzare la foto".nl2br("\r\n"));
        }
    }


    /*
     * Dati pronti per i test
     *
     *
      //$CU = new \CaseUse\CU_Photos();
      //$title = "Modificato";
      //$desc = "Anche questa è modificata";
      //$is_reserved = 0;
      //$cat = array(1, 5, 6);
      //$path_Photo = ".".DIRECTORY_SEPARATOR
      //                ."Utilities".DIRECTORY_SEPARATOR
      //                ."Install".DIRECTORY_SEPARATOR
      //                ."marco";
      //$uploader = "Marco";
      //
      //$ID = 27;
      //$CU->upload_it($title, $desc, $is_reserved, $cat, $path_Photo, $uploader);
      //$CU->update_Details($ID, $title, $desc, $is_reserved, $cat);
      //
      //$user_Watching = "ProvaUpload";
      //$user_Role = 4;
      //$page_toView = 1;
      //$order_DESC = TRUE;
      //$CU->get_By_User($uploader, $user_Watching, $user_Role, $page_toView, $order_DESC);
      //
      //$id = 39;
      //$CU->get_By_ID($id, $user_Watching, $user_Role);
      //
      //$cats = array(1, 3);
      //$CU->get_By_Categories($cats, $user_Watching, $user_Role, $page_toView, $order_DESC);
      //$CU->get_LikeList(8);
      //$CU->get_MostLiked($user_Watching, $user_Role, $page_toView);
      //
      //$CU->delete(30);
     *
     *
     */
}