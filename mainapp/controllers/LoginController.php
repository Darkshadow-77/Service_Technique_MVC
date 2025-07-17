<?php
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/db.php';
class LoginController {
    public function login() {
        session_start();
        $db = getPDO();
        $user = new User($db);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $user->login($_POST['email'], $_POST['password']);
            if (is_array($result) && isset($result['id'])) {
                $_SESSION['user_id'] = $result['id'];
                $message = "Connexion réussie !";
                // Redirection possible ici
            } else {
                $message = $result;
            }
        }
        require __DIR__.'/../views/connexion.php';
    }
} 