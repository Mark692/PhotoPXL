<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

use Entity\E_User;
use Entity\E_User_Standard;
use Utilities\U_Nonce;
use Exceptions\input_texts;
use View\V_Home;
use View\V_Login;
use View\V_Registration;

/**
 * This class manages a user's registration, login and logout.
 *
 * @author Benedetta
 */
class C_LoginRegistration {

    /**
     * This method is used to generate a new random nonce.
     *
     * @return string of the nonce.
     */
    public static function getNonce() {
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
    public static function login($username, $password, $keepLogged) {
        $userInfo = E_User::get_LoginInfo($username);
        if (empty($userInfo)) {
            return false;
        }
        if ($userInfo["password"] == hash('sha512', $password)) {
            self::createSession($keepLogged);
            $_SESSION['username'] = $username;
            E_User::nullify_Token($username);
            return true;
        }
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
    public static function register($username, $email, $password, $keepLogged) {

        if (!self::isAvailable($username)) {
            return false;
        }
        try {
            $STD_user = new E_User_Standard($username, $password, $email);
            E_User_Standard::insert($STD_user);
            self::createSession($keepLogged);
            $_SESSION['username'] = $username;
            header("Location: index.php");
            return true;
        } catch (input_texts $e) {
            V_Registration::error_registration(); 
            return false;
        }
    }

    /**
     * This method is used to logout the user to the site.
     */
    public static function logout() {
        $_SESSION = [];
        session_destroy();
        return true;
    }

    /**
     * This method is used to start a new session.
     *
     * @param boolean $keepLogged if the user wants to keep the session active.
     */
    private static function createSession($keepLogged) {
        if ($keepLogged) {
            session_set_cookie_params(PHP_INT_MAX);
        } else {
            session_set_cookie_params(0);
        }
        session_start();
    }

    /**
     * This method is used when a user forget his password and wants to generate a new one.
     *
     * @param string $username the user's name
     * @return boolean true if the token was generated.
     */
    public static function getToken($username) {
        $userInfo = E_User::get_LoginInfo($username);
        if (empty($userInfo)) {
            return false;
        }
        return E_User::generate_Token($username);
    }

    /**
     * This method is used when a user tries to log with a previously generated token.
     * If the login happens, the user has to set up a new password.
     *
     * @param string $username the user's name
     * @param string $userToken the user's token
     * @param boolean $keepLogged true if the user wants to keep the session active.
     * @param string $newPassword the new password to set up
     * @return boolean true if the password was successfully resetted.
     */
    public static function resetPassword($username, $userToken, $keepLogged, $newPassword) {
        if (!E_User::check_Token($username, $userToken)) {
            return false;
        }
        self::createSession($keepLogged);
        $_SESSION['username'] = $username;
        if (!C_Profile::changePassword($newPassword)) {
            self::logout();
            return false;
        }
        E_User::nullify_Token($username);
        return true;
    }

    public static function showHome($failed) {
        self::createSession(true);
        if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
            $role = E_User::get_DB_Role($_SESSION["username"]);
            if ($role != \Utilities\Roles::BANNED) {
                V_Home::standardHome(\Entity\E_Photo::get_MostLiked($_SESSION["username"], $role), $_SESSION["username"]);
            } else {
                V_Home::bannedHome();
            }
        } else {
            V_Home::login($failed);
        }
    }
    
    public static function showRegistration($failed) {
        if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
            header("Location: index.php");
            return;
        }
        V_Home::registration($failed);
    }

    /**
     * check if a username is already taken.
     *
     * @param string $username
     * @return boolean true if the username is available.
     */
    public static function isAvailable($username){
        return E_User::is_Available($username);
    }
    
    public static function getUsername(){
        return $_SESSION['username'];
    }
    
    public static function getRole() {
        return E_User::get_DB_Role($_SESSION['username']);
    }

}
