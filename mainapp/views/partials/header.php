<?php 
require_once __DIR__.'/../../utils/session_helper.php';
if (!safe_session_start()) {
    handle_session_error();
    exit;
}
?>
<header class="bar_nav">
    <div class="logo_site"><img src="./assets/img/logo.jpeg" alt="T-Service" class="logo">
    <div class="titre_site"><h1 class="titre">T-Service</h1></div>
    </div>
        <nav class="contenu_nav">
        <button class="menu-toggle">☰</button>
            <ul class="liens_nav">
                <li><a href="./index.php" class="lien">Accueil</a></li>
                <li><a href="./index.php?page=apropos" class="lien">A propos</a></li>
                <li><a href="./index.php?page=services" class="lien">Services</a></li>
                <li><a href="./index.php?page=contact" class="lien">Contact</a></li>
                <li><a href="./index.php?page=publications" class="lien">Publications</a></li>
            </ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                // Connexion à la base pour récupérer les infos utilisateur
                $db = new PDO('mysql:host=localhost;dbname=t-service', 'root', '');
                $stmt = $db->prepare('SELECT surname, firstname, email, domain FROM users WHERE id = ?');
                $stmt->execute([$_SESSION['user_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="user-menu-container" style="position:relative;display:inline-block;">
                    <div class="user-avatar" id="userMenuBtn" style="cursor:pointer;display:flex;align-items:center;gap:8px;">
                        <span style="font-size:1.7em;vertical-align:middle;">
                            <i class="fa-solid fa-circle-user"></i>
                        </span>
                        <span style="font-weight:bold;"> <?= htmlspecialchars($user['firstname']) ?> </span>
                    </div>
                    <div class="user-dropdown" id="userDropdown" style="display:none;position:absolute;right:0;top:110%;background:#fff;border:1px solid #ccc;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);min-width:220px;z-index:1000;padding:15px;">
                        <div style="margin-bottom:10px;">
                            <strong>Nom :</strong> <?= htmlspecialchars($user['surname']) ?><br>
                            <strong>Prénom :</strong> <?= htmlspecialchars($user['firstname']) ?><br>
                            <strong>Email :</strong> <?= htmlspecialchars($user['email']) ?><br>
                            <strong>Domaine :</strong> <?= htmlspecialchars($user['domain']) ?>
                        </div>
                        <a href="./index.php?page=logout" class="btn_cta" style="display:block;text-align:center;">Déconnexion</a>
                    </div>
                </div>
                <script>
                // JS pour afficher/masquer le menu utilisateur
                document.addEventListener('DOMContentLoaded', function() {
                    var btn = document.getElementById('userMenuBtn');
                    var dropdown = document.getElementById('userDropdown');
                    btn.onclick = function(e) {
                        e.stopPropagation();
                        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                    };
                    document.addEventListener('click', function() {
                        dropdown.style.display = 'none';
                    });
                });
                </script>
            <?php else: ?>
                <a href="./index.php?page=inscription" class="btn_cta">Commencer</a>
            <?php endif; ?>
        </nav>
    </header>