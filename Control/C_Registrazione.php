<?php

namespace Control;

class C_Login_Processor
{

    /**
     * PSEUDO CODICE!!!
     * Controlla se l'utente $input_username ha inserito la password corretta
     * @param string $input_username The user username
     * @param array $nonce_pass The nonce array generated client side
     */
    public function check_user_pass($input_username, $nonce_pass)
    {
        //PSEUDO CODICE!!! - IMPLEMENTA DECENTEMENTE STA ROBBA

        /*
         * Nota per generare il $nonce_pass:
         * C'è bisogno che l'utente utilizzi la funzione
         * \Utilities\U_Nonce::generate($input_password, $salt_length)
         * per generare l'array $nonce_pass.
         * Una volta ottenuto tale array, bisogna passarlo come parametro a
         * questa funzione per controllare la correttezza dell'input e quindi
         * verificare o meno il login.
         */

        $db_user = new \Foundation\F_User(); //Istanzia un oggetto Foundation
        $e_user = $db_user->get_record($input_username); //Prendi l'utente dal DB
        $user_pass = $e_user->get_password(); //Prendi la pass dell'utente
        if(\Utilities\U_Nonce::check($user_pass, $nonce_pass))
        {
            //Verifica OK. Logga l'utente
        }
        else
        {
            //Verifica FALLITA. Notifica l'utente di aver sbagliato username O password
        }
    }








    /**
     * Effettua il logout
     */
    public static function logout() {
        session_unset();
        session_destroy();
    }

}