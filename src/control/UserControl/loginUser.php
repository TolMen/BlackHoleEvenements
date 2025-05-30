<?php

// Ouvre la session
session_start();

// Inclus les fichiers nécessaires
include_once '../../model/UserModel/loginUserModel.php';

$username = htmlspecialchars($_POST["username"], ENT_QUOTES);
$password = htmlspecialchars($_POST["password"], ENT_QUOTES);

$authUser = new authUserModel();
$user = $authUser->getUserInfo($bdd, $username, $password);

if (!empty($user)) {
    $_SESSION["userID"] = $user["id"];
    $_SESSION["userRole"] = $user["role"];
    if ($user["role"] == "admin") {
        header("Location: ../../views/page/dashboard.php");
    } else {
        header("Location: ../../views/page/home.php");
    }
    exit;
} else {
    header("Location: ../../views/page/login.php?infoFalse=true");
    exit;
}
