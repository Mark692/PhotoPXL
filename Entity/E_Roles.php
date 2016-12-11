<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Roles
{  //CAN DELETE THIS CLASS: IMPLEMENTED IN E_USER ALREADY!!

    /**
     * Roles array that describes each user
     *
     * BANNED ----- 0
     * STANDARD --- 1
     * PRO -------- 2
     * MOD -------- 3
     * ADMIN ------ 4
    */
    private $role;


    /**
     * Instantiate a new role
     * @param int $role
     */
    public function __construct(int $role) {
        $this->role = $role;
    }


    /**
     * Changes the previous instantiated user role
     * @param int $new_role
     */
    public function set($new_role) {
        $this->role = $new_role;
    }


    /**
     * Retrives the role of the user
     * @return int
     */
    public function get() {
        return $this->role;
    }


    //--------------------NOT--REALLY--USED--METHODS--------------------//

    /**
     * Promotes the user to the next ranking role
     */
    public function promote() {
        $this->role = $this->role +1;
    }


    /**
     * Demotes the user to the previous ranking role
     */
    public function demote() {
        $this->role = $this->role -1;
    }


}