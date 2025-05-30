<?php

// Inclus les fichiers nécessaires
include_once '../../model/InspirationModel/filtreServiceModel.php';
include_once '../../model/InspirationModel/filtreThemeModel.php';
include_once '../../model/InspirationModel/filtreLieuModel.php';

$serviceModel = new FiltreServiceModel();
$themeModel = new FiltreThemeModel();
$lieuModel = new FiltreLieuModel();

$services = $serviceModel->getAll($bdd);
$themes = $themeModel->getAll($bdd);
$lieux = $lieuModel->getAll($bdd);
