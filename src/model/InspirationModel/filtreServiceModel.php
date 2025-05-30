<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class FiltreServiceModel
{
    public function getAll(PDO $bdd)
    {
        $sql = "SELECT * FROM services ORDER BY id ASC";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
