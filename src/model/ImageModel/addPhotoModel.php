<?php

include_once '../../control/BDDControl/connectBDD.php';

class AddPhotoModel
{
    public function insertPhoto(PDO $bdd, $photoDesc, $uniqueFilename, $photoAlt, $filtreService, $filtreTheme, $filtreLieu, $createdAt)
    {
        $sql = '
        INSERT INTO images 
        (nom, chemin_img, alt, filtres_services, filtres_themes, filtres_lieux, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ';
        $stmt = $bdd->prepare($sql);

        return $stmt->execute([
            $photoDesc,
            $uniqueFilename,
            $photoAlt,
            $filtreService ?: null,
            $filtreTheme ?: null,
            $filtreLieu ?: null,
            $createdAt
        ]);
    }
}
