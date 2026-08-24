<?php

/**
 * Page 500 : erreur technique.
 *
 * Le détail de l'erreur part dans les logs du serveur, jamais à l'écran.
 */

$pageTitle  = 'Erreur technique';
$pageRobots = 'noindex, nofollow';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>

    <style>
        .error-page {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 70vh;
            text-align: center;
            padding: 120px 20px 60px;
        }

        .error-page h1 {
            font-size: 72px;
            color: var(--color-site-item);
            margin-bottom: 10px;
        }

        .error-page p {
            font-size: 18px;
            color: var(--color-text);
        }

        .error-page a {
            margin-top: 25px;
            color: var(--color-text);
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main class="error-page">
        <h1>500</h1>
        <p>Une erreur technique est survenue. Nos équipes en sont informées.</p>
        <a href="<?= url('/') ?>">Retour à l'accueil</a>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

</body>

</html>
