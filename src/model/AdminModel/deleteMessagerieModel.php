<?php

/**
 * Suppression d'un message de la messagerie.
 *
 * L'identifiant vient de la route /admin/messagerie/{id}/supprimer ;
 * l'accès administrateur est vérifié par AdminController.
 */

$messageID = isset($messageID) ? (int) $messageID : (int) ($_GET["id"] ?? 0);

include_once __DIR__ . '/../../control/BDDControl/connectBDD.php';

$query = $bdd->prepare("DELETE FROM contact WHERE id = ?");
$query->execute([$messageID]);

header("Location: " . url("/admin/messagerie"));

// Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
exit;
