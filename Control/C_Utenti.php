<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Utenti {

    /*
     * Ogni funzionalità ha una sua costante.
     * Limitazione: 32 funzioni massime ammesse
     *
    const BAN = 0x1;                // 0000 0001
    const UPLOAD_LIMITATO = 0x2;    // 0000 0010
    const MODERAZIONE = 0x4;        // 0000 0100
    const CAMBIA_RUOLI = 0x8;       // 0000 1000
    //const nuova_costante = 0x10;  // 0001 0000
     * 
     */
    
    /*  
     * Lista di funzionalità abilitate per questo utente, espresse come bit settati in un intero 
     * Esempio: 0000 1100 ha i privilegi Mod, Upload Non Limitato
     */
    private $u_flags;
    
    /* Dati generici che si possono estrarre dal DB */
    private $username;
    private $mail;
    private $limite_upload;
    
    /* Classi che implementano varie funzionalità, per gli utenti che non possono usarle resteranno null */
    private $fun_upload;
    private $fun_cambia_ruoli;
    private $fun_modera;
    
    /*
     * Il costruttore si occupa di verificare, dato un utente, quale ruolo gli spetta
     * ed assegnargli le rispettive funzioni
     * @param \Foundation\F_Utenti
     */
    public function __construct(\Foundation\F_User $username) {
        
        $this->username = $username;
        $this->u_flags = $this->username->getRuolo();
        
        $this->fun_modera = new \Control\C_Upload();
        
        //Aggiungi funzionalità per l'utente
        $this->assegna_funzioni();
    }
    
    
    /*
     * Questo metodo si occupa di leggere i bit della $this->u_flags ed impostare
     * le dovute funzioni all'utente 
     */
    private function assegna_funzioni() {
        $ruolo = new \Control\E_Role($this->u_flags);
        
        if ( $ruolo->is_on( SELF::UPLOAD_LIMITATO ) ) { 
            echo $this->limite_upload = 10;
        }
        elseif ( $ruolo->is_on( SELF::BAN ) ) {
            echo $this->limite_upload = 0;
        }
        else {
            echo $this->limite_upload = -1; //Upload illimitato
        }
        
        if ( $ruolo->is_on( SELF::MODERAZIONE ) ) { 
            $this->fun_modera = new \Control\Moderazioni( /* parametri vari*/ );
        }
        
        if ( $ruolo->is_on( SELF::CAMBIA_RUOLI ) ) {
            $this->fun_cambia_ruoli = new \Control\Cambia_Ruoli( /* parametri vari*/ ) ;
        }
    }
}

/*
    Esempio per la creazione di un moderatore:
    
    $user = new \Control\User("Havel", \Control\User.unlimited_upload | \Control\User.ban_users) // bitwise-OR usato per unire insieme più flags
    
    In realtà le flags di ogni utente dovresti salvartele nel DB e caricarle quando serve invece
    di inserirle a mano come ho fatto qui ora
*/
