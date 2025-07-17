<?php
require_once __DIR__.'/../utils/session_helper.php';
if (!safe_session_start()) {
    handle_session_error();
    exit;
}

// Connexion PDO sécurisée
$host = 'localhost';
$dbname = 't-service';
$user = 'root'; 
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    setErreur("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifie que les champs existent et ne sont pas vides
if (
    isset($_POST['surname'], $_POST['firstname'], $_POST['email'], $_POST['password'], $_POST['domain']) &&
    !empty($_POST['surname']) &&
    !empty($_POST['firstname']) &&
    !empty($_POST['email']) &&
    !empty($_POST['password']) &&
    !empty($_POST['domain'])
) {
    // Sécurisation des données
    $surname = htmlspecialchars(trim($_POST['surname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $domain = htmlspecialchars(trim($_POST['domain']));

    try {
        // Vérifie si l'email existe déjà
        $verif = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $verif->execute([':email' => $email]);
        if ($verif->fetchColumn() > 0) {
            setErreur("Cet email est déjà utilisé.");
        }

        // Insertion dans la base
        $stmt = $pdo->prepare("INSERT INTO users (surname, firstname, email, password, domain) 
                               VALUES (:surname, :firstname, :email, :password, :domain)");
        $stmt->execute([
            ':surname' => $surname,
            ':firstname' => $firstname,
            ':email' => $email,
            ':password' => $password,
            ':domain' => $domain
        ]);

    } catch (PDOException $e) {
        setErreur("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
} else {
    setErreur("Tous les champs sont obligatoires.");
}

// Fonction d'enregistrement de l'erreur et redirection
function setErreur($message) {
    $_SESSION['erreur'] = $message;
    header("Location: ../inscription.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription résussie</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body class="ins_pcp_box" style="margin-top:300px;">
    <h1 style="color:white;">Inscription réussie</h1>
    <p style="color:white;">Bienvenue, <?php echo htmlspecialchars($_POST['firstname']); ?> !</p>
    <button class="btn_cta"><a href="../../index.php">Se connecter automatiquement</a></button>
    
</body>
</html>