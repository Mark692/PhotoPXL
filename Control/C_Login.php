<?php

namespace Control;

class C_Login
{
    /**
     * 
     * ritorna il tpl relativo al login
     * @return tpl
     */
    public function modulo_login()
    {
        $V_Login = new \View\V_Login;
        return $V_Login->fetch('login.tpl');
    }


    /**
     * Controlla se l'utente $input_username ha inserito la password corretta.
     *
     * @return tpl A template for the result
     */
    public function check_user_pass()
    {
        //Da view() ottieni il risultato della generate() fatta via client
        $C_Home = new \Control\C_Home();
        $v_Login = new \View\V_Login();
        $array_dati = $v_Login->get_Dati(); //ottieni il risultato della generate()
        $login_info = \Foundation\F_User::get_LoginInfo($array_dati['username']);
        if(count($login_info) !== 0)
        {
            if($login_info['role'] != \Utilities\Roles::BANNED)
            {
                $DB_pass = $login_info["password"];
                if($this->pass_isValid($DB_pass, $array_dati["nonce"]))
                {
                    $session = new \Utilities\U_Session();
                    $session->set_Valore('username', $login_info['username']);
                    $session->set_Valore('role', $login_info['role']);
                    return $C_Home->Set_page(); //ritorna la home da loggato ovviamente
                }
                else
                {
                    $v_Login->assign('messaggio password', 'Password Sbagliata');
                    return$this->modulo_login();
                }
            }
            else
            {
                $v_Login->assign('messaggio', 'Sei stato bannato, non puoi effettuare l'.'accesso');
                return $this->modulo_login();
            }
            $v_Login->assign('messaggio', 'Username Sbagliato ');
            return $this->modulo_login();
        }
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
        if($salt_length < 15) //If the length is less than 15
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
        return $nonce = array ($salt, $hash);
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
        if($DB_nonceHash !== $generated_nonceHash)
        {
            return FALSE;
        }
        return TRUE;
    }


    /**
     * Logs out the user
     */
    public static function logout()
    {
        session_unset();
        session_destroy();
    }


    public function smista()
    {
        $V_Login = new \View\V_Login();
        switch ($V_Login->getTask())
        {

            case 'login':
                return $this->check_user_pass();
            case 'logout':
                return $this->logout();
            case 'modulo_login':
                return $this->modulo_login();
               
        }
    }
}

    