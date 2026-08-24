<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/ImageModel/HeroHomeImageModel.php';

$heroHomeImageModel = new HeroHomeImageModel();
$imagesHeroHome = $heroHomeImageModel->getHeroHomeImages($bdd);
$totalHeroHomeImages = $heroHomeImageModel->countHeroHomeImages($bdd);
