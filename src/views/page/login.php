<?php

/**
 * Connexion à l'espace d'administration (/connexion).
 *
 * Page volontairement exclue de l'indexation.
 */

$pageTitle  = 'Connexion';
$pageRobots = 'noindex, nofollow';
$pageStyles = ['css/styleAccount/styleLoginForm.css', 'css/stylePopUp/stylePopUp.css'];

$erreurConnexion = isset($_GET['erreur']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main class="main-container">
        <div class="box">
            <span class="borderLine"></span>
            <form method="POST" action="<?= url('/connexion') ?>">
                <h1>Connexion</h1>
                <div class="inputBox inputBoxOther">
                    <input type="text" name="username" maxlength="26" pattern="[a-zA-Z0-9._]{3,26}"
                        title="Seules les lettres, chiffres, '.' et '_' sont autorisés (entre 3 et 26 caractères)"
                        autocomplete="username" required>
                    <span>Identifiant</span>
                    <i></i>
                </div>
                <div class="inputBox inputBoxOther">
                    <input type="password" name="password" pattern="[A-Za-zÀ-ÿ0-9.]+" maxlength="15"
                        title="Le mot de passe doit contenir des lettres, des chiffres et uniquement le symbole POINT"
                        autocomplete="current-password" required>
                    <span>Mot de passe</span>
                    <i></i>
                </div>
                <input type="submit" name="connexion" value="Se connecter">
            </form>
        </div>
    </main>

    <!-- Popup d'erreur -->
    <?php if ($erreurConnexion) { ?>
        <div id="popup" class="popup show">
            <div class="popup-content">
                <p class="popup-para">Identifiant ou mot de passe incorrect.</p>
                <a href="<?= url('/connexion') ?>" id="closePopup">Fermer</a>
            </div>
        </div>
    <?php } ?>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
