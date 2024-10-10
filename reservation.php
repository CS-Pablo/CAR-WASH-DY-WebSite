<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Si installé via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $service = htmlspecialchars($_POST['service']);
    $date = htmlspecialchars($_POST['date']);
    $message = htmlspecialchars($_POST['message']);

    // Créer une instance de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'tonemail@gmail.com'; // Ton email Gmail
        $mail->Password = 'tonmotdepasse'; // Ton mot de passe Gmail (ou mot de passe d'application)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Destinataire
        $mail->setFrom('tonemail@gmail.com', 'CAR WASH D-Y');
        $mail->addAddress('destinataire@example.com', 'Toi'); // Remplace par ton email de réception

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Nouvelle réservation pour CAR WASH D-Y';
        $mail->Body = "
            <h2>Détails de la réservation</h2>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Téléphone :</strong> $phone</p>
            <p><strong>Service :</strong> $service</p>
            <p><strong>Date :</strong> $date</p>
            <p><strong>Message :</strong> $message</p>
        ";

        $mail->send();
        echo 'Réservation envoyée avec succès !';
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
    }
}
?>
