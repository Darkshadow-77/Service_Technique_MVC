<?php
require_once __DIR__.'/../utils/session_helper.php';
if (!safe_session_start()) {
    handle_session_error();
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Service Technique</title>
    <link rel="icon" type="image/jpeg" href="./assets/img/logo.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/media_queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php require_once(__DIR__.'/partials/header.php'); ?>
<main class="ctn_main">
    <div class="container_contact">
    <?php if (!empty($message)) { echo $message; } ?>
        <section class="form_message">
            <h2>Laissez-nous un message</h2>
            <form action="./index.php?page=contact" method="post">
                <div class="form_group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form_group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div class="form_group">
                    <button type="submit" class="btn_send_message">Envoyer</button>
                </div>
            </form>
        </section>
        <section class="info_entreprise">
            <h2>Autres canaux de contact</h2>
            <p>Vous pouvez toujours nous joindre via nos coordonnées ci-dessous.</p>
            <p><i class="fa-solid fa-location-dot"> </i> <strong>Adresse:</strong> 123 Rue des Services, 75000 Lomé, Togo</p>
            <p><i class="fa-solid fa-envelope"> </i> <strong>Email:</strong> contact@servicetech.com</p>
            <p><i class="fa-solid fa-phone"> </i> <strong>Téléphone:</strong> +228 93 14 65 65</p>
        </section>
    </div>
</main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
    
    <script>
    // Vider le formulaire après soumission réussie
    <?php if (isset($_SESSION['form_success']) && $_SESSION['form_success']): ?>
        document.addEventListener('DOMContentLoaded', function() {
            // Vider tous les champs du formulaire
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('message').value = '';
        });
        <?php unset($_SESSION['form_success']); ?>
    <?php endif; ?>
    </script>
</body>
</html>
