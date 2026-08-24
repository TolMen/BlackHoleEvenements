<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../control/BDDControl/connectBDD.php';


class FiltreThemeModel
{
    public function getAll(PDO $bdd)
    {
        $sql = "SELECT * FROM themes ORDER BY id ASC";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
