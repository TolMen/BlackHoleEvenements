<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class SectionServiceImageModel
{
    // Pour la homepage
    public function getServicesWithImagesForHome(PDO $bdd)
    {
        $sql = "SELECT services.nom, services.valeur, services.description, services.chemin_icon, services.alt_icon, services.ordre_affichage, images.chemin_img, images.alt
                    FROM services
                    LEFT JOIN images ON images.filtres_services = services.valeur
                    WHERE images.tag = 'imgSectionService'
                    ORDER BY services.ordre_affichage ASC";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pour la page service
    public function getServicesWithImagesForServicePage(PDO $bdd)
    {
        $sql = "SELECT services.nom, services.valeur, services.description, services.ordre_affichage, images.chemin_img
                    FROM services
                    LEFT JOIN images ON images.filtres_services = services.valeur
                    WHERE images.tag = 'imgSectionService'
                    ORDER BY services.ordre_affichage DESC"; // Inversé pour afficher le 1 en second
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
