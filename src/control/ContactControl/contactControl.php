<?php

include_once __DIR__ . '/../../model/ContactModel/contactModel.php';
include_once __DIR__ . '/../../model/Services/antiSpamService.php';
include_once __DIR__ . '/../../../private/config/configMail.php';

// PHPMailer
require_once __DIR__ . '/../../model/Services/PHPMailer.php';
require_once __DIR__ . '/../../model/Services/SMTP.php';
require_once __DIR__ . '/../../model/Services/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $antiSpam = new AntiSpamService($bdd);

    // === NETTOYAGE DES DONNÉES ===
    $name = htmlspecialchars(trim($_POST["name"]), ENT_QUOTES);
    $email = htmlspecialchars(trim($_POST["email"]), ENT_QUOTES);
    $subject = htmlspecialchars(trim($_POST["subject"]), ENT_QUOTES);
    $message = htmlspecialchars(trim($_POST["message"]), ENT_QUOTES);

    // === VÉRIFICATION HONEYPOT ===
    if (!empty($_POST['website'])) {
        $statsFile = dirname(__DIR__, 3) . '/private/blockedStats.json';
        $stats = json_decode(file_get_contents($statsFile), true);
        $stats['spam']++;
        file_put_contents($statsFile, json_encode($stats));
        header('Location: ' . url('/contact'));
        exit;
    }

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['contact_error'] = "Tous les champs sont obligatoires.";
        header('Location: ' . url('/contact'));
        exit;
    }

    $spamAnalysis = $antiSpam->analyzeContent($name, $email, $subject, $message);
    if ($spamAnalysis['isSpam']) {
        $statsFile = dirname(__DIR__, 3) . '/private/blockedStats.json';
        $stats = json_decode(file_get_contents($statsFile), true);
        $stats['spam']++;
        file_put_contents($statsFile, json_encode($stats));
        $_SESSION['contact_error'] = "Votre message n'a pas pu être envoyé. Veuillez vérifier son contenu.";
        header('Location: ' . url('/contact'));
        exit;
    }

    $contactModel = new ContactModel();
    $contactModel->getInsert($bdd, $name, $email, $subject, $message);

    // === ENVOI EMAIL ===
    $subjectMail = "📩 Nouveau message reçu sur Black Hole Événements : $subject";
    $messageMail = "
    <html><body>
        <p><strong>Nom :</strong> $name</p>
        <p><strong>Email :</strong> $email</p>
        <p><strong>Objet :</strong> $subject</p>
        <p><strong>Message :</strong><br>" . nl2br($message) . "</p>
    </body></html>
    ";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'blackhole.evenements@gmail.com';
        $mail->Password   = $mail_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('blackhole.evenements@gmail.com', 'Black Hole Événements');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('blackhole.evenements@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = $subjectMail;
        $mail->Body    = $messageMail;

        $mail->send();
    } catch (Exception $e) {
        error_log("Erreur mail : " . $mail->ErrorInfo);
    }

    $_SESSION['contact_success'] = true;
    $_SESSION['contact_name'] = $name;
    header('Location: ' . url('/contact'));
    exit;
}
