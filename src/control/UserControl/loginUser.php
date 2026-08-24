<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/UserModel/loginUserModel.php';

$username = htmlspecialchars($_POST["username"], ENT_QUOTES);
$password = htmlspecialchars($_POST["password"], ENT_QUOTES);

$authUser = new authUserModel();
$user = $authUser->getUserInfo($bdd, $username, $password);

if (!empty($user)) {
    $_SESSION["userID"] = $user["id"];
    $_SESSION["userRole"] = $user["role"];
    if ($user["role"] == "admin") {
        header("Location: " . url("/admin"));
    } else {
        header("Location: " . url("/"));
    }

    // Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
    exit;
} else {
    header("Location: " . url("/connexion?erreur=1"));

    // Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
    exit;
}
