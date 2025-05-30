<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class FiltreLieuModel
{
    public function getAll(PDO $bdd)
    {
        $sql = "SELECT * FROM lieux ORDER BY id ASC";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
