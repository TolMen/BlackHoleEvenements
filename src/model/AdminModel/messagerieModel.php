<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class MessagerieModel
{
    public function getAllMess(PDO $bdd)
    {
        $query = $bdd->prepare("SELECT * FROM contact");
        $query->execute(array());
        $messages = $query->fetchAll();
        return $messages;
    }

    public function markAsRead(PDO $bdd, int $id)
    {
        $query = $bdd->prepare("UPDATE contact SET is_read = 1 WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}
