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
use ReflectionClass;
use const PHOTOS_PER_ROW;

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
     * Modifica i dettagli di un album
     *
     * @param int $id L'ID dell'album
     * @param string $title Il nuovo titolo
     * @param string $desc La nuova descrizione
     * @param array $cat Le nuove categorie
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function aggiorna_Dettagli($id, $title, $desc, $cat)
    {
        $E_Album = $this->crea_EAlbum($title, $desc, $cat);
        if($E_Album !== FALSE)
        {
            $E_Album->set_ID($id);
            try
            {
                F_Album::update_Details($E_Album);
                echo("Aggiornamento finito. Controlla nelle tabelle Album e cat_album".nl2br("\r\n"));
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
     * Imposta una foto copertina per l'album usando una foto presente nel DB
     *
     * @param int $albumID L'ID dell'album al quale impostare la foto
     * @param int $photoID L'ID della foto da usare per la miniatura/cover
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function imposta_FotoCopertina($albumID, $photoID)
    {
        try
        {
            F_Album::set_Cover($albumID, $photoID);
            echo("Query effettuata con successo.".nl2br("\r\n"));
            echo("Tuttavia può succedere che la foto non venga aggiornata se photoID non è un ID valido.".nl2br("\r\n"));
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
     * Mostra le copertine degli album dell'utente
     *
     * @param string $owner L'utente che ha creato l'album
     * @param int $page_toView Pagina di risultati da mostrare
     * @param boolean $order_DESC Determina l'ordinamento dei risultati
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function mostra_AlbumUtente($owner, $page_toView, $order_DESC)
    {
        try
        {
            $results = F_Album::get_By_User($owner, $page_toView, $order_DESC);
            echo("Query effettuata con successo.".nl2br("\r\n"));

            $this->display_Thumbs($results);
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
     * Mostra le copertine degli album dell'utente
     *
     * @param int $id L'ID dell'album da visualizzare
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function mostra_DettagliAlbum($id)
    {
        try
        {
            $results = F_Album::get_By_ID($id);
            echo("Query effettuata con successo.".nl2br("\r\n"));

            $this->mostra_Copertina($results); //Mostra la copertina

            $E_Album = $results["album"];
            echo("Dettagli album: ".nl2br("\r\n"));
            echo("Titolo: ".$E_Album->get_Title().nl2br("\r\n"));
            echo("Descrizione: ".$E_Album->get_Description().nl2br("\r\n"));

            $cats = $E_Album->get_Categories();
            $categorie = new ReflectionClass('\Utilities\Categories');
            $allowed = $categorie->getConstants();
            $c = '';
            foreach($cats as $v)
            {
                foreach($allowed as $nome => $valore)
                {
                    if($valore == $v)
                    {
                        $c .= $nome.", ";
                    }
                }
            }
            echo("Categorie: ".$c.nl2br("\r\n"));
            echo("Data creazione: ".$E_Album->get_Creation_Date().nl2br("\r\n"));
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
     * Mostra le copertine degli album dell'utente
     *
     * @param array $cats La lista di categorie per le quali si vogliono filtrare i risultati
     * @param int $page_toView Pagina di risultati da mostrare
     * @param boolean $order_DESC Determina l'ordinamento dei risultati
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function mostra_perCategorie($cats, $page_toView, $order_DESC)
    {
        try
        {
            $results = F_Album::get_By_Categories($cats, $page_toView, $order_DESC);
            echo("Query effettuata con successo.".nl2br("\r\n"));

            $this->display_Thumbs($results);
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
     * Elimina l'album selezionato dal DB
     *
     * @param int $id L'ID dell'album da eliminare
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function elimina($id)
    {
        try
        {
            F_Album::delete($id);
            echo("Query effettuata con successo.".nl2br("\r\n"));
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
     * Genera un oggetto \Entity\E_Album da usare in altre funzioni
     *
     * @param string $title Il titolo da dare all'album
     * @param string $desc La descrizione per l'album
     * @param array $cat Le categorie dell'album
     * @param int $creation_date La data di creazione dell'album
     * @return boolean|E_Album boolean Indica l'esito delle funzioni. FALSE = almeno un errore
     *                         array Contiene gli oggetti "foto" e "bob"
     */
    private function crea_EAlbum($title, $desc, $cat, $creation_date = 0)
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


    /**
     * Mostra le miniature delle copertine
     *
     * @param array $DB_result Array di risultati preso dal DB
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    private function display_Thumbs($DB_result)
    {
        if($DB_result !== [])
        {
            echo("Risultati totali per la ricerca fatta: ".$DB_result["tot_album"].nl2br("\r\n"));

            $i = 0;
            foreach($DB_result as $k => $cover)
            {
                if($i % (PHOTOS_PER_ROW + 1) === 0) //va a capo ogni PHOTOS_PER_ROW foto
                {
                    echo(nl2br("\r\n"));
                    $i++;
                }

                if($k !== "tot_album")
                {
                    $mime = image_type_to_mime_type($cover["type"]);
                    $pic = $cover["cover"];
                    echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                    echo(" ".$cover["id"].", ");
                    $i++;
                }
            }
        }
        else
        {
            echo("Non è stato preso niente dal DB");
        }
        echo(nl2br("\r\n"));
    }


    /**
     * Mostra la copertina di un album (quando visto in dettaglio)
     *
     * @param array $DB_result Array di risultati preso dal DB
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    private function mostra_Copertina($DB_result)
    {
        if($DB_result !== [])
        {
            $mime = image_type_to_mime_type($DB_result["type"]);
            $pic = $DB_result["cover"];
            echo '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
        }
        else
        {
            echo("Non è stato preso niente dal DB");
        }
        echo(nl2br("\r\n"));
    }


    /*
     * Dati pronti per i test
     *
     *
//$cu = new \CaseUse\CU_Albums();
//$owner = "Marco";
//$title = "Non mi piace questo ";
//$desc = "e neanche la descrizione";
//$cat = array(1, 3, 6, 7);
//$creation_date = -12342;
//$cu->upload_it($owner, $title, $desc, $cat, $creation_date);

//$id = 1;
//$cu->aggiorna_Dettagli($id, $title, $desc, $cat);

//$photoID = 6;
//$cu->imposta_FotoCopertina($id, $photoID);

//$page_toView = 1;
//$order_DESC = FALSE;
//$cu->mostra_AlbumUtente($owner, $page_toView, $order_DESC);
//$cu->mostra_DettagliAlbum($id);
//$cu->mostra_perCategorie($cat, $page_toView, $order_DESC);
//$cu->elimina(3);
     * 
     */
}