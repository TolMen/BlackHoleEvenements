<?php

// Ouvre la session
session_start();

// Inclus les fichiers nécessaires
include_once 'src/control/BDDControl/connectBDD.php';

// Vérifie les paramètres après "?" dans l'URL, si vide redirection vers la page d'accueil
if (empty($_SERVER['QUERY_STRING'])) {
    header("Location: src/views/page/home.php");
    throw new Exception("Redirection vers la page d'accueil.");
}
