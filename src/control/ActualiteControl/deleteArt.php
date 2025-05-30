<?php

// Ouvre la session
session_start();

// Inclus les fichiers nécessaires
include_once '../../model/ActualiteModel/deleteArtModel.php';

$articleID = intval($_GET["articleID"]);

if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin") {
    $deleteArtProcess = new DeleteArtModel();
    $deleteArtProcess->deleteArticleWithImage($bdd, $articleID);
}

if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: ../../views/page/home.php");
}
exit;
