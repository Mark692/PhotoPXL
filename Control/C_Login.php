<?php

namespace Control;

class C_Login
{

    /**
     * Controlla se l'utente $input_username ha inserito la password corretta.
     *
     * @return tpl A template for the result
     */
    public function check_user_pass()
    {
        //Da view() ottieni il risultato della generate() fatta via client
        $dati = new \View\V_Login();
        $array_dati = $dati->get_Dati(); //ottieni il risultato della generate()

        $arr_values = array("username" => $array_dati["username"]);
        $array_user = \Foundation\F_User::get($arr_values);
        $DB_pass = $array_user["password"];

        if($this->pass_isValid($DB_pass, $array_dati["nonce"]))
        {
            //login OK!
            return TRUE; //TEMPLATE?
        }
        return FALSE; //TEMPLATE?
    }


    /**
     * Generate a Nonce client side, via JavaScript.
     * The generated array contains:
     * 1 - Salt.
     * 2 - Hash of salt and pass.
     *
     * @param string $login_pass The user password.
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
        $hashed_loginPass = \Entity\E_User::hash_of($login_pass); //Generates the hash of the password
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


//----SISTEMA QUESTA FUNZIONE!!!!----\\
    public function CreaUtente()
    {
        $view = new \View\V_Registazione();
        $dati = $view->get_Dati();

        $username = $dati['username'];
        $password = $dati['password'];
        $email = $dati['email'];

        $e_user = new \Entity\E_User_Standard($username, $password, $email);
        \Foundation\F_User::insert($e_user);

        //RITORNA IL TEMPLATE
    }


    /**
     * Logs out the user
     */
    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}