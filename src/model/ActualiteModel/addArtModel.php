<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class AddArticleModel
{

    public function insertArticle(PDO $bdd, $title, $content, $createdAt, $userID)
    {
        $insertArt = 'INSERT INTO article (title, content, created_at, user_id) VALUES (?, ?, ?, ?)';
        $insertArticle = $bdd->prepare($insertArt);
        $insertArticle->execute([$title, $content, $createdAt, $userID]);

        return $bdd->lastInsertId();
    }

    public function insertImage(PDO $bdd, $url, $createdAt, $articleID)
    {
        $insertImg = 'INSERT INTO image_actu (url, created_at, article_id) VALUES (?, ?, ?)';
        $insertImage = $bdd->prepare($insertImg);
        return $insertImage->execute([$url, $createdAt, $articleID]);
    }
}
