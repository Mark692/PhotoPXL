<?php

namespace Control;

class C_Login
{

    public function validate($input_username, $input_password)
    {
        //Da view() ottieni il risultato della generate() fatta via client
        $dati = new \View\V_Registazione();
        $dati2 = $dati->get_Dati_login();
    }


    /**
     * Generate a Nonce client side, via JavaScript.
     * The generated array contains:
     * 1 - Salt.
     * 2 - Hash of salt and pass.
     *
     * @param string $login_pass The hashed user password.
     * @param int $salt_length The length of the salt to generate for the nonce
     * The same value must be passed to the method pass_isValid().
     *
     * @return array The Nonce.
     */
    public static function generate($login_pass, $salt_length = 15)
    {
        if($salt_length<15) //If the length is less than 15
        {
            $salt_length = 15; //Sets to 15
        }
        $allowed_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max_chars = strlen($allowed_chars) - 1;
        $salt = '';
        while (strlen($salt) < $salt_length)
        {
            $salt .= $allowed_chars[rand(0, $max_chars)];
        }
        $hashed_loginPass = \Entity\E_User::hash_of($login_pass);
        $hash = hash('sha512', $salt.$hashed_loginPass);
        return $nonce = array($salt, $hash);
    }


    /**
     * Check a hashed password against the previously generated Nonce.
     *
     * @param string $db_pass The user hashed password saved in the DB.
     * @param array $nonce The array generated with generate() method.
     * @returns bool Whether the Nonce is valid.
     */
    private static function pass_isValid($db_pass, $nonce)
    {
        $salt = $nonce[0];
        $generated_nonceHash = $nonce[1];

        $DB_nonceHash = hash('sha512', $salt.$db_pass);
        if ($DB_nonceHash !== $generated_nonceHash)
        {
            return FALSE;
        }
        return TRUE;
    }



    /**
     * PSEUDO CODICE!!!
     * Controlla se l'utente $input_username ha inserito la password corretta
     *
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
        $e_user = $db_user->get_BP($input_username); //Prendi l'utente dal DB
        $user_pass = $e_user->get_Password(); //Prendi la pass dell'utente
        if (\Utilities\U_Nonce::pass_isValid($user_pass, $nonce_pass))
        {
            //Verifica OK. Logga l'utente
        }
        else
        {
            //Verifica FALLITA. Notifica l'utente di aver sbagliato username O password
        }
    }


    public function CreaUtente()
    {
        $view = new \View\View();
        $dati = $view->get_Dati();

        $username = $dati['username'];
        $password = $dati['password'];
        $email = $dati['email'];

        $e_user = new \Entity\E_User_Standard($username, $password, $email);
        \Foundation\F_User::insert($e_user);

        $view->impostaUrl();
        $VHome->display(''); //da definire il tpl
    }


    /**
     * Effettua il logout
     */
    public static function logout()
    {
        session_unset();
        session_destroy();
    }


}