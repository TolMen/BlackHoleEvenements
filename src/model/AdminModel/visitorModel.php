<?php

include_once '../../control/BDDControl/connectBDD.php';

class VisitorModel
{
    public function getMonthlyVisitors(PDO $bdd, int $year, int $month)
    {
        $stmt = $bdd->prepare("SELECT visitor_count FROM visiteur_mensuel WHERE year = ? AND month = ?");
        $stmt->execute([$year, $month]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getYearlyVisitors(PDO $bdd, int $year)
    {
        $stmt = $bdd->prepare("SELECT month, visitor_count FROM visiteur_mensuel WHERE year = ? ORDER BY month ASC");
        $stmt->execute([$year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVisitorCountYear(PDO $bdd, int $year)
    {
        $stmt = $bdd->prepare("SELECT SUM(visitor_count) as total_visitors FROM visiteur_mensuel WHERE year = ?");
        $stmt->execute([$year]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total_visitors'];
    }

    public function insertMonth(PDO $bdd, int $year, int $month)
    {
        $stmt = $bdd->prepare("INSERT INTO visiteur_mensuel (year, month, visitor_count) VALUES (?, ?, 1)");
        $stmt->execute([$year, $month]);
    }

    public function incrementVisitor(PDO $bdd, int $year, int $month)
    {
        $stmt = $bdd->prepare("UPDATE visiteur_mensuel SET visitor_count = visitor_count + 1 WHERE year = ? AND month = ?");
        $stmt->execute([$year, $month]);
    }
}
