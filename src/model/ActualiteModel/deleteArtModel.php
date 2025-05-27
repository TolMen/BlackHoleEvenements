<?php
include_once '../../control/BDDControl/connectBDD.php';

class DeleteArtModel
{
    public function deleteArticleWithImage(PDO $bdd, $articleID)
    {
        $query = $bdd->prepare("SELECT url FROM image_actu WHERE article_id = ?");
        $query->execute([$articleID]);
        $image = $query->fetch(PDO::FETCH_ASSOC);

        if ($image && isset($image['url'])) {
            $imagePath = '../../../public/assets/img/imgActu/' . $image['url'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $deleteImage = $bdd->prepare("DELETE FROM image_actu WHERE article_id = ?");
            $deleteImage->execute([$articleID]);
        }

        $deleteArticle = $bdd->prepare("DELETE FROM article WHERE id = ?");
        $deleteArticle->execute([$articleID]);
    }
}
