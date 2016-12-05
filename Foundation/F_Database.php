<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

use \PDO, \PDOException; //Per evitare errori con l'autoloader

class F_Database {
      
    protected static $tabella;
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
    
    
    /*
     * Permette di salvare sul DB un oggetto.
     * Ogni classe implementa in modo proprio.
     * @param obj
     * @return bool
     */
    public static function set($oggetto) {
        
        $prima_iterazione=TRUE;//Usata per modificare $campi e $valori
        foreach($oggetto as $field=>$value) {
            if($prima_iterazione) {
                $campi = '`'.$field.'`';
                $valori = '\''.$value.'\'';
                $prima_iterazione=FALSE;
            } else { $campi  = $campi.', `'.$field.'`'; //Concatena il primo valore a tutte le altre $key
                     $valori = $valori.', \''.$value.'\''; }
        }
        
        $query = 'INSERT INTO `:ph_tabella` (:ph_campi) '
                .'VALUES (:ph_valori)';
        
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute(array(
            "ph_tabella" => $this->tabella,
            "ph_campi"   => $campi,
            "ph_valori"  => $valori));
        
        $pdo = NULL; //Chiude la connessione a DB
        return $pdo_stmt->rowCount();
    }
    
    
    /*
     * Permette di modificare alcuni dei dettagli dell'oggetto passato come parametro
     * @param string Chiave Primaria della tabella
     * @return bool
     */
    public static function aggiorna($oggetto) {
        
        $memorizzato = $this->get($oggetto->chiave_Primaria);
        $prima_iterazione=TRUE;
        
        foreach($oggetto as $campo=>$valore) { //Controlla quali campi di $oggetto...
            if($valore!=$memorizzato[$campo]) { //...differiscono da quelli salvati nel DB
                if($prima_iterazione) {
                    $modifiche = '`'.$campo.'` = '.$valore;
                    $prima_iterazione=FALSE;
                    } else { $modifiche = $modifiche.', `'.$campo.'` = '.$valore; }
            }
        }
        $query = 'UPDATE :ph_tabella '
                .'SET :ph_modifiche '
                .'WHERE :ph_chiave_Primaria = :ph_chiave';
        
        $pdo = self::connettiti();
        $pdo_stmt = $pdo->prepare($query);
        $pdo_stmt->execute(array(
            "ph_tabella"         => self::$tabella,
            "ph_modifiche"       => $modifiche,
            "ph_chiave_Primaria" => self::$chiave_Primaria,
            "ph_chiave"          => $oggetto->chiave_Primaria));
        
        $pdo = NULL; //Chiude la connessione a DB
        return $pdo_stmt->rowCount();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
