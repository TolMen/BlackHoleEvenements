<?php
include_once '../../model/AdminModel/MessagerieModel.php';

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $MessagerieModel = new MessagerieModel();
    $MessagerieModel->markAsRead($bdd, $id);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'ID manquant']);
}
