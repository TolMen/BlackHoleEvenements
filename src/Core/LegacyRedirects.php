<?php

/**
 * Redirections 301 des anciennes adresses vers les URL propres.
 *
 * Le site était auparavant accessible par le chemin réel des fichiers
 * (/src/views/page/service.php, /src/views/page/legalPage.php?type=faq…).
 * Ces adresses sont peut-être encore indexées ou présentes dans des liens
 * externes : plutôt que de les laisser tomber en 404, on les redirige en
 * 301 (« déplacé définitivement ») pour transmettre leur ancienneté et
 * leur popularité aux nouvelles adresses.
 */

/**
 * Redirige si l'URI demandée correspond à une ancienne adresse.
 * Ne fait rien sinon : le routeur prend alors la main.
 */
function handle_legacy_redirect(string $uri): void
{
    $target = legacy_target($uri);

    if ($target === null) {
        return;
    }

    header('Location: ' . url($target), true, 301);
    exit;
}

/** Nouvelle adresse correspondant à une ancienne, ou null. */
function legacy_target(string $uri): ?string
{
    // Ancien point d'entrée : /index.php
    if ($uri === '/index.php') {
        return '/';
    }

    if (!preg_match('#^/src/views/page/([A-Za-z0-9_]+)\.php$#', $uri, $matches)) {
        return null;
    }

    $page = $matches[1];
    $type = $_GET['type'] ?? '';

    switch ($page) {
        case 'home':
            return '/';

        case 'service':
            return '/services';

        case 'inspiration':
            $service = $_GET['service'] ?? '';
            return $service !== ''
                ? '/inspiration?service=' . rawurlencode($service)
                : '/inspiration';

        case 'contact':
            return '/contact';

        case 'login':
            return '/connexion';

        case 'statsBlocked':
            return '/admin/statistiques-bloquees';

        case 'dashboard':
            return match ($type) {
                'messagerie' => '/admin/messagerie',
                'galerie'    => '/admin/galerie',
                'changelog'  => '/admin/changelog',
                default      => '/admin',
            };

        case 'legalPage':
            return match ($type) {
                'faq'   => '/faq',
                'ml'    => '/mentions-legales',
                'pc'    => '/politique-de-confidentialite',
                default => '/faq',
            };

        case 'actualite':
            if ($type === 'create') {
                return '/admin/actualites/nouvelle';
            }

            $articleID = (int) ($_GET['articleID'] ?? 0);

            if ($articleID > 0) {
                // Sans le titre ici : l'article redirige lui-même vers son
                // adresse complète avec le slug.
                return $type === 'update'
                    ? '/admin/actualites/' . $articleID . '/modifier'
                    : '/actualites/' . $articleID;
            }

            return '/actualites';
    }

    return null;
}
