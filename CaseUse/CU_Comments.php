<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CaseUse;

use Entity\E_Comment;
use Exceptions\input_texts;
use Exceptions\queries;
use Foundation\F_Comment;

/**
 * Questa classe si occupa di testare metodi di classe per gli oggetti E_Comment
 * e le loro rispettive funzioni di Foundation
 */
class CU_Comments
{
    /**
     * Inserisce nel DB un commento
     *
     * @param string $testo Il commento da inserire
     * @param string $utente L'utente che commenta
     * @param int $photoID L'ID della foto da commentare
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function insert($testo, $utente, $photoID)
    {
        $com = $this->create_Comment($testo, $utente, $photoID);
        if($com === FALSE)
        {
            echo("Impossibile procedere all'inserimento del commento nel DB".nl2br("\r\n"));
            return FALSE;
        }

        try
        {
            $id = F_Comment::insert($com);
            echo("Ho inserito il commento nel DB. Il suo ID è ".$id.nl2br("\r\n"));
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
     * Visualizza i commenti per la foto selezionata
     *
     * @param int $photo_ID La foto dalla quale prendere i commenti
     * @param boolean $order_DESC Determina l'ordinamento dei commenti
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function get_By_Photo($photo_ID, $order_DESC)
    {
        try
        {
            $com = F_Comment::get_By_Photo($photo_ID, $order_DESC);
            echo("Commenti degli utenti: ".nl2br("\r\n"));
            if($com !== [])
            {
                $conto = count($com);
                if($conto === 1)
                {
                    echo("Per la foto $photo_ID abbiamo ".$conto." commento:".nl2br("\r\n"));
                }
                else
                {
                    echo("Per la foto $photo_ID abbiamo ".$conto." commenti:".nl2br("\r\n"));
                }
                $i = 1;
                foreach($com as $c)
                {
                    echo($i.") ".$c["user"].": ".$c["text"].nl2br("\r\n"));
                    $i++;
                }
            }
            else
            {
                echo("Non sono presenti commenti per la foto corrente.".nl2br("\r\n"));
            }
        }
        catch(queries $q)
        {
            echo("E' avvenuto un errore contattando il DB: ".$q->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /**
     * Aggiorna un commento già impostato ad una foto
     *
     * @param int $id L'ID del commento da cambiare
     * @param string $testo Il nuovo testo da inserire
     * @param string $utente L'utente che ha fatto il commento iniziale
     * @param int $photoID La foto alla quale cambiare il commento
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function update($id, $testo, $utente, $photoID)
    {
        $com = $this->create_Comment($testo, $utente, $photoID);
        if($com === FALSE)
        {
            echo("Impossibile procedere all'inserimento del commento nel DB".nl2br("\r\n"));
            return FALSE;
        }
        $com->set_ID($id);

        try
        {
            F_Comment::update($com);
            echo("Richiesta completata con successo.".nl2br("\r\n"));
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
     * Elimina un commento esistente
     *
     * @param int $id L'ID del commento da rimuovere
     * @return boolean Indica l'esito delle funzioni. TRUE = nessun errore, FALSE = almeno uno
     */
    public function remove($id)
    {
        try
        {
            F_Comment::remove($id);
            echo("Richiesta completata con successo.".nl2br("\r\n"));
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
     * Genera un oggetto E_Comment
     *
     * @param string $testo Il commento da inserire
     * @param string $utente L'utente che commenta
     * @param int $photoID L'ID della foto da commentare
     * @return boolean|E_Comment Ritorna FALSE se è avvenuto qualche errore
     *                                   Ritorna E_Comment se tutto è andato bene
     */
    private function create_Comment($testo, $utente, $photoID)
    {
        try
        {
            return new E_Comment($testo, $utente, $photoID);
        }
        catch(input_texts $tex)
        {
            echo("Attenzione: ".$tex->getMessage());
            echo(nl2br("\r\n"));
            return FALSE;
        }
    }


    /*
     * Dati pronti per i test
     *
     *
      //$CU = new \CaseUse\CU_Comments();
      //
      //$testo = "A me piace questa";
      //$utente = "Fede";
      //$photoID = 17;
      //$c = $CU->insert($testo, $utente, $photoID);
      //
      //$order_DESC = FALSE;
      //$CU->get_By_Photo($photoID, $order_DESC);
      //
      //$id_commento = 23;
      //$nuovo_testo = "Questo commento non esiste";
      //$CU->update($id_commento, $nuovo_testo, $utente, $photoID);
      //
      //$CU->remove($id_commento);
     *
     */
}