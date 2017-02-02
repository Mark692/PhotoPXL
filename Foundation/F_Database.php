<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use \PDO,
    \PDOException; //Both needed to avoid errors with the Autoloader

/**
 * This class enables basic DB operations
 */
class F_Database
{
    public static $table;
    protected static $primary_Key;


    /**
     * Tries to connect to the DB
     *
     * @global array $config Needed to set the connection parameters
     * @throws PDOException In case of connection errors
     * @return PDO $connection The PDO connection to the DB
     */
    protected static function connettiti()
    {
        try
        {
            global $config;
            $connection = new PDO(
                    'mysql:host='.$config['mysql_host'].'; dbname='.$config['mysql_database'],
                    $config['mysql_user'],
                    $config['mysql_password']);

            //Sostituzione di PDO::ERRMOD_SILENT
            //$connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMOD_SILENT) //Decommenta in Produzione
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Attiva durante lo Sviluppo
            return $connection;
        }
        catch (PDOException $e)
        {
            echo "Impossibile connettersi al database. Errore: ".$e;
        }
    }


    /*
     * Saves an object on the DB
     *
     * @param string $query The query used to save a record on the DB
     */
    protected static function set($query)
    {
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
    }


    /**
     * Executes and rethrives a record from the DB
     *
     * @param type $query The query to execute
     * @return array The result array of the query
     */
    protected static function get($query)
    {
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute();

        $pdo = NULL; //Closes DB connection
        return $pdo_stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Executes a query
     *
     * @param string $query The query to execute
     * @return PDOStatement object The result of the query
     */
//    protected static function execute_query($query)
//    {
//        $pdo = self::connettiti();
//        $pdo_stmt = $pdo->prepare($query);
//        $pdo_stmt->execute();
//
//        $pdo = NULL; //Closes DB connection
//        return $pdo_stmt;
//    }


    /**
     * Allows to update an object details
     *
     * @param string Chiave Primaria della tabella
     * @return bool
     */
//    public static function aggiorna($oggetto)
//    {
//        $memorizzato = $this->get($oggetto->chiave_Primaria);
//        $prima_iterazione = TRUE;
//
//        foreach ($oggetto as $campo => $valore) //Controlla quali campi di $oggetto...
//        {
//            if ($valore != $memorizzato[$campo]) //...differiscono da quelli salvati nel DB
//            {
//                if ($prima_iterazione)
//                {
//                    $modifiche = '`'.$campo.'` = '.$valore;
//                    $prima_iterazione = FALSE;
//                }
//                else
//                {
//                    $modifiche = $modifiche.', `'.$campo.'` = '.$valore;
//                }
//            }
//        }
//        $query = 'UPDATE :ph_tabella '
//                .'SET :ph_modifiche '
//                .'WHERE :ph_chiave_Primaria = :ph_chiave';
//
//        $pdo = self::connettiti();
//        $pdo_stmt = $pdo->prepare($query);
//        $pdo_stmt->execute(array (
//            ":ph_tabella"         => self::$table,
//            ":ph_modifiche"       => $modifiche,
//            ":ph_chiave_Primaria" => self::$primary_Key,
//            ":ph_chiave"          => $oggetto->chiave_Primaria));
//
//        $pdo = NULL; //Chiude la connessione a DB
//        return boolval($pdo_stmt->rowCount());
//    }
}