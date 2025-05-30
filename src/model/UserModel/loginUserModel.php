<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class AuthUserModel
{

    public function getUserInfo(PDO $bdd, $username, $password)
    {
        $state = $bdd->prepare("SELECT id, username, role FROM users WHERE username = ? AND password = SHA2(?, 256)");
        $state->execute(array($username, $password));
        return $state->fetch();
    }
}
