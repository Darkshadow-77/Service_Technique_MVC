<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Clear the success message
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); // Clear the error message
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
    <main class="main_pub_ctn">
        <h1>📰 Nos Publications</h1>
        <p>Découvrez nos dernières publications sur les services que nous proposons.</p>
        <?php if (!empty($message)) { echo $message; } ?>
        <section class="invit_a_publi">
            <div class="invit">
                <h2>Vous pouvez publier vous-même ici 👉<a href="./index.php?page=publication">Publier</a></h2>
            </div>
        </section>
        <section class="publi_liste">
            <h2>📋 Dernières publications</h2>
        <div class="list_content">
            <?php if (!empty($publications)) : foreach ($publications as $pub): ?>
                <div class="pub">
                    <h3><?= htmlspecialchars($pub['nom']) ?></h3>
                    <img src="./assets/uploads/<?= htmlspecialchars($pub['img']) ?>" alt="Image" style="width: 300px;"><br>
                    <p><?= nl2br(htmlspecialchars($pub['description'])) ?></p>
                    <p><em>Publié le : <?= date('d M Y, H:i', strtotime($pub['date_publication'])) ?></em></p>
                </div>
            <?php endforeach; else: ?>
                <p>Aucune publication pour le moment.</p>
            <?php endif; ?>
        </div>
        </section>
    </main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
</body>
</html>
