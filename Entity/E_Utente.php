<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * Classe atta a definire ogni utente
 */
class E_Utente {

    public $username;
    public $password;
    public $mail;
    public $role;
    
    /*
     * Contatore giornaliero di upload
     * @type int
     */
    private $upload_Count;
    
    /*
     * Conserva la DATA in formato "d/m/y" dell'ultimo upload fatto dall'utente.
     * @type DATA "d/m/y"
     */
    private $last_Upload;
    
    
    /**
     * Assegna i parametri ad un nuovo utente
     * @param string $username
     * @param string $password 
     * @param string $email
     * @param int $ruolo
     */
    public function __construct($username, $password, $email, $ruolo) {

        $this->username = $username;
        $this->password = $password;
        $this->mail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->role = $ruolo;
    }
    
    
    /*
     * @return int
     */
    public function get_upload_Count() {
        return $this->upload_Count;
    }
    
    
    /*
     * @return DATE format "d/m/y"
     */
    public function get_last_Upload() {
        return $this->last_Upload;
    }
    
    
    /*
     * Se viene fatto un upload in un giorno diverso dall'ultimo caricamento si 
     * procede al reset del contatore $upload_Count
     * @return int 0
     */
    public function reset_Upload() {
        return $this->upload_Count = 0;
    }
    
    
    /*
     * Aggiorna la data dell'ultimo_Upload al giorno attuale
     */
    public function update_Date() {
        $this->last_Upload = date("d/m/y");
    }
    
    
    
    
    
    
}
