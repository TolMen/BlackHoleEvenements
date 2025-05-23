<?php
include_once '../../model/ImageModel/sectionServiceImageModel.php';

$serviceImageModel = new SectionServiceImageModel();
$servicesForHome = $serviceImageModel->getServicesWithImagesForHome($bdd);
$servicesForServicePage = $serviceImageModel->getServicesWithImagesForServicePage($bdd);

// Trier par ordre_affichage croissant sur la page service
usort($servicesForServicePage, function ($a, $b) {
    return $a['ordre_affichage'] - $b['ordre_affichage'];
});

// Mettre le dernier en premier
if (!empty($servicesForServicePage)) {
    $last = array_pop($servicesForServicePage); // retire le dernier
    array_unshift($servicesForServicePage, $last); // le met en premier
}
