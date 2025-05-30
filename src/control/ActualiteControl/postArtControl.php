<?php

// Inclus les fichiers nécessaires
include_once '../../model/ActualiteModel/postArtModel.php';

if (!empty($_GET['articleID'])) {
    $postArtId = intval($_GET['articleID']);
} else {
    throw new Exception("Identifiant de l'article non spécifié.");
}

$artPostModel = new PostArtModel();
$articles = $artPostModel->getPostArt($bdd, $postArtId);

if (empty($articles)) {
    throw new Exception("Article non trouvé.");
}

$article = $articles[0];

$imageData = $artPostModel->getArticleImage($bdd, $postArtId);
$imageUrl = $imageData['url'] ?? '../../../public/assets/logo.png';

$dateToShow = !empty($article['updated_at']) ? $article['updated_at'] : $article['created_at'];

$isListView = false;