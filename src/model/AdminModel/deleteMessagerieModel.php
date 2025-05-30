<?php

$messageID = $_GET["id"];

session_start();

include_once '../../control/BDDControl/connectBDD.php';

$query = $bdd->prepare("DELETE FROM contact WHERE id = ?");
$query->execute(array($messageID));

header("Location: ../../views/page/dashboard.php?type=messagerie");

// Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
exit;
