-- Configuration BDD

SET NAMES utf8mb4;
USE blackhole; 

-- ---------------------------------------------

-- Désactive temporairement les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Suppression des tables dans le bon ordre
DROP TABLE IF EXISTS faq;
DROP TABLE IF EXISTS mention_legale;
DROP TABLE IF EXISTS politique_confidentialite;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS themes;
DROP TABLE IF EXISTS lieux;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS image_actu;

-- Réactive les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------

-- Table 'faq'
CREATE TABLE IF NOT EXISTS faq (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
) ENGINE=InnoDB;

-- Table 'Mention Légales'
CREATE TABLE IF NOT EXISTS mention_legale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
) ENGINE=InnoDB;

-- Table 'Politique de confidentialité'
CREATE TABLE IF NOT EXISTS politique_confidentialite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
) ENGINE=InnoDB;

-- Table 'Service'
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    valeur VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    chemin_icon VARCHAR(255),
    alt_icon VARCHAR(255),
    ordre_affichage INT
) ENGINE=InnoDB;

-- Table 'Thèmes'
CREATE TABLE IF NOT EXISTS themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    valeur VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Table 'Lieux'
CREATE TABLE IF NOT EXISTS lieux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    valeur VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Table 'users'
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL
) ENGINE=InnoDB;

-- Table 'images'
CREATE TABLE IF NOT EXISTS images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    chemin_img VARCHAR(255) NOT NULL,
    alt VARCHAR(255) NOT NULL,
    filtres_services VARCHAR(255) DEFAULT NULL,
    filtres_themes VARCHAR(255) DEFAULT NULL,
    filtres_lieux VARCHAR(255) DEFAULT NULL,
    tag ENUM('imgHeroHome', 'imgSectionService') DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (filtres_services) REFERENCES services(valeur) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (filtres_themes) REFERENCES themes(valeur) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (filtres_lieux) REFERENCES lieux(valeur) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Table `articles`
CREATE TABLE IF NOT EXISTS article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Table `image_actu`
CREATE TABLE IF NOT EXISTS image_actu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url TEXT NOT NULL,
    created_at DATE NOT NULL,
    article_id INT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES article(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Table `contact`
CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Réinitialisation des AUTO_INCREMENT
ALTER TABLE faq AUTO_INCREMENT = 1;
ALTER TABLE mention_legale AUTO_INCREMENT = 1;
ALTER TABLE politique_confidentialite AUTO_INCREMENT = 1;
ALTER TABLE services AUTO_INCREMENT = 1;
ALTER TABLE themes AUTO_INCREMENT = 1;
ALTER TABLE lieux AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;
ALTER TABLE images AUTO_INCREMENT = 1;
ALTER TABLE article AUTO_INCREMENT = 1;
ALTER TABLE image_actu AUTO_INCREMENT = 1;
ALTER TABLE contact AUTO_INCREMENT = 1;

-- ---------------------------------------------

-- Jeux de données

-- Insertion des utilisateurs fictifs avec génération de hash
INSERT INTO users (username, password, role) VALUES
('root', SHA2('root', 256), 'admin');

-- Insertion des informations FAQ
INSERT INTO faq (question, answer) VALUES
("Combien de temps à l’avance dois-je vous contacter pour l'organisation de mon événement ?", "Il est préférable de prendre contact le plus tôt possible."),
("A quel moment dans mon organisation puis-je faire appel à vous ?", "Vous pouvez faire appel à nous dès le début de vos préparatif, nous sommes là pour vous aiguiller dans les meilleures conditions."),
("Accepteriez-vous de couvrir mon mariage qui se fait à l’autre bout de la France ou à l’étranger ?", "Nous acceptons avec plaisir les prestations longues distances."),
("Existe-t-il un numéro d’urgence si un problème survient ?", "Vous pouvez consulter le technicien sur place. Cependant, vous pouvez nous contacter via le \"XX XX XX XX XX\"."),
("Appliquez-vous des frais de déplacement ?", "Oui, les frais de déplacements sont indiqués dans le devis."),
("Quel est le montant de l’acompte ?", "Le montant de l'acompte et de 40 %."),
("Quelle tenue portez-vous lors d'évènement ?", "Les tenus que nous portons sont en accords avec votre dress-code."),
("A quelle heure se termine la soirée ?", "5 h, voir arrêté préfectoral ou en fonction des horaires de la salle de réception."),
("A quel moment l'installation est-elle prévue ?", "L'installation est prévue quelques jours avant en fonction de votre planning."),
("Comment se passe la désinstallation ?", "En fonction de la disponibilité du lieu, le démontage est possible après votre soirée, ou en début de semaine prochaine.");

-- Insertion des informations Mention légales
INSERT INTO mention_legale (title, content) VALUES
("Editeur du site", "- Raison sociale : Black Hole Evènements <br> - Adresse postale : 14 CHEMIN DE LA PLANEZE, 63800 LA ROCHE-NOIRE France <br> - Adresse mail : blackhole.evenements@gmail.com <br> - Téléphone : 09 73 17 03 76 ou 06 10 56 43 68 ou 07 83 51 86 76 <br> - Forme juridique : Association déclarée <br> - SIRET : 809 220 346 00013 <br> - Responsable : Monsieur Frédéric WERNER"),
("Hébergement du site", "- Nom de l'hebergeur web <br> - Adresse postale de l'hebergeur <br> - Tel de l'hebergeur <br> - Url de l'hebergeur <br>"),
("Conception & Développement", "- Identité : Jessy Frachisse <br> - Statut : Développeur Web <br> - Contact : contact.jessyf@gmail.com <br> - Portfolio : <a style=\"color: var(--color-tomato-item); text-decoration: none;\" href=\"https://jessyf.fr/\">https://jessyf.fr/</a>"),
("Propriété intellectuelle", "Le contenu de ce site (textes, images, code, design) est protégé par le droit d’auteur. <br> Toute reproduction, totale ou partielle, est interdite sans l’autorisation écrite de Black Hole Evènements. <br> Les images utilisées sont soit libres de droits, soit créées par l’auteur."),
("Responsabilité", "Black Hole Evènements s’efforce de fournir des informations à jour sur ce site, mais ne garantit ni l’exactitude ni l’exhaustivité. <br> L’utilisation du site se fait sous la responsabilité de l’utilisateur. <br> L’auteur ne peut être tenu responsable d’un quelconque dommage résultant de la consultation du site."),
("Données personelle", "Ce site peut collecter des données via la page « Contactez-nous » ainsi que toute page associée, uniquement dans le cadre d’un échange avec l’auteur. <br> Les données ne sont en aucun cas cédées à des tiers et sont conservées pour une durée maximale de 12 mois. <br> Conformément au RGPD, vous pouvez demander l’accès, la rectification ou la suppression de vos données à l’adresse suivante : blackhole.evenements@gmail.com"),
("Conditions d'utilisation", "L’accès au site est libre et gratuit. <br> L’auteur se réserve le droit de modifier ou de suspendre le site à tout moment, sans préavis. <br> L’utilisateur s’engage à ne pas utiliser le site à des fins illicites ou malveillantes.");

-- Insertion des informations Politique de confidentialité
INSERT INTO politique_confidentialite (title, content) VALUES
("Introduction", "Le présent site est exploité par Black Hole Evènements. <br> La protection de vos données personnelles est une priorité. <br> Cette politique de confidentialité vise à vous informer de la manière dont vos données sont collectées, utilisées, et protégées sur ce site."),
("Identité du responsable de traitement", "- Responsable : Black Hole Evènements <br> - Statut : Assocation déclarée <br> - Adresse : 14 CHEMIN DE LA PLANEZE, 63800 LA ROCHE-NOIRE France <br> - Email : blackhole.evenements@gmail.com <br> - SIRET : 809 220 346 00013"),
("Données collectées", "Les données personnelles susceptibles d’être collectées sur le site sont les suivantes : <br> - Nom et prénom <br> - Adresse e-mail <br> - Données techniques de navigation (adresse IP, navigateur, pages visitées, etc.)"),
("Finalités du traitement", "Les données collectées ont pour finalités : <br> - Répondre aux messages envoyés via le formulaire de contact <br> - Suivre les statistiques de fréquentation du site <br> - Améliorer le contenu et la navigation du site <br> - Garantir la sécurité du site"),
("Base légale", "Les traitements réalisés sont fondés sur : <br> - Votre consentement (formulaire de contact, cookies) <br> - L’intérêt légitime du responsable du site (analyse de fréquentation, sécurité)"),
("Destinataires des données", "Les données personnelles sont accessibles uniquement par : <br> - Le responsable du traitement <br> - Les prestataires techniques intervenant pour l’hébergement ou la maintenance du site. <br> <br> Aucune donnée n’est cédée ni vendue à des tiers."),
("Durée de conservation", "Les données sont conservées selon les durées suivantes : <br> - Données issues de la page « Contactez-nous » ainsi que toute page associée : 12 mois"),
("Droits des utilisateurs", "Les utilisateurs disposent des droits suivants : <br> - Accès à leurs données <br> - Rectification <br> - Suppression <br> - Portabilité <br> - Limitation ou opposition au traitement <br> - Réclamation auprès de la CNIL");

-- Insertion des filtres

-- Filtre 'Services + ensemble des données liées'
INSERT INTO services (nom, valeur, description, chemin_icon, alt_icon, ordre_affichage) VALUES
("DJ / Artiste", "artiste", "Faites la différence avec des performances artistiques inoubliables. <br> DJs, performers, acrobates, musiciens… laissez la magie opérer avec nos talents.", "iconArtiste.png", "Icône représentant un micro d'artiste", 1),
("Décoration textile", "decoTextile", "Sublimez vos espaces avec nos décors textiles sur mesure. <br> De la tenture scénique aux habillages muraux, chaque tissu transforme votre lieu en un univers unique.", "iconDecoTextile.png", "Icône représentant un rideau textile", 2),
("Décoration lumineuse", "decoLumineuse", "Donnez vie à vos événements grâce à une mise en lumière artistique. <br> Jeux de couleurs, ambiance tamisée ou dynamique : la lumière devient scénographie.", "iconDecoLumineuse.png", "Icône représentant un lustre", 3),
("Eclairage", "eclairage", "Des solutions d’éclairage techniques et créatives pour valoriser votre événement, que ce soit en intérieur ou en extérieur. <br> Atmosphère, sécurité et esthétisme garantis.", "iconEclairage.png", "Icône représentant un projecteur d'éclairage", 4),
("Sonorisation", "sonorisation", "Offrez une qualité sonore professionnelle, adaptée à la taille et à l’ambiance de votre événement. <br> De la conférence intimiste au concert grand format.", "iconSonorisation.png", "Icône représentant un haut-parleur de sonorisation", 5),
("Vidéo", "video", "Capturez l’instant ou projetez-le en grand ! <br> Caméras, écrans LED, captation live… nous donnons à vos contenus toute la visibilité qu’ils méritent.", "iconVideo.png", "Icône représentant un vidéo projecteur", 6),
("Mobilier", "mobilier", "Créez un espace accueillant et fonctionnel avec notre large gamme de mobilier événementiel : design, modulable et adapté à tout type de scénographie.", "iconMobilier.png", "Icône représentant une tente", 7),
("Effets spéciaux", "effetSpeciaux", "Créez une ambiance inoubliable grâce à nos effets spéciaux spectaculaires : fumée lourde, jets de flammes, étincelles froides, et bien plus encore pour faire vibrer votre événement.", "iconEffetSpeciaux.png", "Icône représentant un effet spécial", 8);

-- Filtre 'Thèmes'
INSERT INTO themes (nom, valeur) VALUES
("Mariage", "mariage"),
("Entreprise", "entreprise"),
("Événement", "evenement");

-- Filtre 'Lieux'
INSERT INTO lieux (nom, valeur) VALUES
-- Salles des fêtes
("Salle des fêtes de Beauregard Vendon", "beauregard-vendon"),
("Salle des fêtes de Saint-Illide", "saint-illide"),

-- Granges
("Grange de l\'écuyer", "grange-ecuyer"),
("Grange de Faverolles", "grange-faverolles"),
("Grange d\'Aubusson", "grange-aubusson"),

-- Manoirs
("Manoir de Veygoux", "veygoux"),
("Manoir d\'Alice", "alice"),

-- Domaines
("Domaine du Mialaret", "mialaret"),
("Domaine du Marant", "marant"),
("Domaine du Lac des Estives", "lac-estives"),
("Domaine de Sola", "sola"),
("Domaine de la Tour de Rochefort", "rochefort"),
("Domaine de Féligonde", "feligonde"),
("Domaine du Balbuzard", "balbuzard"),

-- Châteaux
("Château de Périgères", "perigeres"),
("Château du Guérinet", "guerinet"),
("Château du Breuil de Doue", "breuil-doue"),
("Château des Roses et des Tours", "roses-tours"),
("Château des Martinanches", "martinanches"),
("Château des Grange Fort", "grange-fort"),
("Château de Portabéraud", "portaberaud"),
("Château de Planchevienne", "planchevienne"),
("Château de Murol en Saint-Amant", "murol"),
("Château de Miremont", "miremont"),
("Château de Maulmont", "maulmont"),
("Château de la Rivière", "riviere"),
("Château de la Motte", "motte"),
("Château de la Canière", "caniere"),
("Château de la Batisse", "batisse"),
("Château de Gondolle", "gondolle"),
("Château de Davayat", "davayat"),
("Château de Chouvigny", "chouvigny"),
("Château de Bourrassol", "bourrassol"),
("Château Beauvoir", "beauvoir"),
("Château de la Barge", "barge"),

-- Autres
("Hameau des Damayots", "damayots"),
("Gymnase de Bourg-Lastic", "bourg-lastic"),
("Casino de Royat", "casino-royat"),
("Abbaye Saint Gilbert", "abbaye-saint-gilbert"),
("Palais des Congrès", "palais-congres"),
("Le Grand Enclos", "grand-enclos");

-- Insertion des images
INSERT INTO images (nom, chemin_img, alt, filtres_services, filtres_themes, filtres_lieux, tag, created_at) VALUES
("Eclairage extérieur", "imgEclairageExterieur.jpeg", "Photo d'un éclairage extérieur", "eclairage", null, null, "imgHeroHome", NOW()),
("Mariage Aubusson", "imgMariageAubusson.jpeg", "Photo d'un mariage à Aubusson", null, "mariage", null, "imgHeroHome", NOW()),
("Mariage au Clos du Four", "imgMariageClosFour.jpeg", "Photo d'un mariage au Clos du Four", null, "mariage", null, "imgHeroHome", NOW()),
("Mariage à Ébreuil avec déco lumineuse", "imgMariageEbreuilDecoLumineuse.jpeg", "Photo d'un mariage à Ébreuil avec déco lumineuse", "decoLumineuse", "mariage", null, "imgHeroHome", NOW()),
("Mariage à Vichy avec DJ", "imgMariageVichyDJ.jpeg", "Photo d'un mariage à Vichy avec DJ", "artiste", "mariage", null, "imgHeroHome", NOW()),
("Service Artiste", "imgServiceArtiste.jpeg", "Photo du service Artiste", "artiste", null, null, "imgSectionService", NOW()),
("Service Décoration lumineuse", "imgServiceDecoLumineuse.jpeg", "Photo du service Décoration lumineuse", "decoLumineuse", null, null, "imgSectionService", NOW()),
("Service Décoration textile", "imgServiceDecoTextile.jpeg", "Photo du service Décoration textile", "decoTextile", null, null, "imgSectionService", NOW()),
("Service Eclairage", "imgServiceEclairage.jpeg", "Photo du service Eclairage", "eclairage", null, null, "imgSectionService", NOW()),
("Service Effet Speciaux", "imgServiceEffetSpeciaux.jpeg", "Photo du service Effet Spéciaux", "effetSpeciaux", null, null, "imgSectionService", NOW()),
("Service Mobilier", "imgServiceMobilier.jpeg", "Photo du service Mobilier", "mobilier", null, null, "imgSectionService", NOW()),
("Service Sonorisation", "imgServiceSonorisation.jpeg", "Photo du service Sonorisation", "sonorisation", null, null, "imgSectionService", NOW()),
("Service Vidéo", "imgServiceVideo.jpeg", "Photo du service Vidéo", "video", null, null, "imgSectionService", NOW());

-- Insertion de l'article
INSERT INTO article (title, content, created_at, user_id) VALUES
("Refonte graphique du site Black Hole Événement : un nouveau souffle numérique",
"La société Black Hole Événement, spécialiste de l’organisation d’événements sur mesure en Auvergne, dévoile la toute nouvelle version de son site internet ! <br><br>

L’objectif de cette refonte : vous offrir une expérience utilisateur plus fluide, un design moderne, et une présentation claire de nos services événementiels. <br><br>

Cette refonte graphique marque une étape importante pour nous : elle nous permet de valoriser plus efficacement notre savoir-faire dans l’organisation d’événements privés et professionnels (mariages, anniversaires, séminaires, soirées à thème, etc.), tout en vous offrant une expérience utilisateur plus intuitive et fluide, sur ordinateur comme sur mobile. <br><br>

Pour mener à bien ce projet, nous avons collaboré avec un jeune développeur dans le secteur du web (https://jessyf.fr/). <br>
Il nous a accompagnés autour de plusieurs axes techniques : <br><br>

- Intégration d’une charte graphique repensée, plus sobre et élégante <br>
- Mise en place d’une galerie photo interactive pour valoriser les réalisations <br>
- Implémentation d’un système de filtres dynamique (services, lieux, thèmes) <br>
- Développement d’un back-office sécurisé pour la gestion autonome du contenu <br>
- Optimisation SEO (balises, performances, accessibilité) <br><br>

Nous avons à cœur de vous offrir un site à notre image : professionnel, élégant, et facile d’accès, à l’image des événements que nous créons pour vous.<br><br>

N’hésitez pas à nous faire part de vos retours et à explorer les différentes sections du site. <br>
De nouvelles fonctionnalités et publications arrivent bientôt !", 
"2025/05/27 10:10:00", 1),
("Mapping sur table : une expérience immersive avec Black Hole Événements", 
"<p>Chez <strong>Black Hole Événements</strong>, nous vous proposons une technologie innovante et spectaculaire : </p><p><br></p><p>Le <strong><em>mapping vidéo sur table</em></strong>, une animation audiovisuelle immersive qui transforme n’importe quelle table en un véritable terrain de jeu visuel qui émerveillera vos invités.</p><p>Imaginez un dîner où chaque plat s’accompagne d’un spectacle visuel sur votre table, captivant vos convives et rendant l’expérience mémorable.</p><p><br></p><p><br></p><h2>Qu’est-ce que le mapping sur table ?</h2><p><br></p><p>Le mapping vidéo sur table est une technique d’<strong>animation audiovisuelle</strong> qui utilise des projections précises et dynamiques sur les surfaces de tables ou autres supports. Grâce à cette technologie, des images, animations et effets visuels sont projetés en parfaite harmonie avec la forme et les objets présents sur la table, créant un spectacle époustouflant.</p><p><br></p><p>Chez Black Hole Événements, nous maîtrisons cette technologie pour proposer des animations personnalisées adaptées à votre événement — mariage, gala, soirée d’entreprise, lancement de produit ou festival.</p><p><br></p><p><br></p><h2>Pourquoi choisir Black Hole Événements pour votre mapping sur table ?</h2><p><br></p><ol><li data-list='bullet'><span class='ql-ui' contenteditable='false'></span><strong>Expertise technique et créativité</strong> : Notre équipe combine matériel haut de gamme et savoir-faire artistique pour vous garantir un rendu visuel impeccable et original.</li></ol><p><br></p><ol><li data-list='bullet'><span class='ql-ui' contenteditable='false'></span><strong>Personnalisation complète</strong> : Chaque projet est conçu sur-mesure selon votre thème, vos couleurs et vos envies, pour un impact visuel à la hauteur de vos attentes.</li></ol><p><br></p><ol><li data-list='bullet'><span class='ql-ui' contenteditable='false'></span><strong>Immersion totale</strong> : Le mapping sur table capte l’attention de vos invités en créant une atmosphère ludique, magique et interactive.</li></ol><p><br></p><ol><li data-list='bullet'><span class='ql-ui' contenteditable='false'></span><strong>Adaptabilité</strong> : Que vous soyez un restaurateur souhaitant animer vos tables, un organisateur d’événements ou un responsable marketing, nous adaptons nos solutions à votre besoin.</li></ol><p><br></p><p><br></p><h2>Black Hole Événements, spécialiste de l’audiovisuel événementiel en Auvergne</h2><p><br></p><p>Basés à Riom, dans le Puy-de-Dôme, nous accompagnons depuis plusieurs années professionnels et particuliers dans la réussite de leurs événements grâce à nos solutions audiovisuelles : sonorisation, éclairage, vidéo, DJ, effets spéciaux… et désormais mapping vidéo sur table.</p><p><br></p><p>Faites confiance à Black Hole Événements pour donner vie à vos idées et offrir à vos invités un moment inoubliable.</p><p><br></p><p><br></p><p><strong>Contactez-nous dès aujourd’hui</strong> pour découvrir comment le mapping sur table peut révolutionner votre événement !</p><p><br></p>",
"2025/05/27 10:15:00", 1);

-- Insertion de l'image associée à l'article
INSERT INTO image_actu (url, created_at, article_id) VALUES
("imgActu_RefonteSite.png", "2025-05-27", 1),
("imgActu_MappingTable.jpg", "2025-05-27", 2);
