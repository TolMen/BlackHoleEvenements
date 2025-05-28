<div class="contactForm">
    <h2 class="section-title">Contactez-nous</h2>
    <hr class="title-separator" />

    <div class="main-container">
        <div class="right-form">
            <form method="POST" id="contactForm" action="../../control/ContactControl/contactControl.php">
                <div class="boxIdentity">
                    <div class="inputBox inputBoxIdentity">
                        <input type="text" id="name" name="name" minlength="2" maxlength="15" pattern="[A-Za-z-]{2,15}" required />
                        <span>Nom complet</span>
                        <i></i>
                    </div>
                    <div class="inputBox inputBoxIdentity">
                        <input type="email" id="email" name="email" required />
                        <span>Email</span>
                        <i></i>
                    </div>
                </div>
                <!-- Honeypot anti-bot (ne pas supprimer) -->
                <div style="display: none;">
                    <label for="website">Ne remplissez pas ce champ si vous êtes humain :</label>
                    <input type="text" name="website" id="website" autocomplete="off">
                </div>

                <div class="inputBox inputBoxOther full-width margeBottom">
                    <input type="text" id="subject" name="subject" minlength="2" required />
                    <span>Objet</span>
                    <i></i>
                </div>
                <div class="inputBox inputBoxOther full-width">
                    <textarea id="message" name="message" minlength="5" required></textarea>
                    <span class="spanTextarea">Message</span>
                </div>
                <input type="submit" name="envoi" value="Envoyer">
            </form>
        </div>
        
        <div class="left-cards">
            <div class="contact-info">
                <p><strong>Téléphone :</strong> 01 23 45 67 89</p>
                <p><strong>Email :</strong> contact@blackhole.fr</p>
                <p><strong>Adresse :</strong> 123 Rue de l'Étoile, Paris</p>
            </div>

            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2787.856130956899!2d3.1028284157272176!3d45.93654497910957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f67e21e949a9cf%3A0x7c8f1a0541f96d46!2s10%20Rue%20Amable%20Faucon%2C%2063200%20Riom!5e0!3m2!1sfr!2sfr!4v1685838000000!5m2!1sfr!2sfr"
                    width="100%"
                    height="250"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>
        </div>
    </div>
</div>