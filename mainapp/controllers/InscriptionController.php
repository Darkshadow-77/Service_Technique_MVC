<?php
require_once __DIR__.'/../models/User.php';
class RegistrationController {
    public function register() {
        require_once __DIR__.'/../utils/session_helper.php';
        if (!safe_session_start()) {
            handle_session_error();
            exit;
        }
        $db = new PDO('mysql:host=localhost;dbname=service_technique', 'root', '');
        $user = new User($db);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $user->register($_POST);
            if ($result === true) {
                // Auto-login after registration
                $loggedUser = $user->login($_POST['email'], $_POST['password']);
                if (is_array($loggedUser) && isset($loggedUser['id'])) {
                    $_SESSION['user_id'] = $loggedUser['id'];
                }
                $message = "Inscription réussie ! Vous êtes connecté.";
                $_SESSION['form_success'] = true;
            } else {
                $message = $result;
            }
        }
        require __DIR__.'/../views/inscription.php';
    }
} 