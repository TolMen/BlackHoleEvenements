<?php
include_once '../../control/BDDControl/connectBDD.php';

class HeroHomeImageModel
{
    public function getHeroHomeImages(PDO $bdd)
    {
        $sql = "SELECT nom, chemin_img, alt FROM images WHERE tag = 'imgHeroHome'";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countHeroHomeImages(PDO $bdd)
    {
        $sql = "SELECT COUNT(*) as total FROM images WHERE tag = 'imgHeroHome'";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }
}
