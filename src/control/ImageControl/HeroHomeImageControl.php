<?php

include_once '../../model/ImageModel/HeroHomeImageModel.php';

$heroModel = new HeroHomeImageModel();
$imagesHero = $heroModel->getHeroHomeImages($bdd);
$totalHeroImages = $heroModel->countHeroHomeImages($bdd);
