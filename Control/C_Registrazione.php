<?php

namespace Control;

class C_Login_Processor {
    
    private $username;
    private $password;
    private $email;
    private $ruolo;

    
    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param string $ruolo
     */
    public function __construct($username, $password, $email, $ruolo) {
        
        $this->username = $username;
        $this->password = $this->crit_Pass($password);
        $this->email = $email;
        $this->ruolo = $ruolo;
    }
    
    
    /*
     * Permette di calcolare il valore finale della $password utente 
     * per poi andarlo ad usare per il record Utente nel DB
     * @return string
     */
    private function crit_Pass() {
        
        return $password = hash("sha256", $_POST["password"] . crypt($_POST["username"], $_POST["password"]) );
    }
    
    
    /**
     * Funzione per registrare un nuovo utente
     */
    public function salva() {
        
        $ruoloStandard = 0x2;
        $f_utente = new \Foundation\F_Utente($this->username);
        $obj_utente = new \Entity\E_Utente($this->username, $this->password, $this->email, $ruoloStandard);
        $f_utente->set($obj_utente);
    }

    
    /**
     * Metodo per effettuare il logout
     */
    public static function logout() {
        session_unset();
        session_destroy();
    }

}