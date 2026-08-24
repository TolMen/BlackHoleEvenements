<?php

/**
 * Connexion à la base de données.
 *
 * L'instance PDO est créée une seule fois par requête puis réutilisée :
 * plus besoin d'ouvrir une connexion par modèle inclus.
 */

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $configFile = dirname(__DIR__) . '/private/config/configBDD.php';

    if (!is_file($configFile)) {
        error_log('[BDD] Fichier de configuration introuvable : ' . $configFile);
        throw new RuntimeException(db_error_message(
            'Configuration de la base de données absente.',
            'créez le fichier private/config/configBDD.php (voir le README)'
        ));
    }

    $config = require $configFile;

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['dbname']
    );

    try {
        $pdo = new PDO($dsn, $config['admin'], $config['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        // Le détail part dans les logs, jamais à l'écran du visiteur en ligne.
        error_log('[BDD] Connexion impossible : ' . $e->getMessage());
        throw new RuntimeException(db_error_message(
            'Connexion à la base de données impossible.',
            $e->getMessage()
        ));
    }

    return $pdo;
}

/**
 * Message d'erreur de base de données.
 *
 * En développement, la cause précise est ajoutée pour pouvoir corriger tout
 * de suite (base absente, identifiants erronés…). En production, seul le
 * message générique sort : le détail reste dans les journaux du serveur.
 */
function db_error_message(string $message, string $detail): string
{
    if (defined('APP_ENV') && APP_ENV === 'development' && $detail !== '') {
        return $message . ' ' . $detail;
    }

    return $message;
}
