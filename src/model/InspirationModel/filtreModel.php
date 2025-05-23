<?php
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
