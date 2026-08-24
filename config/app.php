<?php

/**
 * Configuration générale de l'application.
 *
 * Chargé en tout premier par le contrôleur frontal (index.php) : il définit
 * la session, les chemins absolus, les URL du site et les fonctions d'aide
 * utilisées par les vues (URL propres, URL absolues, données structurées).
 */

// ── Fuseau horaire ───────────────────────────────────────
date_default_timezone_set('Europe/Paris');

// ── Session ──────────────────────────────────────────────
// secure => uniquement en HTTPS, sinon le cookie ne serait jamais posé
// en développement local (http://localhost).
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => $isHttps,
    'httponly' => true,      // inaccessible au JavaScript
    'samesite' => 'Lax',
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Environnement ────────────────────────────────────────
// Détecté automatiquement : « development » en local (XAMPP, WAMP, MAMP…),
// « production » partout ailleurs. Les erreurs sont donc lisibles pendant
// le développement, et jamais affichées aux visiteurs du site en ligne.
(function () {
    $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
    $host = explode(':', $host)[0];   // retire le port éventuel (:8080)

    $isLocal = in_array($host, ['localhost', '127.0.0.1', '::1', ''], true)
        || str_ends_with($host, '.local')
        || str_ends_with($host, '.test')
        || str_ends_with($host, '.localhost');

    define('APP_ENV', $isLocal ? 'development' : 'production');
})();
define('APP_NAME', 'Black Hole Évènements');
define('APP_SHORT', 'Black Hole Évènements');

// ── Chemins absolus sur le disque ────────────────────────
define('SRC_PATH',     ROOT_PATH . '/src');
define('VIEWS_PATH',   SRC_PATH  . '/views');
define('PAGES_PATH',   VIEWS_PATH . '/page');
define('CONTROL_PATH', SRC_PATH  . '/control');
define('MODEL_PATH',   SRC_PATH  . '/model');
define('PUBLIC_PATH',  ROOT_PATH . '/public');
define('PRIVATE_PATH', ROOT_PATH . '/private');

// ── Base URL (calcul automatique) ────────────────────────
// En local : http://localhost/BlackHoleEvenements/  → BASE_PATH = /BlackHoleEvenements
// En production (racine du vhost)                   → BASE_PATH = ''
(function () {
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'));

    if ($dir === '/' || $dir === '.' || $dir === '\\') {
        $dir = '';
    }

    define('BASE_PATH', rtrim($dir, '/'));
})();

// ── URL absolue du site (schéma + hôte + éventuel sous-dossier) ──
// Sert de base à toutes les URL absolues exigées par le SEO :
// canonical, og:url, og:image, JSON-LD et sitemap.xml, qui n'acceptent
// pas de chemins relatifs.
(function () use ($isHttps) {
    $scheme = $isHttps ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'www.blackhole-evenements.com';

    define('APP_URL', $scheme . '://' . $host . BASE_PATH);
})();

// Domaine canonique de production : sert de repli quand l'URL absolue est
// générée hors requête HTTP (tâches en ligne de commande, par exemple).
define('APP_DOMAIN', 'https://www.blackhole-evenements.com');

// Image de partage par défaut (Open Graph / Twitter), en URL absolue.
define('APP_DEFAULT_OG_IMAGE', APP_URL . '/public/assets/og/og-default.jpg');

// Coordonnées de l'entreprise, réutilisées par le pied de page et le JSON-LD.
define('APP_PHONE', '+33973170376');
define('APP_PHONE_DISPLAY', '09 73 17 03 76');
define('APP_EMAIL', 'blackhole.evenements@gmail.com');

/**
 * Construit une URL interne propre à partir d'un chemin racine.
 * Ex. url('/services') → /services (ou /BlackHoleEvenements/services en local).
 */
function url(string $path = '/'): string
{
    if ($path === '' || $path === '/') {
        return BASE_PATH . '/';
    }
    return BASE_PATH . '/' . ltrim($path, '/');
}

/**
 * URL d'un fichier statique du dossier public/.
 * Ex. asset('css/styleBase.css') → /public/css/styleBase.css
 */
function asset(string $path): string
{
    return BASE_PATH . '/public/' . ltrim($path, '/');
}

/**
 * URL absolue (schéma + hôte) d'un chemin interne.
 * Requise pour les balises canonical, og:url et le JSON-LD.
 */
function absolute_url(string $path = '/'): string
{
    if ($path === '' || $path === '/') {
        return APP_URL . '/';
    }
    return APP_URL . '/' . ltrim($path, '/');
}

/**
 * Transforme un texte en segment d'URL lisible et stable.
 * Ex. « Notre soirée à Riom ! » → « notre-soiree-a-riom »
 *
 * Utilisé pour les URL d'articles (/actualites/12-notre-soiree-a-riom),
 * bien plus explicites pour les moteurs de recherche que ?articleID=12.
 */
function slugify(string $text): string
{
    $slug = $text;

    // Translittération des accents quand l'extension intl/iconv est là.
    if (function_exists('iconv')) {
        $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $slug);
        if ($converted !== false) {
            $slug = $converted;
        }
    }

    $slug = strtolower($slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? '';
    $slug = trim($slug, '-');

    return $slug !== '' ? $slug : 'article';
}

/**
 * Chemin interne d'un article : /actualites/12-notre-soiree-a-riom
 *
 * L'identifiant reste en tête pour que l'article soit toujours retrouvable
 * même si son titre change ; le slug n'est là que pour les moteurs et les
 * lecteurs. Une adresse dont le slug a vieilli est redirigée en 301 vers
 * l'adresse à jour (voir ActualiteController::show).
 */
function article_path(int $id, string $title = ''): string
{
    $slug = $title !== '' ? '-' . slugify($title) : '';

    return '/actualites/' . $id . $slug;
}

/** URL propre d'un article, prête à mettre dans un href. */
function article_url(int $id, string $title = ''): string
{
    return url(article_path($id, $title));
}

/**
 * Chemin (relatif à public/) de l'illustration d'un article,
 * avec repli sur le logo du site.
 */
function article_image_file(?string $file): string
{
    if ($file === null || $file === '') {
        return 'assets/logo.png';
    }

    return 'assets/img/imgActu/' . $file;
}

/** URL de l'illustration d'un article. */
function article_image_url(?string $file): string
{
    return asset(article_image_file($file));
}

/**
 * URL absolue d'un fichier de public/ (og:image, JSON-LD…).
 */
function absolute_asset(string $path): string
{
    return APP_URL . '/public/' . ltrim($path, '/');
}

/**
 * Échappement HTML court, utilisé partout dans les vues.
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Fiche d'identité de l'entreprise (schema.org/LocalBusiness).
 *
 * Présente sur toutes les pages : elle permet à Google d'identifier
 * l'entreprise, sa zone d'intervention et ses coordonnées, et sert de
 * « publisher » aux articles d'actualité.
 */
function jsonld_organization(): array
{
    return [
        '@type'       => 'LocalBusiness',
        '@id'         => APP_URL . '/#organization',
        'name'        => 'Black Hole Évènements',
        'url'         => APP_URL . '/',
        'logo'        => [
            '@type' => 'ImageObject',
            'url'   => APP_URL . '/public/assets/logo.png',
        ],
        'image'       => APP_DEFAULT_OG_IMAGE,
        'description' => 'Prestataire audiovisuel et événementiel : mariages, concerts, '
            . 'festivals, salons et soirées privées. Éclairage, sonorisation, vidéo '
            . 'projection, effets spéciaux et simulation 3D.',
        'telephone'   => APP_PHONE,
        'email'       => APP_EMAIL,
        'priceRange'  => '€€',
        'address'     => [
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Riom',
            'postalCode'      => '63200',
            'addressRegion'   => 'Auvergne-Rhône-Alpes',
            'addressCountry'  => 'FR',
        ],
        'areaServed'  => [
            ['@type' => 'City',  'name' => 'Clermont-Ferrand'],
            ['@type' => 'City',  'name' => 'Riom'],
            ['@type' => 'State', 'name' => 'Auvergne-Rhône-Alpes'],
            ['@type' => 'Country', 'name' => 'France'],
        ],
        'sameAs' => [
            'https://www.facebook.com/BlackHoleEvent',
            'https://www.instagram.com/blackholeevenements/',
            'https://www.youtube.com/@fredericblackholeevenement2104',
        ],
    ];
}

/**
 * Fil d'Ariane structuré (schema.org/BreadcrumbList).
 *
 * @param array<string,string> $trail Libellé => chemin interne ('/services').
 */
function jsonld_breadcrumb(array $trail): array
{
    $items = [];
    $position = 1;

    foreach ($trail as $label => $path) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => $label,
            'item'     => absolute_url($path),
        ];
    }

    return [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}

/**
 * Sérialise un graphe JSON-LD en balise <script> prête à insérer.
 *
 * JSON_HEX_TAG encode < et > : un contenu comportant « </script> »
 * ne peut donc pas casser la page ni injecter de code.
 *
 * @param array $data Un objet schema.org, ou une liste d'objets.
 */
function jsonld_script(array $data): string
{
    // Liste d'objets → on l'emballe dans un @graph unique.
    if (isset($data[0])) {
        $data = ['@graph' => $data];
    }

    if (!isset($data['@context'])) {
        $data = ['@context' => 'https://schema.org'] + $data;
    }

    $json = json_encode(
        $data,
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG
    );

    if ($json === false) {
        return '';
    }

    return '<script type="application/ld+json">' . $json . '</script>';
}

// ── Affichage des erreurs ────────────────────────────────
if (APP_ENV === 'development') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}
