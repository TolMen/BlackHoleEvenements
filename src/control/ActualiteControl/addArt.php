<?php

session_name("main");
session_start();

include_once '../../model/ActualiteModel/addArtModel.php';
include_once '../../model/Services/imageService.php';

if (isset($_POST['publishArticle'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $createdAt = date('Y-m-d H:i:s');
    $userID = $_SESSION['userID'];

    $addArticleModel = new AddArticleModel();
    $articleID = $addArticleModel->insertArticle($bdd, $title, $content, $createdAt, $userID);

    if ($articleID) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = '../../../public/assets/img/imgActu/';

            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            $uniqueName = 'imgActu_' . $articleID . '.' . $fileExt;
            $destPath = $uploadDir . $uniqueName;

            if (ImageService::compressAndResizeImage($fileTmpPath, $destPath, 800, 800, 75)) {
                $imgUrl = $uniqueName;
                $addArticleModel->insertImage($bdd, $imgUrl, $createdAt, $articleID);
            } else {
                header('Location: ../../../createArt.php?compressionFail=true');
                exit;
            }
        }

        header('Location: ../../views/page/actualite.php?articleID=' . $articleID);
        throw new Exception("Redirection vers la page de l'article");
    }
}
