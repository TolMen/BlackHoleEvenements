<?php

// Inclus les fichiers nécessaires
$config = require dirname(__DIR__, 3) . '/private/config/configBDD.php';

// Extraction des paramètres de connexion de la BDD
$host = $config['host'];
$dbname = $config['dbname'];
$admin = $config['admin'];
$pass = $config['pass'];

// Création d'une instance PDO, puis utilise les paramètres de configuration de la BDD, puis gère le lancement d'exception en cas d'erreur
try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $admin, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d’échec, on affiche un message ou on logue
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
