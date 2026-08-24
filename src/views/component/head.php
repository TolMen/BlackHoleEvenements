<?php

/**
 * <head> commun à toutes les pages.
 *
 * Chaque vue définit, AVANT d'inclure ce fichier, les variables dont elle a
 * besoin. Toutes sont facultatives : des valeurs de repli prennent le relais.
 *
 *   $pageTitle       string   Titre de l'onglet et du résultat Google (50-60 car.).
 *                             « | Black Hole Évènements » est ajouté automatiquement.
 *   $pageTitleRaw    string   Titre complet, sans ajout automatique du suffixe.
 *   $pageDescription string   Meta description unique (150-160 car.).
 *   $pageCanonical   string   URL absolue canonique (défaut : URL courante).
 *   $pageRobots      string   Directive robots (défaut : « index, follow »).
 *   $pageOgType      string   og:type (défaut : « website »).
 *   $pageOgImage     string   URL absolue de l'image de partage.
 *   $pageJsonLd      string   Données structurées déjà sérialisées via
 *                             jsonld_script(). Défaut : fiche entreprise.
 *   $pageStyles      string[] Feuilles de style propres à la page, en chemins
 *                             relatifs à public/ (ex. 'css/styleHome/styleHero.css').
 */

// ── Titre ────────────────────────────────────────────────
if (!empty($pageTitleRaw)) {
    $title = $pageTitleRaw;
} elseif (!empty($pageTitle)) {
    $title = $pageTitle . ' | ' . APP_NAME;
} else {
    $title = APP_NAME . ' | Prestataire audiovisuel et événementiel';
}

// ── Description ──────────────────────────────────────────
$description = !empty($pageDescription)
    ? $pageDescription
    : 'Black Hole Évènements, prestataire audiovisuel et événementiel à Riom et '
    . 'Clermont-Ferrand : éclairage, sonorisation, vidéo projection et effets '
    . 'spéciaux pour mariages, concerts, festivals et salons.';

// ── URL canonique (par défaut : URL courante, sans query string) ──
if (!empty($pageCanonical)) {
    $canonical = $pageCanonical;
} else {
    $path      = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $canonical = rtrim(APP_URL, '/') . $path;
}

// ── Robots / Open Graph / Twitter ────────────────────────
$robots   = $pageRobots  ?? 'index, follow';
$ogType   = $pageOgType  ?? 'website';
$ogImage  = $pageOgImage ?? APP_DEFAULT_OG_IMAGE;
$ogImageW = $pageOgImageWidth  ?? 1200;
$ogImageH = $pageOgImageHeight ?? 630;

// ── Données structurées ──────────────────────────────────
// Par défaut : la fiche entreprise, qui doit figurer sur toutes les pages.
$jsonLd = $pageJsonLd ?? jsonld_script(jsonld_organization());

// ── Feuilles de style propres à la page ──────────────────
$styles = $pageStyles ?? [];
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="mobile-web-app-capable" content="yes" />

<title><?= e($title) ?></title>
<meta name="description" content="<?= e($description) ?>" />
<meta name="robots" content="<?= e($robots) ?>" />
<meta name="author" content="Black Hole Évènements" />
<link rel="canonical" href="<?= e($canonical) ?>" />

<!-- Open Graph (Facebook, LinkedIn, WhatsApp…) -->
<meta property="og:site_name" content="<?= e(APP_NAME) ?>" />
<meta property="og:locale" content="fr_FR" />
<meta property="og:type" content="<?= e($ogType) ?>" />
<meta property="og:title" content="<?= e($pageOgTitle ?? $title) ?>" />
<meta property="og:description" content="<?= e($description) ?>" />
<meta property="og:url" content="<?= e($canonical) ?>" />
<meta property="og:image" content="<?= e($ogImage) ?>" />
<meta property="og:image:width" content="<?= e((string) $ogImageW) ?>" />
<meta property="og:image:height" content="<?= e((string) $ogImageH) ?>" />
<meta property="og:image:alt" content="<?= e($pageOgTitle ?? $title) ?>" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= e($pageOgTitle ?? $title) ?>" />
<meta name="twitter:description" content="<?= e($description) ?>" />
<meta name="twitter:image" content="<?= e($ogImage) ?>" />

<!-- Données structurées (schema.org) -->
<?= $jsonLd ?>

<!-- Racine du site, utilisée par les scripts pour construire leurs URL -->
<script>
    window.BASE_URL = "<?= e(BASE_PATH) ?>";
</script>

<!-- Icônes et manifeste -->
<link rel="icon" href="<?= asset('favicon.ico') ?>" sizes="any" />
<link rel="apple-touch-icon" href="<?= asset('assets/logo.png') ?>" />
<link rel="manifest" href="<?= asset('site.webmanifest') ?>" />
<meta name="theme-color" content="#000000" />

<!-- Feuilles de style externes -->
<link rel="preconnect" href="https://cdn.jsdelivr.net" />
<link rel="preconnect" href="https://cdnjs.cloudflare.com" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<!-- Feuilles de style du site -->
<link rel="stylesheet" href="<?= asset('css/styleBase.css') ?>" />
<link rel="stylesheet" href="<?= asset('css/styleColor.css') ?>" />
<link rel="stylesheet" href="<?= asset('css/styleComponent/styleNavBar.css') ?>" />
<link rel="stylesheet" href="<?= asset('css/styleComponent/styleFooter.css') ?>" />

<!-- Feuilles de style propres à la page -->
<?php foreach ($styles as $style) { ?>
    <link rel="stylesheet" href="<?= asset($style) ?>" />
<?php } ?>
