<?php

/**
 * Barre de navigation.
 *
 * L'onglet actif est déduit du chemin courant (URL propre) et non plus du
 * nom du fichier PHP appelé.
 */

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if (BASE_PATH !== '' && str_starts_with($currentPath, BASE_PATH)) {
    $currentPath = substr($currentPath, strlen(BASE_PATH));
}

$currentPath = '/' . trim($currentPath, '/');

/** Classe « active » si le chemin courant correspond à la rubrique. */
$isActive = static function (string $path) use ($currentPath): string {
    if ($path === '/') {
        return $currentPath === '/' ? 'active' : '';
    }
    return str_starts_with($currentPath, $path) ? 'active' : '';
};

$isAdmin = isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin';
?>

<nav class="navbar navbar-expand-md fixed-top customNavbar">
    <div class="container-fluid">
        <a href="<?= url('/') ?>" class="navbar-brand">
            <img src="<?= asset('assets/logo.png') ?>" alt="Logo Black Hole Évènements" width="120" height="40">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Ouvrir la navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">

                <?php if ($isAdmin) { ?>
                    <li class="nav-item dropdown">
                        <a class="custom-nav-link dropdown-toggle" href="#" id="navbarAdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Navigation administrateur
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarAdminDropdown">
                            <li><a class="dropdown-item" href="<?= url('/admin') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= url('/admin/messagerie') ?>">Messagerie</a></li>
                            <li><a class="dropdown-item" href="<?= url('/admin/galerie') ?>">Galerie</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= url('/admin/changelog') ?>">Journal des modifications</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="custom-nav-link dropdown-toggle" href="#" id="navbarPublicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Navigation publique
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarPublicDropdown">
                            <li><a class="dropdown-item" href="<?= url('/') ?>">Accueil</a></li>
                            <li><a class="dropdown-item" href="<?= url('/services') ?>">Service</a></li>
                            <li><a class="dropdown-item" href="<?= url('/inspiration') ?>">Inspiration</a></li>
                            <li><a class="dropdown-item" href="<?= url('/actualites') ?>">Actualités</a></li>
                            <li><a class="dropdown-item" href="<?= url('/faq') ?>">FAQ</a></li>
                            <li><a class="dropdown-item" href="<?= url('/mentions-legales') ?>">Mentions légales</a></li>
                            <li><a class="dropdown-item" href="<?= url('/politique-de-confidentialite') ?>">Politique de confidentialité</a></li>
                            <li><a class="dropdown-item" href="<?= url('/contact') ?>">Contactez-nous</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="custom-nav-link <?= $isActive('/') ?>" href="<?= url('/') ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="custom-nav-link <?= $isActive('/services') ?>" href="<?= url('/services') ?>">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="custom-nav-link <?= $isActive('/inspiration') ?>" href="<?= url('/inspiration') ?>">Inspiration</a>
                    </li>
                    <li class="nav-item">
                        <a class="custom-nav-link <?= $isActive('/faq') ?>" href="<?= url('/faq') ?>">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="custom-nav-link <?= $isActive('/actualites') ?>" href="<?= url('/actualites') ?>">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="custom-nav-link <?= $isActive('/contact') ?>" href="<?= url('/contact') ?>">Contactez-nous</a>
                    </li>
                <?php } ?>

                <?php if (!empty($_SESSION['userID'])) { ?>
                    <li class="nav-item">
                        <a class="custom-nav-link text-danger" href="<?= url('/deconnexion') ?>" title="Déconnexion">Déconnexion</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
