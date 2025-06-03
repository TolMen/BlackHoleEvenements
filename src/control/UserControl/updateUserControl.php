<?php

session_start();

include_once '../../model/UserModel/userInfoModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION["userID"];

    $newUsername = !empty($_POST['login']) ? trim($_POST['login']) : null;
    $newPassword = !empty($_POST['password']) ? $_POST['password'] : null;
    $confirmPassword = !empty($_POST['password_confirm']) ? $_POST['password_confirm'] : null;

    // Vérifie si les deux mots de passe correspondent
    if ($newPassword && $newPassword !== $confirmPassword) {
        $_SESSION['update_error'] = "Les mots de passe ne correspondent pas.";
        header('Location: ../../views/page/dashboard.php');
        exit;
    }

    $userModel = new UserModel();
    $success = $userModel->updateCredentials($bdd, $userId, $newUsername, $newPassword);

    if ($success) {
        $_SESSION['update_success'] = "Informations mises à jour avec succès.";
    } else {
        $_SESSION['update_error'] = "Aucune modification apportée.";
    }

    header('Location: ../../views/page/dashboard.php');
    exit;
}
