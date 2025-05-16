<footer class="footer py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Black Hole Evènements</h5>
                <p class="opacity-75">
                    Entreprise spécialisés dans la prestation audiovisuelle et événementielle
                </p>
                <div class="d-flex gap-2 mt-4">
                    <a href="https://www.facebook.com/BlackHoleEvent" target="_blank" title="Facebook" class="socialIcon">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://www.youtube.com/@fredericblackholeevenement2104" target="_blank" title="YouTube" class="socialIcon">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://www.instagram.com/blackholeevenements/?hl=fr" target="_blank" title="Instagram" class="socialIcon">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <!-- Rajouter le lien LinkedIn aprés sa création -->
                    <!-- <a href="#" title="LinkedIn" class="socialIcon">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a> -->
                </div>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="fw-bold mb-3">Liens rapide</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="home.php" class="footerLink">Accueil</a></li>
                    <li class="mb-2"><a href="service.php" class="footerLink">Service</a></li>
                    <li class="mb-2"><a href="inspiration.php" class="footerLink">Inspiration</a></li>
                    <li class="mb-2"><a href="faq.php" class="footerLink">FAQ</a></li>
                    <li class="mb-2"><a href="login.php" class="footerLink">Compte</a></li>
                    <li class="mb-2"><a href="contact.php" class="footerLink">Contactez-nous</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="fw-bold mb-3">Ressources</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="actualite.php" class="footerLink">Actualités</a></li>
                    <li class="mb-2">
                        <a href="../../../public/files/plaquettePrestations.pdf" class="footerLink" target="_blank" download="Plaquette_prestations_sur_mesure_Black_Hole_Evénements.pdf">
                            Plaquette général
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="../../../public/files/plaquetteFAQ.pdf" class="footerLink" target="_blank" download="Plaquette_FAQ_Black_Hole_Evénements.pdf">
                            Plaquette FAQ
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Un projet ?</h6>
                <p class="opacity-75">
                    Discutons de vos besoins pour faire de votre événement un moment inoubliable.
                </p>
                <a href="tel:+33973170376" class="telBtn">09 XX XX XX XX</a>

                <div class="mailBtn">
                    <a href="#" class="socialIcon" id="copyEmail" data-email="blackhole.evenements@gmail.com" title="Copier l'adresse e-mail">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                    <div id="copyMessage" class="mailCopy">
                        Adresse e-mail copiée !
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 opacity-25">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <small class="opacity-75">
                    &copy;
                    <?php
                    date_default_timezone_set("Europe/Paris");
                    echo date("Y");
                    ?>
                    Black Hole Evènements | Tous les droits sont réservés.
                </small>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0 d-flex flex-wrap justify-content-center justify-content-md-end gap-3">
                <a href="mentionLegale.php" class="footerLink"><small>Mentions légales</small></a>
                <a href="politiqueConfidentialite.php" class="footerLink"><small>Politique de confidentialité</small></a>
                <a href="https://jessyf.fr/" class="footerLink"><small>Créateur Web : Jessy Frachisse</small></a>
            </div>
        </div>
    </div>
</footer>

<script src="../../../public/js/copyEmailFeedBack.js"></script>
