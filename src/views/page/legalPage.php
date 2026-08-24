<?php

/**
 * Pages légales : FAQ, mentions légales, politique de confidentialité.
 *
 * Le contenu vient de la base via legalControl ($legalTitle, $data, $fields).
 */

$pageTitle     = $legalTitle;
$pageCanonical = absolute_url($legalPath);
$pageStyles    = ['css/styleLegal/styleLegal.css'];

$descriptions = [
    '/faq' => 'Toutes les réponses à vos questions sur nos prestations événementielles : '
        . 'devis, matériel, déplacement, délais et déroulement d\'une prestation.',
    '/mentions-legales' => 'Mentions légales du site Black Hole Évènements : éditeur, '
        . 'hébergeur, propriété intellectuelle et conditions d\'utilisation.',
    '/politique-de-confidentialite' => 'Politique de confidentialité de Black Hole Évènements : '
        . 'données collectées, finalités, durée de conservation et exercice de vos droits.',
];

$pageDescription = $descriptions[$legalPath] ?? null;

// La FAQ est balisée en FAQPage : Google peut alors afficher les questions
// et réponses directement dans ses résultats de recherche.
$graph = [
    jsonld_organization(),
    jsonld_breadcrumb(['Accueil' => '/', $legalTitle => $legalPath]),
];

if ($legalPath === '/faq' && !empty($data)) {
    $questions = [];

    foreach ($data as $item) {
        $questions[] = [
            '@type'          => 'Question',
            'name'           => $item[$fields[0]],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => strip_tags((string) $item[$fields[1]]),
            ],
        ];
    }

    $graph[] = [
        '@type'      => 'FAQPage',
        '@id'        => absolute_url('/faq') . '#faq',
        'mainEntity' => $questions,
    ];
}

$pageJsonLd = jsonld_script($graph);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include VIEWS_PATH . '/component/head.php'; ?>
</head>

<body>

    <?php include VIEWS_PATH . '/component/navbar.php'; ?>

    <main>
        <?php include PAGES_PATH . '/sectionLegal/sectionLegal.php'; ?>
    </main>

    <?php include VIEWS_PATH . '/component/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="<?= asset('js/accordeon.js') ?>"></script>

</body>

</html>
