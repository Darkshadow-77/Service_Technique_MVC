<?php
class User {
    // Example of database connection (to adapt)
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function register($data) {
        // Check required fields
        if (empty($data['surname']) || empty($data['firstname']) || empty($data['email']) || empty($data['password']) || empty($data['domain'])) {
            return "Tous les champs sont obligatoires.";
        }
        // Check if email already exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$data['email']]);
        if ($stmt->fetch()) {
            return "Cet email est déjà utilisé.";
        }
        // Insert user
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (surname, firstname, email, password, domain) VALUES (?, ?, ?, ?, ?)");
        $ok = $stmt->execute([
            $data['surname'],
            $data['firstname'],
            $data['email'],
            $hash,
            $data['domain']
        ]);
        if ($ok) {
            return true;
        } else {
            return "Erreur lors de l'inscription.";
        }
    }
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return "Email ou mot de passe incorrect.";
        }
    }
    public function getById($id) {
        // Get a user by ID (to complete)
    }
} 