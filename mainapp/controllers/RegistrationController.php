<?php
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/db.php';
class RegistrationController {
    public function register() {
        session_start();
        $db = getPDO();
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
            } else {
                $message = $result;
            }
        }
        require __DIR__.'/../views/inscription.php';
    }
} 