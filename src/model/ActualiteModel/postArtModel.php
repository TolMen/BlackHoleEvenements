<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class PostArtModel
{
    public function getPostArt(PDO $bdd, $postArtId)
    {
        $recupPostArt = $bdd->prepare('SELECT * FROM article WHERE id = :id');
        $recupPostArt->execute(['id' => $postArtId]);
        return $recupPostArt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleImage(PDO $bdd, $articleID)
    {
        $query = $bdd->prepare('SELECT url FROM image_actu WHERE article_id = :article_id LIMIT 1');
        $query->execute(['article_id' => $articleID]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllArt(PDO $bdd)
    {
        $state = $bdd->prepare("SELECT * FROM article ORDER BY id DESC");
        $state->execute();
        return $state->fetchAll();
    }

    public function incrementViews(PDO $bdd, int $articleId): void
    {
        $query = $bdd->prepare('UPDATE article SET views = views + 1 WHERE id = :id');
        $query->execute(['id' => $articleId]);
    }
}
