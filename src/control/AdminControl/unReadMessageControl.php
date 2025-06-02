<?php

// Inclus les fichiers nécessaires
include_once '../../model/ContactModel/contactModel.php';

$MessagerieModel = new ContactModel();
$unReadMessage = $MessagerieModel->countUnReadMessage($bdd);
