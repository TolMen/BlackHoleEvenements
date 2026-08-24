<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/ActualiteModel/deleteArtModel.php';

// L'identifiant vient de la route /admin/actualites/{id}/supprimer.
$articleID = isset($articleID) ? (int) $articleID : intval($_GET["articleID"] ?? 0);

if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin") {
    $deleteArtProcess = new DeleteArtModel();
    $deleteArtProcess->deleteArticleWithImage($bdd, $articleID);
}

header("Location: " . url('/actualites'));

// Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
exit;
