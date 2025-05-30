<?php

// Ouvre la session
session_start();

// Détruit la session et supprime toutes les variables de session
session_unset();
session_destroy();

header("Location: ../../views/page/home.php");

// Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
exit;
