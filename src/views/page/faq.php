<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion des balises meta -->
    <?php include '../component/head.php'; ?>

    <!-- Feuille de style spécifique à la page FAQ -->
    <link rel="stylesheet" href="../../../public/css/styleFAQ/styleQR.css">

    <title>FAQ - Black Hole Evènements</title>
</head>

<body>

    <!-- Inclusion de la barre de navigation -->
    <?php include '../component/navbar.php' ?>

    <!-- Section Question/Reponse -->
    <?php include 'sectionFAQ/sectionQR.php'; ?>

    <!-- Inclusion du pied de page -->
    <?php include '../component/footer.php' ?>

    <!-- Librairies JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Scripts personnalisés -->
    <script src="../../../public/js/accordeon.js"></script>

</body>

</html>