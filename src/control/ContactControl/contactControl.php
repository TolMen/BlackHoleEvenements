<?php
session_start();

include_once '../../model/ContactModel/getContactSuccess.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 🕷️ Honeypot : si le champ est rempli, c'est sûrement un robot
    if (!empty($_POST['website'])) {
        // On arrête tout discrètement
        header('Location: ../../views/page/contact.php');
        exit;
    }

    // ✅ Récupération et sécurisation des données
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES);
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
    $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES);
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES);

    // ✅ Instanciation du modèle
    $getInsertinto = new getContactSuccess();
    $getInsertinto->getInsert($bdd, $name, $email, $subject, $message);

    // ✅ Récupération des informations pour confirmation
    $getInformation = new getContactSuccess();
    $resultatsforms = $getInformation->getInfo($bdd, $name, $email, $subject, $message);

    // ✅ Redirection avec confirmation
    $_SESSION['contact_success'] = true;
    $_SESSION['contact_name'] = $resultatsforms["name"];

    header('Location: ../../views/page/contact.php');
    exit;
}
