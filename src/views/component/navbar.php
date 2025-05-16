<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-md fixed-top customNavbar">
    <div class="container-fluid">
        <a href="home.php" class="navbar-brand"><img src="../../../public/assets/logo.png" alt="Logo Black Hole Evènements"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="custom-nav-link <?php echo ($current_page == 'home.php') ? 'active' : ''; ?>" href="home.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="custom-nav-link <?php echo ($current_page == 'service.php') ? 'active' : ''; ?>" href="service.php">Service</a>
                </li>
                <li class="nav-item">
                    <a class="custom-nav-link <?php echo ($current_page == 'inspiration.php') ? 'active' : ''; ?>" href="inspiration.php">Inspiration</a>
                </li>
                <li class="nav-item">
                    <a class="custom-nav-link <?php echo ($current_page == 'faq.php') ? 'active' : ''; ?>" href="faq.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="custom-nav-link <?php echo ($current_page == 'actualite.php') ? 'active' : ''; ?>" href="actualite.php">Actualités</a>
                </li>
                <li class="nav-item">
                    <a class="custom-nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contactez-nous</a>
                </li>

                <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin'): ?>
                    <li class="nav-item dropdown">
                        <a class="custom-nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administration
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="user_list.php">Gestion des utilisateurs</a></li>
                            <li><a class="dropdown-item" href="messagerie.php">Messagerie</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (!empty($_SESSION['userID'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="src/control/UserControl/logout.php" title="Déconnexion">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>