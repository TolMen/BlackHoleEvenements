<?php

// Inclus les fichiers nécessaires
include_once '../../model/AdminModel/MessagerieModel.php';

$MessagerieModel = new MessagerieModel();
$messages = $MessagerieModel->getAllMess($bdd);
