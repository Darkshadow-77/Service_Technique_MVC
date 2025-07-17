<?php
// Pas de session_start ici, géré par le contrôleur si besoin
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - T-Service</title>
    <link rel="icon" type="image/jpeg" href="./assets/img/logo.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/media_queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php require_once(__DIR__.'/partials/header.php'); ?>
    <main class="ins_pcp_box">
        <form action="./index.php?page=inscription" method="post" class="ins_form">
            <div>
            <label for="prenom">Nom :</label><br>
            <input type="text" name="surname" id="nom" class="field" oninput="this.value = this.value.toUpperCase();" required placeholder="DUPONT"><br>  
            </div>
            <div>
            <label for="prenom">Prenom :</label><br>
            <input type="text" name="firstname" id="prenom" class="field" oninput="capitalizeFirstLetter(this)" required placeholder="Albert"><br>
            </div>
            <div>
            <label for="email">Email :</label><br>
            <input type="email" name="email" id="email" class="field" required placeholder="Albertdupont90@gmail.com"><br>
            </div>
            <div>
            <label for="password">Mot de passe :</label><br>
            <div class="pass"><input type="password" name="password" id="password" class="field" required><i class="fa-solid fa-eye eye" onclick="togglePassword()"></i></div>
            </div>
            <div>
            <label for="domain">Domaine :</label><br>
            <select name="domain" id="domain" class="field" required placeholder="none">
                <option value="Assistance Technique">Assistance Technique/Informatique</option>
                <option value="Service Réseau">Services Réseaux</option>
                <option value="Service Automobile">Service Automobile</option>
                <option value="Particulier">Particulier</option>
            </select>
            </div>
            <button type="submit" class="btn_sub">S'inscrire</button>
            <?php if (!empty($message)) { echo "<p style='color: red;'>$message</p>"; } ?>
        </form>
        <div class="log_or_sign">
            <p>Déjà inscrit ?</p>
            <a href="./index.php?page=connexion" >Se connecter</a>
        </div>
    </main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
    
    <script>
    // Vider le formulaire après soumission réussie
    <?php if (isset($_SESSION['form_success']) && $_SESSION['form_success']): ?>
        document.addEventListener('DOMContentLoaded', function() {
            // Vider tous les champs du formulaire
            document.getElementById('nom').value = '';
            document.getElementById('prenom').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            document.getElementById('domain').selectedIndex = 0;
        });
        <?php unset($_SESSION['form_success']); ?>
    <?php endif; ?>
    </script>
</body>
<script>
function capitalizeFirstLetter(input) {
    const value = input.value;
    input.value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
}
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