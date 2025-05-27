<?php
include_once '../../control/BDDControl/connectBDD.php';

class UpdateArtModel
{
    public function updateArticle(PDO $bdd, $id, $title, $content)
    {
        $query = $bdd->prepare('UPDATE article SET title = :title, content = :content, updated_at = NOW() WHERE id = :id');
        $query->execute([
            'title' => $title,
            'content' => $content,
            'id' => $id
        ]);
    }

    public function updateImage(PDO $bdd, $articleID, $imagePath)
    {
        $check = $bdd->prepare("SELECT id FROM image_actu WHERE article_id = :article_id");
        $check->execute(['article_id' => $articleID]);

        if ($check->rowCount() > 0) {
            $update = $bdd->prepare("UPDATE image_actu SET url = :url, created_at = NOW() WHERE article_id = :article_id");
            $update->execute([
                'url' => $imagePath,
                'article_id' => $articleID
            ]);
        } else {
            $insert = $bdd->prepare("INSERT INTO image_actu (url, created_at, article_id) VALUES (:url, NOW(), :article_id)");
            $insert->execute([
                'url' => $imagePath,
                'article_id' => $articleID
            ]);
        }
    }
}
