<?php

// Détruit la session et supprime toutes les variables de session
session_unset();
session_destroy();

header("Location: " . url("/"));

// Fin du script après redirection volontaire pour éviter toute exécution supplémentaire
exit;
