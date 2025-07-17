<?php
require_once __DIR__.'/../models/User.php';
class LoginController {
    public function login() {
        require_once __DIR__.'/../utils/session_helper.php';
        if (!safe_session_start()) {
            handle_session_error();
            exit;
        }
        $db = new PDO('mysql:host=localhost;dbname=service_technique', 'root', '');
        $user = new User($db);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $user->login($_POST['email'], $_POST['password']);
            if (is_array($result) && isset($result['id'])) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_info'] = $result;
                // Redirection vers l'accueil après connexion réussie
                header('Location: ./index.php');
                exit;
            } else {
                $message = $result;
            }
        }
        require __DIR__.'/../views/connexion.php';
    }
} 