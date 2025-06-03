<?php

include_once '../../control/BDDControl/connectBDD.php';

class UserModel
{
    public function updateCredentials(PDO $bdd, $userId, $newUsername = null, $newPassword = null)
    {
        if ($newUsername && $newPassword) {
            $hashedPassword = hash('sha256', $newPassword);
            $sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
            $stmt = $bdd->prepare($sql);
            return $stmt->execute([$newUsername, $hashedPassword, $userId]);
        } elseif ($newUsername) {
            $sql = "UPDATE users SET username = ? WHERE id = ?";
            $stmt = $bdd->prepare($sql);
            return $stmt->execute([$newUsername, $userId]);
        } elseif ($newPassword) {
            $hashedPassword = hash('sha256', $newPassword);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $bdd->prepare($sql);
            return $stmt->execute([$hashedPassword, $userId]);
        }

        return false;
    }

    public function getUserById(PDO $bdd, $userId)
    {
        $sql = "SELECT id, username FROM users WHERE id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
