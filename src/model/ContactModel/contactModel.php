<?php

// Inclus les fichiers nécessaires
include_once '../../control/BDDControl/connectBDD.php';

class ContactModel
{
    public function getInsert(PDO $bdd, $name, $email, $subject, $message)
    {
        $state = $bdd->prepare("INSERT INTO contact(name,email,subject,message) VALUES (?,?,?,?)");
        $state->execute([$name, $email, $subject, $message]);
    }

    public function getInfo(PDO $bdd, $name, $email, $subject, $message)
    {
        $recup = $bdd->prepare("SELECT name, email, subject, message FROM contact WHERE name = ? AND email = ? AND subject = ? AND message = ?");
        $recup->execute([$name, $email, $subject, $message]);
        $resultatsforms = $recup->fetch();
        return $resultatsforms;
    }

    public function countUnReadMessage(PDO $bdd)
    {
        $sql = "SELECT COUNT(*) as total FROM contact WHERE is_read = '0'";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }
}
