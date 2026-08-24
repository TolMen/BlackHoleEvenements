# Black Hole Évènements

Site vitrine de Black Hole Évènements (prestations audiovisuelles et
événementielles), en PHP, sans dépendance externe.

## Architecture

Toutes les adresses passent par un **contrôleur frontal** (`index.php`), ce qui
donne des URL propres et un seul point d'entrée à sécuriser.

```
index.php                  Contrôleur frontal : table des routes
.htaccess                  Réécriture, HTTPS, sécurité, cache, compression
robots.txt                 Instructions aux moteurs de recherche

config/
  app.php                  Session, constantes, helpers d'URL et de SEO
  database.php             Connexion PDO (instance unique par requête)

src/
  Core/
    Router.php             Association méthode + chemin → contrôleur
    Controller.php         Base commune (BDD, accès admin, erreurs)
    LegacyRedirects.php    Redirections 301 des anciennes adresses
  control/
    RouteControl/          Un contrôleur par rubrique du site
    …                      Contrôles métier existants (formulaires, images…)
  model/                   Accès aux données
  views/
    component/             head, navbar, footer
    page/                  Une vue par page + ses sections
    errors/                Pages 404 et 500

public/                    CSS, JS, images, PDF (seul dossier servi tel quel)
private/                   Configuration, base de démonstration, GeoIP
```

## Routes

| Adresse | Page |
|---|---|
| `/` | Accueil |
| `/services` | Prestations |
| `/inspiration` | Galerie (filtre `?service=`) |
| `/actualites` | Liste des actualités |
| `/actualites/{id}-{slug}` | Article |
| `/faq` | Foire aux questions |
| `/mentions-legales` | Mentions légales |
| `/politique-de-confidentialite` | Politique de confidentialité |
| `/contact` | Contact (GET et POST) |
| `/connexion`, `/deconnexion` | Authentification |
| `/admin`, `/admin/…` | Administration (réservée) |
| `/sitemap.xml` | Plan du site, généré à la volée |

Les anciennes adresses (`/src/views/page/service.php`,
`/src/views/page/legalPage.php?type=faq`…) sont redirigées en **301** vers les
nouvelles : les liens existants et le référencement acquis sont préservés.

## Référencement

- Titre, méta-description et URL canonique propres à chaque page (`views/component/head.php`).
- Open Graph et Twitter Card avec image de partage 1200×630.
- Données structurées schema.org : `LocalBusiness`, `WebSite`, `BreadcrumbList`,
  `Article` (actualités), `FAQPage` (FAQ), `ContactPage`, `CollectionPage`.
- `sitemap.xml` généré depuis la base (pages fixes + articles avec leur date).
- Espaces privés en `noindex`, une seule version de chaque URL (sans slash final,
  domaine avec `www`, HTTPS forcé).
- Les robots des moteurs de recherche ne sont plus bloqués par le filtre
  géographique : ils explorent depuis des adresses IP étrangères.

## Installation

1. Copier le dépôt à la racine web (ou dans un sous-dossier : le chemin de base
   est détecté automatiquement).
2. Créer `private/config/configBDD.php` :

```php
<?php
return [
    'host'   => 'localhost',
    'dbname' => 'blackhole',
    'admin'  => 'utilisateur',
    'pass'   => 'motdepasse',
];
```

3. Créer `private/config/configMail.php` avec `$mail_pass` (mot de passe SMTP).
4. Importer `private/bdd.sql`.
5. En développement, passer `APP_ENV` à `'development'` dans `config/app.php`
   pour afficher les erreurs.

Apache doit avoir `mod_rewrite` activé.
