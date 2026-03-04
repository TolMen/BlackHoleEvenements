<?php
session_start();

// Protégé : admin uniquement
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: home.php');
    exit;
}

$statsFile = dirname(__DIR__, 3) . '/private/blockedStats.json';
$stats = json_decode(file_get_contents($statsFile), true);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Stats bloquées</title>
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
            <span><?= intval($stats['bots']) ?></span>
            Bots bloqués
        </div>
        <div class="stat">
            <span><?= intval($stats['spam']) ?></span>
            Messages spam bloqués
        </div>
    </div>
</body>

</html>