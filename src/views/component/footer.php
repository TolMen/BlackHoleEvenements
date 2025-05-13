<footer class="footer py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Company Info -->
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Black Hole Evènements</h5>
                <p class="opacity-75">Entreprise spécialisés dans la prestation audiovisuelle et événementielle</p>
                <div class="d-flex gap-2 mt-4">
                    <a href="https://www.facebook.com/BlackHoleEvent" target="_blank" title="Facebook" class="social-icon">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/blackholeevenements/?hl=fr" target="_blank" title="Instagram" class="social-icon">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="tel:+33973170376" title="Téléphonez-nous" class="social-icon">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-4">
                <h6 class="fw-bold mb-3">Liens rapide</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="home.php" class="footer-link">Accueil</a></li>
                    <li class="mb-2"><a href="prestations.php" class="footer-link">Prestations</a></li>
                    <li class="mb-2"><a href="faq.php" class="footer-link">FAQ</a></li>
                    <li class="mb-2"><a href="login.php" class="footer-link">Compte</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="col-lg-2 col-md-4">
                <h6 class="fw-bold mb-3">Ressources</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="actualite.php" class="footer-link">Actualités</a></li>
                    <li class="mb-2"><a href="../../../public/files/plaquettePrestations.pdf" class="footer-link" target="_blank" download="Plaquette_prestations_sur_mesure_Black_Hole_Evénements.pdf">Plaquette général</a></li>
                    <li class="mb-2"><a href="../../../public/files/plaquetteFAQ.pdf" target="_blank" download="Plaquette_FAQ_Black_Hole_Evénements.pdf" class="footer-link">Plaquette FAQ</a></li>
                </ul>
            </div>

            <!-- Call to action -->
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Un projet ?</h6>
                <p class="opacity-75">Discutons de vos besoins pour faire de votre événement un moment inoubliable.</p>
                <a href="contact.php" class="contact-button">Contactez-nous</a>
            </div>


        </div>

        <hr class="my-4 opacity-25">

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <small class="opacity-75">&copy;
                    <?php
                    // Set timezone to Paris and display the current year
                    date_default_timezone_set("Europe/Paris");
                    echo date("Y");
                    ?>
                    Black Hole Evènements | Tous les droits sont réservés.</small>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0 d-flex flex-wrap justify-content-center justify-content-md-end gap-3">
                <a href="mentionLegale.php" class="footer-link"><small>Mentions légales</small></a>
                <a href="politiqueConfidentialite.php" class="footer-link"><small>Politique de confidentialité</small></a>
                <a href="https://jessyf.fr/" class="footer-link"><small>Créateur Web : Jessy Frachisse</small></a>
            </div>

        </div>
    </div>
</footer>