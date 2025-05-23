<?php
include_once '../../control/BDDControl/connectBDD.php';

class LegalModel
{
    public function getAll(PDO $bdd, string $table)
    {
        $allowedTables = ['faq', 'mention_legale', 'politique_confidentialite'];
        if (!in_array($table, $allowedTables)) {
            throw new Exception("Table non autorisée");
        }

        $sql = "SELECT * FROM {$table} ORDER BY id ASC";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
