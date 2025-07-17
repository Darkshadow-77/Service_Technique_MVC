<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - T-Service</title>
    <link rel="icon" type="image/jpeg" href="./assets/img/logo.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/media_queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php require_once(__DIR__.'/partials/header.php'); ?>
    <main class="sect_princ">
        <section class="accueil">
            <h1 class="titre_princ">
                Bienvenue sur <br>
                <span class="titre_acceuil">T-Service</span>
            </h1>
            <p class="txt_princ">Votre service Technique Informatique,<br> Réseaux et Automobile disponible h24</p>
            <a href="./index.php?page=services"><button class="btn_dec_pls">Découvrir nos services</button></a>
        </section>
        <section class="description">
            <h2 class="titre_des">💻🔧🚗 Qui sommes-nous ?</h2>
            <div class="des_box">
                <p class="text_des">
                    Nous sommes une entreprise spécialisée dans le support technique en informatique, réseaux et automobile. Grâce à notre expertise, nous offrons des solutions innovantes pour garantir le bon fonctionnement de vos systèmes informatiques, de vos infrastructures réseau et de vos équipements automobiles connectés.
                </p>
            </div>
            <img src="./assets/img/fond_description.jpeg" alt="Description" class="img_des">
            <a href="./index.php?page=apropos"><button class="btn_cta">À propos de nous</button></a>
        </section>
        <section class="contact">
            <h2 class="titre_contact">Besoin d’aide ? Une question ? <br> Un avis à partager ?</h2>
            <div class="des_box">
                <p class="text_contact">
                    Chez T-Service, votre satisfaction est notre priorité ! Que ce soit pour une assistance technique, un conseil, une demande d’intervention ou simplement pour partager votre avis, nous sommes à votre écoute.
                </p>
            </div>
            <img src="./assets/img/fond_contact.jpeg" alt="Contact" class="img_contact">
            <a href="./index.php?page=contact"><button class="btn_dec_pls">Contactez-nous</button></a>
        </section>
        <section class="services">
            <h2 class="titre_srv">Visitez nos différents Services</h2>
            <div class="srv_pcp_box">
                <div class="srv_box">
                    <img src="./assets/img/auto_service.jpeg" alt="Service Automobile" class="srv_img">
                    <p class="nom_service">Service Automobile</p>
                    <a href="./index.php?page=services"><button class="visit">Visiter</button></a>
                </div>
                <div class="srv_box">
                    <img src="./assets/img/assistance_service.jpeg" alt="Assistance technique" class="srv_img">
                    <p class="nom_service">Assistance technique</p>
                    <a href="./index.php?page=services"><button class="visit">Visiter</button></a>
                </div>
                <div class="srv_box">
                    <img src="./assets/img/network_service.jpeg" alt="Service Réseaux" class="srv_img">
                    <p class="nom_service">Services Réseaux</p>
                    <a href="./index.php?page=services"><button class="visit">Visiter</button></a>
                </div>
            </div>
        </section>
    </main>
    <?php require_once(__DIR__.'/partials/footer.php'); ?>
</body>
</html> 