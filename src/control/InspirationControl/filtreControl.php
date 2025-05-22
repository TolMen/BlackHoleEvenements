<?php
include_once '../../model/InspirationModel/filtreModel.php';


$serviceModel = new FiltreServiceModel();
$themeModel = new FiltreThemeModel();
$lieuModel = new FiltreLieuModel();

$services = $serviceModel->getAll($bdd);
$themes = $themeModel->getAll($bdd);
$lieux = $lieuModel->getAll($bdd);

