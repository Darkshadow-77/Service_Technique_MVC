<?php
// Pas de session_start ici, géré par le contrôleur si besoin
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - T-Service</title>
    <link rel="icon" type="image/jpeg" href="./assets/img/logo.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/media_queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php require_once(__DIR__.'/partials/header.php'); ?>
    <main class="ins_pcp_box">
        <form action="./index.php?page=connexion" method="post" class="ins_form">
            <div>
                <label for="email">Email :</label><br>
                <input type="email" name="email" id="email" class="field" required placeholder="votremail@exemple.com"><br>
            </div>
            <div>
                <label for="password">Mot de passe :</label><br>
                <div class="pass">
                    <input type="password" name="password" id="password" class="field" required>
                    <i class="fa-solid fa-eye eye" onclick="togglePassword()"></i>
                </div>
            </div>
            <button type="submit" class="btn_sub">Se connecter</button>
            <?php if (!empty($message)) { echo "<p style='color: red;'>$message</p>"; } ?>
        </form>
        <div class="log_or_sign">
            <p>Pas encore inscrit ?</p>
            <a href="./index.php?page=inscription">Créer un compte</a>
        </div>
    </main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
</body>
<script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const eyeIcon = document.querySelector(".fa-solid");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
</script>
</html>
