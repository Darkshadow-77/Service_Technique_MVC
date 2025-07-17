<?php
require_once __DIR__.'/../utils/session_helper.php';
if (!safe_session_start()) {
    handle_session_error();
    exit;
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 't-service';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    setErreur("Connexion à la base de données échouée : " . $e->getMessage());
}

// Vérification des champs
if (
    isset($_POST['email'], $_POST['password']) &&
    !empty($_POST['email']) &&
    !empty($_POST['password'])
) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_info'] = [
                'id' => $user['id'],
                'surname' => $user['surname'],
                'firstname' => $user['firstname'],
                'email' => $user['email'],
                'domain' => $user['domain']
            ];
            header("Location: ../../index.php");
            exit;
        } else {
            setErreur("Email ou mot de passe incorrect.");
        }

    } catch (PDOException $e) {
        setErreur("Erreur lors de la connexion : " . $e->getMessage());
    }
} else {
    setErreur("Tous les champs sont requis.");
}

// Fonction en cas d’erreur
function setErreur($message) {
    $_SESSION['erreur'] = $message;
    header("Location: ../connexion.php");
    exit;
}
