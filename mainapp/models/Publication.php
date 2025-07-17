<?php
class Publication {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function create($data, $files) {
        if (empty($data['nom']) || empty($data['description'])) {
            return "Tous les champs sont obligatoires.";
        }
        if (!isset($files['img']) || $files['img']['error'] !== UPLOAD_ERR_OK) {
            return "Erreur lors de l'upload de l'image.";
        }
        $imgName = uniqid().basename($files['img']['name']);
        $imgPath = __DIR__.'/../assets/uploads/'.$imgName;
        if (!move_uploaded_file($files['img']['tmp_name'], $imgPath)) {
            return "Impossible de sauvegarder l'image.";
        }
        $stmt = $this->db->prepare("INSERT INTO publications (nom, description, img, date_publication) VALUES (?, ?, ?, NOW())");
        $ok = $stmt->execute([
            $data['nom'],
            $data['description'],
            $imgName
        ]);
        if ($ok) {
            return true;
        } else {
            return "Erreur lors de l'enregistrement de la publication.";
        }
    }
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM publications ORDER BY date_publication DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        // Get a publication by ID (to complete)
    }
} 