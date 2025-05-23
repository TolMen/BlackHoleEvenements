<?php
include_once '../../model/ImageModel/galleryImageModel.php';

$galleryImageModel = new GalleryImageModel();
$imagesGallery = $galleryImageModel->getAllImages($bdd);
