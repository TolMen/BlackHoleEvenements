<?php

/**
 * Page 404 : adresse inconnue.
 *
 * Elle renvoie bien un code HTTP 404 (défini par le routeur) et se déclare
 * en noindex : une page d'erreur ne doit jamais entrer dans l'index Google.
 */

$pageTitle  = 'Page introuvable';
$pageRobots = 'noindex, follow';
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

        .error-page .links {
            margin-top: 25px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .error-page a {
            color: var(--color-text);
            text-decoration: none;
            font-weight: bold;
        }

        .error-page a:hover {
            color: var(--color-text-hover);
        }
    </style>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main class="error-page">
        <h1>404</h1>
        <p>Oups… cette page n'existe pas ou a été déplacée.</p>
        <div class="links">
            <a href="<?= url('/') ?>">Retour à l'accueil</a>
            <a href="<?= url('/services') ?>">Nos prestations</a>
            <a href="<?= url('/inspiration') ?>">Inspiration</a>
            <a href="<?= url('/contact') ?>">Nous contacter</a>
        </div>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

</body>

</html>
