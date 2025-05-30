<?php

// Ouvre la session
session_start();

// Inclus les fichiers nécessaires
include_once '../../model/ContactModel/getContactSuccess.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['website'])) {
        header('Location: ../../views/page/contact.php');
        exit;
    }

    $name = htmlspecialchars($_POST["name"], ENT_QUOTES);
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
    $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES);
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES);

    $getInsertinto = new getContactSuccess();
    $getInsertinto->getInsert($bdd, $name, $email, $subject, $message);

    $getInformation = new getContactSuccess();
    $resultatsforms = $getInformation->getInfo($bdd, $name, $email, $subject, $message);

    $_SESSION['contact_success'] = true;
    $_SESSION['contact_name'] = $resultatsforms["name"];

    header('Location: ../../views/page/contact.php');
    exit;
}
