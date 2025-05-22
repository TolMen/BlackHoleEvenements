-- Configuration BDD

SET NAMES utf8mb4;
USE blackhole; 

-- ---------------------------------------------

-- Désactive temporairement les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Suppression des tables dans le bon ordre
DROP TABLE IF EXISTS faq;
DROP TABLE IF EXISTS mentionLegale;
DROP TABLE IF EXISTS politiqueConfidentialite;

-- Réactive les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------

-- Table 'faq'
CREATE TABLE IF NOT EXISTS faq (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

-- Table 'Mention Légales'
CREATE TABLE IF NOT EXISTS mentionLegale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
);

-- Table 'Politique de confidentialité'
CREATE TABLE IF NOT EXISTS politiqueConfidentialite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
);

-- ---------------------------------------------

-- Jeux de données

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
INSERT INTO mentionLegale (title, content) VALUES
("Editeur du site", "- Raison sociale : Black Hole Evènements <br> - Adresse postale : 14 CHEMIN DE LA PLANEZE, 63800 LA ROCHE-NOIRE France <br> - Adresse mail : blackhole.evenements@gmail.com <br> - Téléphone : 09 73 17 03 76 ou 06 10 56 43 68 ou 07 83 51 86 76 <br> - Forme juridique : Association déclarée <br> - SIRET : 809 220 346 00013 <br> - Responsable : Monsieur Frédéric WERNER"),
("Hébergement du site", "- Nom de l'hebergeur web <br> - Adresse postale de l'hebergeur <br> - Tel de l'hebergeur <br> - Url de l'hebergeur <br>"),
("Conception & Développement", "- Identité : Jessy Frachisse <br> - Statut : Développeur Web <br> - Contact : contact.jessyf@gmail.com <br> - Portfolio : <a style=\"color: var(--color-tomato-item); text-decoration: none;\" href=\"https://jessyf.fr/\">https://jessyf.fr/</a>"),
("Propriété intellectuelle", "Le contenu de ce site (textes, images, code, design) est protégé par le droit d’auteur. <br> Toute reproduction, totale ou partielle, est interdite sans l’autorisation écrite de Black Hole Evènements. <br> Les images utilisées sont soit libres de droits, soit créées par l’auteur."),
("Responsabilité", "Black Hole Evènements s’efforce de fournir des informations à jour sur ce site, mais ne garantit ni l’exactitude ni l’exhaustivité. <br> L’utilisation du site se fait sous la responsabilité de l’utilisateur. <br> L’auteur ne peut être tenu responsable d’un quelconque dommage résultant de la consultation du site."),
("Données personelle", "Ce site peut collecter des données via le form XXX XXX XXX XX uniquement dans le cadre d’un échange avec l’auteur. <br> Les données ne sont en aucun cas cédées à des tiers et sont conservées pour une durée maximale de 12 mois. <br> Conformément au RGPD, vous pouvez demander l’accès, la rectification ou la suppression de vos données à l’adresse suivante : blackhole.evenements@gmail.com"),
("Conditions d'utilisation", "L’accès au site est libre et gratuit. <br> L’auteur se réserve le droit de modifier ou de suspendre le site à tout moment, sans préavis. <br> L’utilisateur s’engage à ne pas utiliser le site à des fins illicites ou malveillantes.");

-- Insertion des informations Politique de confidentialité
INSERT INTO politiqueConfidentialite (title, content) VALUES
("Introduction", "Le présent site est exploité par Black Hole Evènements. <br> La protection de vos données personnelles est une priorité. <br> Cette politique de confidentialité vise à vous informer de la manière dont vos données sont collectées, utilisées, et protégées sur ce site."),
("Identité du responsable de traitement", "- Responsable : Black Hole Evènements <br> - Statut : Assocation déclarée <br> - Adresse : 14 CHEMIN DE LA PLANEZE, 63800 LA ROCHE-NOIRE France <br> - Email : blackhole.evenements@gmail.com <br> - SIRET : 809 220 346 00013"),
("Données collectées", "Les données personnelles susceptibles d’être collectées sur le site sont les suivantes : <br> <br> - Nom et prénom <br> - Adresse e-mail <br> - Données techniques de navigation (adresse IP, navigateur, pages visitées, etc.) <br> - XXXX <br> - XXXX"),
("Finalités du traitement", "Les données collectées ont pour finalités : <br> <br> - Répondre aux messages envoyés via le formulaire de contact <br> - Suivre les statistiques de fréquentation du site <br> - Améliorer le contenu et la navigation du site <br> - Garantir la sécurité du site <br> - XXXX <br> - XXXX"),
("Base légale", "Les traitements réalisés sont fondés sur : <br> <br> - Votre consentement (formulaire de contact, cookies) <br> - L’intérêt légitime du responsable du site (analyse de fréquentation, sécurité)"),
("Destinataires des données", "Les données personnelles sont accessibles uniquement par : <br> <br> - Le responsable du traitement <br> - Les prestataires techniques intervenant pour l’hébergement ou la maintenance du site. <br> <br> Aucune donnée n’est cédée ni vendue à des tiers."),
("Durée de conservation", "Les données sont conservées selon les durées suivantes : <br> <br> - Données issues du formulaire de contact : 12 mois <br> - XXXX <br> - XXXX"),
("Droits des utilisateurs", "Les utilisateurs disposent des droits suivants : <br> <br> - Accès à leurs données <br> - Rectification <br> - Suppression <br> - Portabilité <br> - Limitation ou opposition au traitement <br> - Réclamation auprès de la CNIL");
