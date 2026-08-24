<?php

// Inclus les fichiers nécessaires
include_once __DIR__ . '/../../model/ContactModel/contactModel.php';

$MessagerieModel = new ContactModel();
$unReadMessage = $MessagerieModel->countUnReadMessage($bdd);
