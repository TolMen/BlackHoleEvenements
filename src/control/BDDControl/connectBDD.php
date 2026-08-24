<?php

/**
 * Point d'entrée historique de la connexion BDD.
 *
 * Conservé pour que les modèles et contrôles existants continuent de
 * disposer de la variable $bdd ; la connexion elle-même vit désormais
 * dans config/database.php (instance unique par requête).
 */

require_once dirname(__DIR__, 3) . '/config/database.php';

$bdd = db();
