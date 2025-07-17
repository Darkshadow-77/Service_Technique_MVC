<?php
class ContactController {
    public function show() {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
                $message = "Tous les champs sont obligatoires.";
            } else {
                $db = new PDO('mysql:host=localhost;dbname=t-service', 'root', '');
                $stmt = $db->prepare("INSERT INTO messages (nom, email, message) VALUES (?, ?, ?)");
                $ok = $stmt->execute([
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['message']
                ]);
                if ($ok) {
                    $message = "Merci pour votre message ! Nous vous répondrons rapidement.";
                    $_SESSION['form_success'] = true;
                } else {
                    $message = "Erreur lors de l'envoi du message.";
                }
            }
        }
        require __DIR__.'/../views/contact.php';
    }
} 