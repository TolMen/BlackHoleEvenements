<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== GeoIP - Restriction France uniquement =====
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/Decoder.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/InvalidDatabaseException.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/Metadata.php';
require_once __DIR__ . '/../../model/Services/MaxMind/MaxMind/Db/Reader/Util.php';

use MaxMind\Db\Reader;

function isAllowedCountry(): bool
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if ($ip === '127.0.0.1' || $ip === '::1') return true;

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
    }

    try {
        $reader = new Reader(__DIR__ . '/../../../private/geoip/dbip-country.mmdb');
        $record = $reader->get($ip);
        $reader->close();
        return isset($record['country']['iso_code'])
            && $record['country']['iso_code'] === 'FR';
    } catch (Exception $e) {
        return true; // Fallback : on laisse passer
    }
}

if (!isAllowedCountry()) {
    http_response_code(403);
    exit('Accès non autorisé.');
}
// ===== Fin GeoIP =====

include_once '../../model/AdminModel/visitorModel.php';

$visitorModel = new VisitorModel();
$year = (int)date("Y");
$month = (int)date("m");

$cookieName = 'site_visitor_' . $year . '_' . $month;

// Détection des bots par User-Agent
$botPatterns = ['bot', 'crawl', 'spider', 'slurp', 'mediapartners', 'curl', 'wget', 'python', 'scrapy', 'headless'];
$userAgent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');

$isBot = false;
foreach ($botPatterns as $pattern) {
    if (strpos($userAgent, $pattern) !== false) {
        $isBot = true;
        break;
    }
}

// Ne compte que si ce n'est pas un bot et que le cookie n'est pas déjà posé
if (!isset($_COOKIE[$cookieName]) && !$isBot) {
    // Calcule la date d'expiration : dernier jour du mois à 23h59:59
    $expiration = new DateTime("last day of this month 23:59:59");
    setcookie($cookieName, '1', $expiration->getTimestamp(), "/");

    $exists = $visitorModel->getMonthlyVisitors($bdd, $year, $month);

    if (!$exists) {
        $visitorModel->insertMonth($bdd, $year, $month);
    } else {
        $visitorModel->incrementVisitor($bdd, $year, $month);
    }
}

// Comptage des bots bloqués
if ($isBot) {
    $statsFile = dirname(__DIR__, 3) . '/private/blockedStats.json';
    $stats = json_decode(file_get_contents($statsFile), true);
    $stats['bots']++;
    file_put_contents($statsFile, json_encode($stats));
}
