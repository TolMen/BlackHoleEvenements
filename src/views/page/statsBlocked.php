<?php

/**
 * Compteur des visites bloquées (/admin/statistiques-bloquees).
 *
 * L'accès administrateur est vérifié par AdminController.
 */

$statsFile = PRIVATE_PATH . '/blockedStats.json';
$stats = is_file($statsFile) ? json_decode((string) file_get_contents($statsFile), true) : [];
$stats = is_array($stats) ? $stats : [];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Statistiques bloquées | Black Hole Évènements</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f5f5f5;
        }

        .box {
            background: white;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 1.4rem;
            color: #333;
        }

        .stat {
            margin: 15px 0;
            font-size: 1.1rem;
            color: #555;
        }

        .stat span {
            font-size: 2rem;
            font-weight: bold;
            color: #c0392b;
            display: block;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Statistiques de blocage</h1>
        <div class="stat">
            <span><?= (int) ($stats['bots'] ?? 0) ?></span>
            Bots bloqués
        </div>
        <div class="stat">
            <span><?= (int) ($stats['spam'] ?? 0) ?></span>
            Messages spam bloqués
        </div>
    </div>
</body>

</html>