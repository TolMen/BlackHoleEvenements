<?php
session_start();

include_once '../../model/ActualiteModel/updateArtModel.php';
include_once '../../model/Services/imageService.php';

if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../../../views/page/actualite.php');
    exit;
}

$articleID = intval($_GET['articleID']);
$title = $_POST['title'];
$content = $_POST['content'];

$imageName = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../../public/assets/img/imgActu/';

    $fileTmp = $_FILES['image']['tmp_name'];
    $fileOriginalName = basename($_FILES['image']['name']);
    $fileExtension = strtolower(pathinfo($fileOriginalName, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    $imageName = 'imgActu_' . $articleID . '.' . $fileExtension;
    $targetPath = $uploadDir . $imageName;

    if (ImageService::compressAndResizeImage($fileTmp, $targetPath, 800, 800, 75)) {
        $artModel = new UpdateArtModel();
        $artModel->updateImage($bdd, $articleID, $imageName);
    }
}

$artModel = new UpdateArtModel();
$artModel->updateArticle($bdd, $articleID, $title, $content);

header("Location: ../../views/page/actualite.php?articleID=$articleID");
exit;
