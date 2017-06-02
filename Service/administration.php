<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Control\C_Administration;

$username = filter_input(INPUT_POST, "username");
$action = filter_input(INPUT_POST, "action");
switch ($action) {
    case "changeRole": $role = filter_input(INPUT_POST, "role");
        $returns = C_Administration::changeRole($username, $role);
        break;
    case "ban": $returns = C_Administration::ban($username);
        break;
    default : $return = false;
}

echo json_encode($returns);
