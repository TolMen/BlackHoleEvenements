<?php

// Inclus les fichiers nécessaires
include_once '../../model/ImageModel/galleryImageModel.php';

$galleryImageModel = new GalleryImageModel();
$imagesGallery = $galleryImageModel->getAllImages($bdd);

// Enrichissement avec le chemin thumbnail (si le fichier existe)
// Les thumbnails sont générés à l'upload dans public/assets/img/thumbs/
$thumbBaseDir = __DIR__ . '/../../../public/assets/img/thumbs/';

foreach ($imagesGallery as &$img) {
    $thumbFile = $thumbBaseDir . 'thumb_' . $img['chemin_img'];
    $img['chemin_thumb'] = file_exists($thumbFile)
        ? 'thumbs/thumb_' . $img['chemin_img']
        : null;
}
unset($img); // Casser la référence après la boucle