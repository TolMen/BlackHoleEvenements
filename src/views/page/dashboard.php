<?php

session_start();

include_once '../../control/AdminControl/messagerieControl.php';


$isMessagerieView = (isset($_GET['type']) && $_GET['type'] === 'messagerie');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion des balises meta -->
    <?php include '../component/head.php'; ?>

    <?php if ($isMessagerieView) { ?>
        <link rel="stylesheet" href="../../../public/css/styleAdmin/styleMessagerie.css">
        <link rel="stylesheet" href="../../../public/css/stylePopUp/stylePopUp.css">
    <?php } ?>

    <title>Dashboard - Black Hole Evènements</title>
</head>

<body>

    <!-- Inclusion de la barre de navigation -->
    <?php include '../component/navbar.php' ?>

    <?php if ($isMessagerieView) {
        include 'sectionDashboard/sectionMessagerie.php'; 
    } ?>

    <!-- Liens vers les scripts JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../../public/js/messagePopup.js"></script>

</body>

</html>
