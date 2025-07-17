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
    <title>Publications - T-Service</title>
    <link rel="icon" type="image/jpeg" href="./assets/img/logo.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/media_queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php require_once(__DIR__.'/partials/header.php'); ?>
    <main class="ins_pcp_box">
    <h1>Publier un nouveau service</h1>
      <!-- Formulaire de publication -->
        <section>
            <form action="./index.php?page=publication" method="POST" enctype="multipart/form-data">
                <input type="text" name="nom" placeholder="Titre du service/article" required><br><br>
                <textarea name="description" placeholder="Description..." rows="5" required></textarea><br><br>
                <label for="img">Sélectionner une image :</label><br>
                <input type="file" name="img" accept="image/*" id="img" required><br><br>
            <!-- Preview Box -->
            <div class="preview-box" id="preview-box">
                <p>Prévisualisation de l'image :</p>
                <img id="preview-img" src="" alt="Aucune image sélectionnée">
                <span id="file-name"></span>
            </div>
                <button type="submit" class="btn_cta">Publier</button>
                <?php if (!empty($message)) { echo $message; } ?>
            </form>
        </section>
    </main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
    
    <script>
    // Vider le formulaire après soumission réussie
    <?php if (isset($_SESSION['form_success']) && $_SESSION['form_success']): ?>
        document.addEventListener('DOMContentLoaded', function() {
            // Vider tous les champs du formulaire
            document.querySelector('input[name="nom"]').value = '';
            document.querySelector('textarea[name="description"]').value = '';
            document.querySelector('input[type="file"]').value = '';
            // Vider la prévisualisation
            const previewBox = document.querySelector('.preview-box');
            if (previewBox) {
                previewBox.innerHTML = '<p>Prévisualisation de l\'image :</p><img id="preview-img" src="" alt="Aucune image sélectionnée"><span id="file-name"></span>';
                previewBox.style.display = 'none';
            }
        });
        <?php unset($_SESSION['form_success']); ?>
    <?php endif; ?>
    </script>
    <script>
       document.querySelector('input[type="file"]').addEventListener('change', function(event) {
    const previewBox = document.querySelector('.preview-box');
    const file = event.target.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        previewBox.innerHTML = ''; // Clear the preview box
        previewBox.appendChild(img);
        previewBox.style.display = 'block'; // Show the preview box
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});
    </script>
</body>
</html>
