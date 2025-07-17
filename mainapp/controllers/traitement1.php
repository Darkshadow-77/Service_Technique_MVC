<?php
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
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification des données POST
if (
    isset($_POST['name'], $_POST['email'], $_POST['message']) &&
    !empty($_POST['name']) &&
    !empty($_POST['email']) &&
    !empty($_POST['message'])
) {
    // Nettoyage des données
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    try {
        // Insertion du message dans la base
        $stmt = $pdo->prepare("INSERT INTO messages (nom, email, message, date) 
                               VALUES (:nom, :email, :message, NOW())");
        $stmt->execute([
            ':nom' => $name,
            ':email' => $email,
            ':message' => $message
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
    header("Location: ../contact.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message envoyé</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body class="ins_pcp_box" style="margin-top:300px;">
    <h1 style="color:white;">Votre message a èté envoyé avec succès</h1>
    <button class="btn_cta"><a href="../../index.php">Retourner à l'accueil</a></button>
</body>
</html>
