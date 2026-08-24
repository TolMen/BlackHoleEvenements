<?php

/**
 * Contrôleur frontal : point d'entrée unique du site.
 *
 * Toutes les adresses passent par ce fichier (voir .htaccess), ce qui permet
 * des URL propres du type /services ou /actualites/12-mon-article plutôt que
 * /src/views/page/service.php ou ?articleID=12.
 */

declare(strict_types=1);

define('ROOT_PATH', __DIR__);

require_once ROOT_PATH . '/config/app.php';
require_once ROOT_PATH . '/config/database.php';

require_once SRC_PATH . '/Core/Router.php';
require_once SRC_PATH . '/Core/Controller.php';
require_once SRC_PATH . '/Core/LegacyRedirects.php';

// ── Anciennes adresses (…/src/views/page/xxx.php) ────────
// Redirigées en 301 vers les URL propres avant tout traitement.
(function () {
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

    if (BASE_PATH !== '' && str_starts_with($uri, BASE_PATH)) {
        $uri = substr($uri, strlen(BASE_PATH));
    }

    handle_legacy_redirect('/' . ltrim($uri, '/'));
})();

// ── Contrôleurs de routes ────────────────────────────────
foreach (glob(CONTROL_PATH . '/RouteControl/*.php') ?: [] as $controller) {
    require_once $controller;
}

$router = new Router();

// ── Pages publiques ──────────────────────────────────────
$router->get('/',                             [HomeController::class, 'index']);
$router->get('/services',                     [ServiceController::class, 'index']);
$router->get('/inspiration',                  [InspirationController::class, 'index']);
$router->get('/actualites',                   [ActualiteController::class, 'index']);
$router->get('/actualites/{slug}',            [ActualiteController::class, 'show']);
$router->get('/faq',                          [LegalController::class, 'faq']);
$router->get('/mentions-legales',             [LegalController::class, 'mentions']);
$router->get('/politique-de-confidentialite', [LegalController::class, 'confidentialite']);
$router->get('/contact',                      [ContactController::class, 'form']);
$router->post('/contact',                     [ContactController::class, 'submit']);
$router->get('/sitemap.xml',                  [SitemapController::class, 'index']);

// ── Authentification ─────────────────────────────────────
$router->get('/connexion',   [AuthController::class, 'loginForm']);
$router->post('/connexion',  [AuthController::class, 'login']);
$router->get('/deconnexion', [AuthController::class, 'logout']);

// ── Administration ───────────────────────────────────────
// Les routes fixes sont déclarées avant les routes dynamiques {id}.
$router->get('/admin',                        [AdminController::class, 'dashboard']);
$router->get('/admin/messagerie',             [AdminController::class, 'messagerie']);
$router->get('/admin/galerie',                [AdminController::class, 'galerie']);
$router->get('/admin/changelog',              [AdminController::class, 'changelog']);
$router->get('/admin/statistiques-bloquees',  [AdminController::class, 'statsBlocked']);
$router->post('/admin/compte',                [AdminController::class, 'updateAccount']);

$router->post('/admin/galerie/photos',                 [AdminController::class, 'addPhoto']);
$router->post('/admin/galerie/image-section',          [AdminController::class, 'setSectionImage']);
$router->any('/admin/galerie/photos/{id}/supprimer',   [AdminController::class, 'deletePhoto']);

$router->post('/admin/messagerie/lu',                  [AdminController::class, 'markAsRead']);
$router->any('/admin/messagerie/{id}/supprimer',       [AdminController::class, 'deleteMessage']);

$router->get('/admin/actualites/nouvelle',             [AdminActualiteController::class, 'create']);
$router->post('/admin/actualites',                     [AdminActualiteController::class, 'store']);
$router->get('/admin/actualites/{id}/modifier',        [AdminActualiteController::class, 'edit']);
$router->post('/admin/actualites/{id}',                [AdminActualiteController::class, 'update']);
$router->any('/admin/actualites/{id}/supprimer',       [AdminActualiteController::class, 'destroy']);

$router->dispatch();
