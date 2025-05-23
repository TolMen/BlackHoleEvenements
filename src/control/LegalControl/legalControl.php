<?php
include_once '../../model/LegalModel/legalModel.php';

$type = $_GET['type'];

$tableMap = [
    'faq' => ['table' => 'faq', 'title' => 'Foire aux Questions', 'fields' => ['question', 'answer']],
    'ml' => ['table' => 'mention_legale', 'title' => 'Mentions Légales', 'fields' => ['title', 'content']],
    'pc' => ['table' => 'politique_confidentialite', 'title' => 'Politique de Confidentialité', 'fields' => ['title', 'content']]
];

if (!array_key_exists($type, $tableMap)) {
    http_response_code(404);
    exit("Type de page invalide.");
}

$legalModel = new LegalModel();
$data = $legalModel->getAll($bdd, $tableMap[$type]['table']);
$pageTitle = $tableMap[$type]['title'];
$htmlTitle = $pageTitle . " | Black Hole Évènements";
$fields = $tableMap[$type]['fields'];