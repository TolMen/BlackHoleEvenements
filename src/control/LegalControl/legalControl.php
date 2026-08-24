<?php

/**
 * Prépare le contenu d'une page légale (FAQ, mentions légales, politique de
 * confidentialité).
 *
 * Le type est fourni par la route (/faq, /mentions-legales,
 * /politique-de-confidentialite) via la variable $type ; l'ancien paramètre
 * ?type= reste accepté en repli.
 */

include_once __DIR__ . '/../../model/LegalModel/legalModel.php';

$type = $type ?? ($_GET['type'] ?? '');

$tableMap = [
    'faq' => [
        'table'  => 'faq',
        'title'  => 'Foire aux Questions',
        'fields' => ['question', 'answer'],
        'path'   => '/faq',
    ],
    'ml' => [
        'table'  => 'mention_legale',
        'title'  => 'Mentions Légales',
        'fields' => ['title', 'content'],
        'path'   => '/mentions-legales',
    ],
    'pc' => [
        'table'  => 'politique_confidentialite',
        'title'  => 'Politique de Confidentialité',
        'fields' => ['title', 'content'],
        'path'   => '/politique-de-confidentialite',
    ],
];

if (!array_key_exists($type, $tableMap)) {
    http_response_code(404);
    require VIEWS_PATH . '/errors/404.php';
    exit;
}

$legalModel = new LegalModel();
$data       = $legalModel->getAll($bdd, $tableMap[$type]['table']);
$legalTitle = $tableMap[$type]['title'];
$legalPath  = $tableMap[$type]['path'];
$fields     = $tableMap[$type]['fields'];
