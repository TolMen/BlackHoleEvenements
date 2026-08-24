<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/InspirationModel/filtreServiceModel.php';
include_once __DIR__ . '/../../model/InspirationModel/filtreThemeModel.php';
include_once __DIR__ . '/../../model/InspirationModel/filtreLieuModel.php';

$serviceModel = new FiltreServiceModel();
$themeModel = new FiltreThemeModel();
$lieuModel = new FiltreLieuModel();

$services = $serviceModel->getAll($bdd);
$themes = $themeModel->getAll($bdd);
$lieux = $lieuModel->getAll($bdd);
