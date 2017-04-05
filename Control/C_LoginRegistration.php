<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User_Standard;
use Utilities\U_Nonce;
use Utilities\Roles;
use Exceptions\input_texts;

/**
 * This class manages a user's registration, login and logout.
 *
 * @author Benedetta
 */
class C_LoginRegistration
{
    /**
     * This method is used to generate a new random nonce.
     *
     * @return string of the nonce.
     */
    public function getNonce()
    {
        return U_Nonce::generate();
    }


    /**
     * This method is used to check the username and the password that the
     * client sent when the user wants to log into the site.
     *
     * @param string $username user's name.
     * @param string $nonce
     * @param string $hash hash(nonce+hash(password)).
     * @param boolean $keepLogged if the user wants to keep the session active.
     * @return boolean if username or password are wrong.
     */
    public function login($username, $nonce, $hash, $keepLogged)
    {

        $userInfo = E_User::get_LoginInfo($username);
        if(empty($userInfo))
        {
            return false;
        }
        if(U_Nonce::pass_isValid($userInfo["password"], $nonce, $hash))
        {
            $this->createSession($keepLogged);
            $_SESSION['username'] = $username;
            \View\V_Home::standardHome();    //Per Fede
            return true;
        }
        \View\V_Login::error();
        return false;
    }


    /**
     * This method is used to save user's username, email and password when he
     * signs up to the site.
     *
     * @param string $username user's name.
     * @param string $email user's email.
     * @param string $password user's password.
     * @param boolean $keepLogged if the user wants to keep the session active.
     * @return boolean if unaccepted characters are used.
     */
    public function register($username, $email, $password, $keepLogged)
    {

        if(E_User::is_Available($username) === FALSE)
        {
            return false;
        }
        try
        {
            $STD_user = new E_User_Standard($username, $password, $email);
            E_User_Standard::insert($STD_user);
            $this->createSession($keepLogged);
            $_SESSION['username'] = $username;
            \View\V_Home::standardHome(); //Per Fede
            return true;
        }
        catch(input_texts $e)
        {
            \View\V_Registration::error();   //Per Fede
            return false;
        }
    }


    /**
     * This method is used to logout the user to the site.
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }


    /**
     * This method is used to start a new session.
     *
     * @param boolean $keepLogged if the user wants to keep the session active.
     */
    private function createSession($keepLogged)
    {
        if($keepLogged)
        {
            session_set_cookie_params(PHP_INT_MAX);
        }
        else
        {
            session_set_cookie_params(0);
        }
        session_start();
        header("Location: index.php");
    }

    public function forgottenPassword($username){
         $userInfo = E_User::get_LoginInfo($username);
         if(empty($userInfo))
        {
            return false;
        }
        return E_User::generate_Token($username);
    }
    
    public function resetPassword($username, $userToken, $keepLogged, $newPassword){
        if(!E_User::check_Token($username, $userToken)){
            \View\V_Login::error();       // Per Fede
            return false;
        }
        $this->createSession($keepLogged);
        $_SESSION['username'] = $username;
        if(!C_Profile::changePassword($newPassword)){
            \View\V_Login::error();
            $this->logout();
            return false;
        }
        \View\V_Home::standardHome();
        return true;
    }

}