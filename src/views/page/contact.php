<?php

/**
 * Page de contact (/contact).
 */

$pageTitle       = 'Contact et demande de devis';
$pageDescription = 'Un projet d\'événement ? Contactez Black Hole Évènements pour un devis '
    . 'gratuit : éclairage, sonorisation, vidéo et effets spéciaux à Riom, Clermont-Ferrand '
    . 'et partout en France.';
$pageCanonical   = absolute_url('/contact');
$pageStyles      = ['css/styleContact/styleFormContact.css', 'css/stylePopUp/stylePopUp.css'];

$pageJsonLd = jsonld_script([
    jsonld_organization(),
    jsonld_breadcrumb(['Accueil' => '/', 'Contact' => '/contact']),
    [
        '@type'      => 'ContactPage',
        '@id'        => absolute_url('/contact') . '#contact',
        'name'       => 'Contacter Black Hole Évènements',
        'mainEntity' => ['@id' => APP_URL . '/#organization'],
    ],
]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main>
        <?php include PAGES_PATH . '/sectionContact/sectionFormContact.php'; ?>
    </main>

    <!-- Popup de confirmation -->
    <?php if (isset($_SESSION['contact_success']) && $_SESSION['contact_success'] === true) { ?>
        <div id="popup" class="popup show">
            <div class="popup-content">
                <p>Merci <?= e($_SESSION['contact_name'] ?? '') ?> !<br> Votre message a bien été envoyé.</p>
                <button id="closePopup">Fermer</button>
            </div>
        </div>
        <?php
        // Supprime les variables de session après affichage
        unset($_SESSION['contact_success'], $_SESSION['contact_name']);
        ?>
    <?php } ?>

    <!-- Popup d'erreur -->
    <?php if (isset($_SESSION['contact_error'])) { ?>
        <div id="popup" class="popup show">
            <div class="popup-content">
                <p style="color: #dc3545;"><?= e($_SESSION['contact_error']) ?></p>
                <button id="closePopup">Fermer</button>
            </div>
        </div>
        <?php unset($_SESSION['contact_error']); ?>
    <?php } ?>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="<?= asset('js/popupScript.js') ?>"></script>

</body>

</html>
