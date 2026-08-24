<?php
include_once __DIR__ . '/../../model/AdminModel/messagerieModel.php';

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $MessagerieModel = new MessagerieModel();
    $MessagerieModel->markAsRead($bdd, $id);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'ID manquant']);
}
