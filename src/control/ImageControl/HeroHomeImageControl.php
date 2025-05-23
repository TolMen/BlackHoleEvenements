<?php

include_once '../../model/ImageModel/heroHomeImageModel.php';

$heroHomeImageModel = new HeroHomeImageModel();
$imagesHeroHome = $heroHomeImageModel->getHeroHomeImages($bdd);
$totalHeroHomeImages = $heroHomeImageModel->countHeroHomeImages($bdd);
