<?php

// Inclus les fichiers nécessaires
include_once '../../model/ImageModel/galleryImageModel.php';

$galleryImageModel = new GalleryImageModel();
$imagesGallery = $galleryImageModel->getAllImages($bdd);
