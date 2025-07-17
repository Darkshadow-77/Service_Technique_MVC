<?php
require_once __DIR__.'/../utils/db.php';
try {
    $pdo = getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT* FROM services";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - T-Service</title>
    <link rel="icon" type="image/jpeg" href="./assets/img/logo.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/media_queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php require_once(__DIR__.'/partials/header.php'); ?>
    <main class="pcp_spg_box">
        <h1 class="tre_pg_srv">
            <span>🔧 Nos Services ⚙️</span>
        </h1>
        <?php if (!empty($result)) : foreach($result as $service): ?>
        <section class="srv_pr_bcp">
            <div class="srv_des_box">
            <h2 class="tre_srv"><?= htmlspecialchars($service['nom']) ?></h2>
            <p class="des_srv"><?= htmlspecialchars($service['description']) ?></p>
            <button class="apply">Souscrire</button>
            </div>
            <img src="./assets/img/<?= htmlspecialchars($service['img']) ?>" alt="<?= htmlspecialchars($service['nom']) ?>" class="img_srv">
        </section>
        <?php endforeach; else: ?>
            <p>Aucun service disponible pour le moment.</p>
        <?php endif; ?>
    </main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
</body>
</html>