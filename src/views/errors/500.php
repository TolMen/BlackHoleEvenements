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

        .error-details {
            margin-top: 25px;
            max-width: 900px;
            padding: 15px 20px;
            border-radius: 8px;
            background: rgba(220, 53, 69, 0.08);
            border: 1px solid rgba(220, 53, 69, 0.35);
            text-align: left;
        }

        .error-details .error-message {
            font-weight: bold;
            color: #dc3545;
            word-break: break-word;
        }

        .error-details .error-origin {
            font-size: 14px;
            opacity: 0.8;
            word-break: break-all;
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

        <?php if (APP_ENV === 'development' && isset($erreur) && $erreur instanceof Throwable) { ?>
            <!-- Détail affiché uniquement en développement (localhost). -->
            <div class="error-details">
                <p class="error-message"><?= e($erreur->getMessage()) ?></p>
                <p class="error-origin">
                    <?= e($erreur->getFile()) ?> — ligne <?= (int) $erreur->getLine() ?>
                </p>
            </div>
        <?php } ?>

        <a href="<?= url('/') ?>">Retour à l'accueil</a>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

</body>

</html>
