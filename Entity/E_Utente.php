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
    private $up_Count;
    
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
    public function __construct($username, $password, $email, $ruolo, $up_C, $last_up) {

        $this->username = $username;
        $this->password = $password;
        $this->mail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->role = $ruolo;
        $this->up_Count = $up_C;
        $this->last_Upload = $last_up;
    }
    
    
    /*
     * Prende il totale di upload fatti dall'ultimo reset 
     * @return int
     */
    public function get_up_Count() {
        return $this->up_Count;
    }
    
    
    /*
     * Incrementa il numero di upload fatti di 1
     * @return int
     */
    public function add_up_Count() {
        $this->up_Count = $this->up_Count +1;
        return $this->up_Count;
    }
    
    /*
     * Se viene fatto un upload in un giorno diverso dall'ultimo caricamento si 
     * procede al reset del contatore $upload_Count
     */
    public function reset_Up_Count() {
        $this->up_Count = 0;
    }
    
    
    /*
     * @return DATE format "d/m/y"
     */
    public function get_last_Upload() {
        return $this->last_Upload;
    }
    
    
    /*
     * Modifica la data dell'ultimo_Upload con il giorno attuale.
     * Ritorna TRUE se il giorno è cambiato, FALSE altrimenti
     * @return bool 
     */
    public function mod_last_Up() {
        
        if($this->last_Upload!=date("d/m/y")) {
            $this->last_Upload = date("d/m/y");
            return TRUE;
        }
        return FALSE;
    }
    
    
}
