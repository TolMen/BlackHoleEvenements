<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class GalleryImageModel
{
    public function getAllImages(PDO $bdd)
    {
        $sql = "SELECT 
                    chemin_img, 
                    alt, 
                    filtres_services, 
                    filtres_themes, 
                    filtres_lieux 
                FROM images";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
