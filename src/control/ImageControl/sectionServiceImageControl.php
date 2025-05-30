<?php

// Inclus les fichiers nécessaires
include_once '../../model/ImageModel/sectionServiceImageModel.php';

$serviceImageModel = new SectionServiceImageModel();
$servicesForHome = $serviceImageModel->getServicesWithImagesForHome($bdd);
$servicesForServicePage = $serviceImageModel->getServicesWithImagesForServicePage($bdd);

usort($servicesForServicePage, function ($a, $b) {
    return $a['ordre_affichage'] - $b['ordre_affichage'];
});

if (!empty($servicesForServicePage)) {
    $last = array_pop($servicesForServicePage);
    array_unshift($servicesForServicePage, $last);
}
