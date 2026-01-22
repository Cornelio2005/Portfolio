<?php
// IMPORTANT : Remplacez "votre-email@example.com" par votre adresse email de destination.
$destinataire = "votre-email@example.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);

    $objet = "Nouveau message de contact : " . $sujet;
    $contenu = "Nom: " . $nom . "\n";
    $contenu .= "Email: " . $email . "\n";
    $contenu .= "Téléphone: " . $telephone . "\n";
    $contenu .= "Message: \n" . $message . "\n";
    $headers = "From: " . $nom . " <" . $email . ">";

    /*
    * NOTE IMPORTANTE POUR LE DÉVELOPPEUR :
    * La fonction mail() de PHP n'est souvent pas fiable sur les serveurs de développement locaux
    * car ils ne sont généralement pas configurés pour envoyer des emails.
    *
    * Pour une solution d'envoi d'emails robuste et fiable, il est fortement recommandé
    * d'utiliser une bibliothèque comme PHPMailer ou Symfony Mailer.
    * Ces bibliothèques vous permettent d'envoyer des emails via un serveur SMTP externe
    * (comme Gmail, SendGrid, etc.), ce qui est beaucoup plus fiable.
    *
    * Exemple avec PHPMailer (vous devrez l'installer via Composer) :
    *
    * require 'vendor/autoload.php';
    * use PHPMailer\PHPMailer\PHPMailer;
    *
    * $mail = new PHPMailer(true);
    * try {
    *     // Paramètres du serveur
    *     $mail->isSMTP();
    *     $mail->Host       = 'smtp.example.com';
    *     $mail->SMTPAuth   = true;
    *     $mail->Username   = 'user@example.com';
    *     $mail->Password   = 'secret';
    *     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    *     $mail->Port       = 587;
    *
    *     // Destinataires
    *     $mail->setFrom($email, $nom);
    *     $mail->addAddress($destinataire);
    *
    *     // Contenu
    *     $mail->isHTML(false);
    *     $mail->Subject = $objet;
    *     $mail->Body    = $contenu;
    *
    *     $mail->send();
    *     echo 'Message a été envoyé';
    * } catch (Exception $e) {
    *     echo "Message n'a pas pu être envoyé. Erreur du Mailer: {$mail->ErrorInfo}";
    * }
    */

    // Envoyer l'email.
    mail($destinataire, $objet, $contenu, $headers);

    // Afficher un message de remerciement
    echo "<h1>Merci !</h1>";
    echo "<p>Votre message a été reçu. Nous vous répondrons bientôt.</p>";
    echo "<a href='Accueil.html'>Retour à l'accueil</a>";

} else {
    // Rediriger vers la page de contact si le script est accédé directement
    header("Location: Accueil.html#Contact");
    exit;
}
?>
