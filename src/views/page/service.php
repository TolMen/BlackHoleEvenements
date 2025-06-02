<?php
session_start();

include_once '../../control/AdminControl/visitorControl.php';
include_once '../../control/ImageControl/sectionServiceImageControl.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion des balises meta -->
    <?php include '../component/head.php'; ?>

    <!-- Feuille de style spécifique à la page Service -->
    <link rel="stylesheet" href="../../../public/css/styleService/styleService.css">

    <title>Service - Black Hole Evènements</title>
</head>

<body>

    <!-- Inclusion de la barre de navigation -->
    <?php include '../component/navbar.php'; ?>

    <!-- Section principale des services -->
    <?php include 'sectionService/sectionService.php'; ?>

    <!-- Inclusion du pied de page -->
    <?php include '../component/footer.php'; ?>

    <!-- Librairies JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Scripts personnalisés -->
    <script src="../../../public/js/slideService.js"></script>

</body>

</html>
