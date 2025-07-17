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
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier que les champs existent et ne sont pas vides
if (
    isset($_POST['nom'], $_POST['description'], $_FILES['img']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['description']) &&
    !empty($_FILES['img']['name'])
) {
    // Sécurisation des données
    $nom = htmlspecialchars(trim($_POST['nom']));
    $description = htmlspecialchars(trim($_POST['description']));

    // Traitement de l'image téléchargée
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];
    $imgError = $_FILES['img']['error'];

    // Vérifier les erreurs d'upload
    if ($imgError === 0) {
        // Vérification du type de fichier (image)
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imgExt, $validExtensions)) {
            // Générer un nom unique pour l'image
            $newImgName = uniqid('', true) . "." . $imgExt;
            $imgDestination = '../../uploads/'.$newImgName;

            // Déplacer l'image téléchargée dans le dossier "uploads"
            if (move_uploaded_file($imgTmpName, $imgDestination)) {
                // Insertion dans la base de données
                $stmt = $pdo->prepare("INSERT INTO publications (nom, description, img) 
                                       VALUES (:nom, :description, :img)");
                $stmt->execute([
                    ':nom' => $nom,
                    ':description' => $description,
                    ':img' => $imgDestination
                ]);

                // Message de succès et redirection
                $_SESSION['success'] = "Le service a été publié avec succès !";
                header("Location: ../publications_liste.php");
                exit;
            } else {
                echo "Une erreur est survenue lors de l'upload de l'image :".$_FILES['img']['error'];
                /*header("Location: ../publication.php");
                exit;*/
            }
        } else {
            $_SESSION['error'] = "Le type de fichier n'est pas autorisé. Veuillez télécharger une image (jpg, jpeg, png, gif).";
            header("Location: ../publication.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de l'upload de l'image.";
        header("Location: ../publication.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header("Location: ../publication.php");
    exit;
}
?>
