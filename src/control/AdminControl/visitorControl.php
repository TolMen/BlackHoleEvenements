<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once '../../model/AdminModel/VisitorModel.php';

$visitorModel = new VisitorModel();
$year = (int)date("Y");
$month = (int)date("m");

$cookieName = 'site_visitor_' . $year . '_' . $month;

// Utilise un cookie pour éviter de compter plusieurs fois le même visiteur par jour
if (!isset($_COOKIE[$cookieName])) {
    // Calcule la date d’expiration : dernier jour du mois à 23h59:59
    $expiration = new DateTime("last day of this month 23:59:59");
    setcookie($cookieName, '1', $expiration->getTimestamp(), "/");

    $exists = $visitorModel->getMonthlyVisitors($bdd, $year, $month);

    if (!$exists) {
        $visitorModel->insertMonth($bdd, $year, $month);
    } else {
        $visitorModel->incrementVisitor($bdd, $year, $month);
    }
}
