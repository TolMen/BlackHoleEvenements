<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class AuthUserModel
{

    public function getUserInfo(PDO $bdd, $username, $password)
    {
        $hashedPassword = hash('sha256', $password);

        $state = $bdd->prepare("SELECT id, username, role FROM users WHERE username = ? AND password = ?");
        $state->execute([$username, $hashedPassword]);

        return $state->fetch();
    }
}
