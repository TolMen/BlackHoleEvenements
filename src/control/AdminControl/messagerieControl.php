<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/AdminModel/messagerieModel.php';

$MessagerieModel = new MessagerieModel();
$messages = $MessagerieModel->getAllMess($bdd);
