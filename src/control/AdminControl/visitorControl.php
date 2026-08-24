<?php

/**
 * Comptage des visites et filtrage géographique.
 *
 * Deux points importants pour le référencement :
 *  - les robots des moteurs de recherche ne sont JAMAIS bloqués par le
 *    filtre géographique : Googlebot et Bingbot explorent depuis des
 *    adresses IP majoritairement américaines, les bloquer revenait à
 *    empêcher l'indexation du site ;
 *  - ils ne sont pas comptés comme visiteurs, pour ne pas fausser les
 *    statistiques.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/Decoder.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/InvalidDatabaseException.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/Metadata.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/Util.php';

use MaxMind\Db\Reader;

$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');

/** Robots des moteurs de recherche : accès toujours autorisé. */
function isSearchEngineBot(string $userAgent): bool
{
    $crawlers = [
        'googlebot',
        'google-inspectiontool',
        'storebot-google',
        'bingbot',
        'adidxbot',
        'duckduckbot',
        'qwantify',
        'yandexbot',
        'baiduspider',
        'applebot',
        'slurp',              // Yahoo
        'facebookexternalhit',
        'twitterbot',
        'linkedinbot',
        'whatsapp',
        'ia_archiver',
    ];

    foreach ($crawlers as $crawler) {
        if (str_contains($userAgent, $crawler)) {
            return true;
        }
    }

    return false;
}

/** Autres robots (aspirateurs, scripts) : comptés à part, non comptés en visite. */
function isGenericBot(string $userAgent): bool
{
    $patterns = ['bot', 'crawl', 'spider', 'mediapartners', 'curl', 'wget', 'python', 'scrapy', 'headless'];

    foreach ($patterns as $pattern) {
        if (str_contains($userAgent, $pattern)) {
            return true;
        }
    }

    return false;
}

function isAllowedCountry(): bool
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';

    if ($ip === '127.0.0.1' || $ip === '::1') {
        return true;
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
    }

    try {
        $reader = new Reader(PRIVATE_PATH . '/geoip/dbip-country.mmdb');
        $record = $reader->get($ip);
        $reader->close();

        return isset($record['country']['iso_code'])
            && $record['country']['iso_code'] === 'FR';
    } catch (Exception $e) {
        return true; // Repli : en cas de doute, on laisse passer.
    }
}

$isSearchEngine = isSearchEngineBot($userAgent);
$isBot          = $isSearchEngine || isGenericBot($userAgent);

// Filtre géographique : jamais appliqué aux moteurs de recherche.
if (!$isSearchEngine && !isAllowedCountry()) {
    http_response_code(403);
    exit('Accès non autorisé.');
}

include_once __DIR__ . '/../../model/AdminModel/visitorModel.php';

$visitorModel = new VisitorModel();
$year  = (int) date('Y');
$month = (int) date('m');

$cookieName = 'site_visitor_' . $year . '_' . $month;

// Un visiteur humain n'est compté qu'une fois par mois.
if (!isset($_COOKIE[$cookieName]) && !$isBot) {
    $expiration = new DateTime('last day of this month 23:59:59');
    setcookie($cookieName, '1', $expiration->getTimestamp(), '/');

    $exists = $visitorModel->getMonthlyVisitors($bdd, $year, $month);

    if (!$exists) {
        $visitorModel->insertMonth($bdd, $year, $month);
    } else {
        $visitorModel->incrementVisitor($bdd, $year, $month);
    }
}

// Comptage des robots, hors moteurs de recherche légitimes.
if ($isBot && !$isSearchEngine) {
    $statsFile = PRIVATE_PATH . '/blockedStats.json';

    if (is_file($statsFile)) {
        $stats = json_decode((string) file_get_contents($statsFile), true);
        $stats = is_array($stats) ? $stats : ['bots' => 0, 'spam' => 0];
        $stats['bots'] = (int) ($stats['bots'] ?? 0) + 1;
        file_put_contents($statsFile, json_encode($stats));
    }
}
