<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class defines the attributes of each user
 */
class E_User {

    private $username;
    private $password;
    private $email;

    /**
     * Roles that describe each user
     * @type int
     */
    const BANNED = 0;
    const STANDARD = 1;
    const PRO = 2;
    const MOD = 3;
    const ADMIN = 4;

    private $role = 1; //Default role for a new user is STANDARD USER

    /**
     * Daily counter of total uploaded photos
     * @type int
     */
    private $up_Count;

    /**
     * Holds the Date of the last uploaded photo in "d/m/y" format
     * @type string "d/m/y"
     */
    private $last_Upload;

    /**
     * Sets the parameters needed to instantiate a new User
     * @param string $username
     * @param string $password
     * @param string $email
     * @param int $role
     * @param int $up_Count
     * @param string $last_up
     */
    public function __construct($username, $password, $email, $role, $up_Count, $last_up) {
        $this->username = $username;
        $this->password = $password;
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->role = $role;
        $this->up_Count = $up_Count;
        $this->last_Upload = $last_up;
    }

    /**
     * Retrieves the username of the User
     * @return string
     */
    public function get_username() {
        return $this->username;
    }

    /**
     * Sets a new username for the User
     * @param string
     */
    public function set_username($new_username) {
        $this->username = $new_username;
    }

    /**
     * Retrieves the hashed password of the User
     * @return string
     */
    public function get_password() {
        return $this->password;
    }

    /**
     * Sets a new hashed password for the User
     * @param string
     */
    public function set_password($new_pass) {
        $this->password = $new_pass;
    }

    /**
     * Retrieves the email of the User
     * @return string
     */
    public function get_mail() {
        return $this->email;
    }

    /**
     * Sets a new email for the User
     * @param string
     */
    public function set_mail($new_email) {
        $this->email = filter_var($new_email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Retrieves the role of the User
     * @return int
     */
    public function get_role() {
        return $this->role;
    }

    /**
     * Sets a new role for the User
     * @param int $new_role
     */
    public function set_role($new_role) {
        $this->role = $new_role;
    }

    /**
     * Promotes the user to the next ranking role
     * @return bool
     */
    public function promote() {
        if ($this->role < self::ADMIN) {
            $this->role = $this->role + 1;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Demotes the user to the previous ranking role
     * @return bool
     */
    public function demote() {
        if ($this->role > self::BANNED) {
            $this->role = $this->role - 1;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Gets the total upload count since the last reset
     * @return int
     */
    public function get_up_Count() {
        return $this->up_Count;
    }

    /**
     * Increments the count of uploads by 1
     */
    public function add_up_Count() {
        $this->up_Count = $this->up_Count + 1;
    }

    /**
     * Resets the Upload Count
     */
    private function reset_Up_Count() {
        $this->up_Count = 0;
    }

    /**
     * Gets the last upload date
     * @return DATE format "d/m/y"
     */
    private function get_last_Upload() {
        return $this->last_Upload;
    }

    /**
     * Sets the last upload date
     */
    private function set_last_Upload() {
        $this->last_Upload = date("d-m-y");
    }

    /**
     * Checks if the date of the last upload is different from "today"'s date.
     * If it is, sets it to "today", resets the Upload count to 0.
     * Returns the Upload Count.
     * @return int
     */
    public function check_Up() {
        $last_up = $this->get_last_Upload();
        if ($last_up != date("d-m-y")) {
            $this->set_last_Upload();
            $this->reset_Up_Count();
        }
        return $this->get_up_Count();
    }

    /**
     * Checks if the user can still upload
     * @return bool
     */
    public function can_upload() {
        global $config;
        $std_max = $config['upload_limit']['Standard'];

        if ($this->role >= self::PRO) {
            return TRUE;
        } elseif ($this->role == self::STANDARD && $this->up_Count < $std_max) {
            return TRUE;
        }
        return FALSE;
    }

}
