<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
