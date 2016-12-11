<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use \PDO, \PDOException; //Per evitare errori con l'autoloader

class F_Database
{

    public static $tabella;
    protected static $chiave_Primaria;


    /*
     * Cerca di connettersi al DB MySQL tramite PDO
     * @throws PDOException in caso di fallita connessione a DB
     * @return obj $connessione
     */
    protected static function connettiti() {

        try {
            global $config;
            $connessione = new PDO('mysql:host=' . $config['mysql']['host'] . '; '
                                 . 'dbname=' . $config['mysql']['database'],
                                   $config['mysql']['user'] ,
                                   $config['mysql']['password']);

            //Sostituzione di PDO::ERRMOD_SILENT
            //$connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMOD_SILENT) //Decommenta in Produzione
            $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
            return $connessione;
        } catch (PDOException $e) {
            echo "Impossibile connettersi al database. Errore: " . $e;
        }
    }


    /*
     * Permette di prendere dal DB un record grazie alla sua Chiave Primaria.
     * Il metodo prende ulteriori parametri in base alla classe che lo estende
     * @param string Chiave Primaria della tabella
     * @return obj \Entity
     */
    public static function get_by($chiave_Primaria) {

        $query = 'SELECT * '
                .'FROM `:ph_tabella` '
                .'WHERE `:ph_chiave_Primaria` = :ph_parametro';

        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute(array(
            "ph_tabella"         => self::$tabella,
            "ph_chiave_Primaria" => self::$chiave_Primaria,
            "ph_parametro"       => $chiave_Primaria));

        $pdo = NULL; //Chiude la connessione a DB
        return $pdo_stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Preso un oggetto in input, questo viene ritornato in due stringhe: $campi, $valori
     * @param type $obj
     * @return array
     */
    public static function keyval($obj)
    {
        $prima_iterazione=TRUE; //Usata per modificare $campi e $valori
        $campi = '';
        $valori = '';
        $ref = new \ReflectionClass($obj); //Servirà per trovare Namespace/Class del parametro $oggetto
        foreach((array) $obj as $field=>$value)
        {
            $field = str_replace($ref->getName(), '', $field); //Rimozione di Namespace/Class da ogni $field

            if($prima_iterazione)
            {
                $campi = "'".$field."'";
                $valori = "'".$value."'";
                $prima_iterazione=FALSE;
            }
            else
            {   $campi  = $campi.", '".$field."'"; //Concatena il primo valore a tutte le altre $key
                $valori = $valori.", '".$value."'";
            }
        }
        return [$campi, $valori];
    }


    /*
     * Permette di salvare sul DB un oggetto.
     * Ogni classe implementa i propri placeholder "tabella" e "chiave_primaria"
     * @param obj
     */
    public static function set($oggetto)
    {
        $out = self::keyval($oggetto);
        echo($query = 'INSERT INTO users ('.$out[0].') '
                .'VALUES ('.$out[1].')');

        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        //$pdo_stmt->bindParam(':ph_tabella', self::$tabella);
        $pdo_stmt->execute();

        $pdo = NULL; //Chiude la connessione a DB
    }


    /*
     * Permette di modificare alcuni dei dettagli dell'oggetto passato come parametro
     * @param string Chiave Primaria della tabella
     * @return bool
     */
    public static function aggiorna($oggetto) {

        $memorizzato = $this->get($oggetto->chiave_Primaria);
        $prima_iterazione=TRUE;

        foreach($oggetto as $campo=>$valore) //Controlla quali campi di $oggetto...
        {
            if($valore!=$memorizzato[$campo]) //...differiscono da quelli salvati nel DB
            {
                if($prima_iterazione)
                {
                    $modifiche = '`'.$campo.'` = '.$valore;
                    $prima_iterazione=FALSE;
                }
                else
                {
                    $modifiche = $modifiche.', `'.$campo.'` = '.$valore;
                }
            }
        }
        $query = 'UPDATE :ph_tabella '
                .'SET :ph_modifiche '
                .'WHERE :ph_chiave_Primaria = :ph_chiave';

        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute(array(
            ":ph_tabella"         => self::$tabella,
            ":ph_modifiche"       => $modifiche,
            ":ph_chiave_Primaria" => self::$chiave_Primaria,
            ":ph_chiave"          => $oggetto->chiave_Primaria));

        $pdo = NULL; //Chiude la connessione a DB
        return boolval($pdo_stmt->rowCount());
    }


}
