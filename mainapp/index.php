<?php
// Simple MVC router
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'inscription':
        require_once 'controllers/RegistrationController.php';
        $controller = new RegistrationController();
        $controller->register();
        break;
    case 'connexion':
        require_once 'controllers/LoginController.php';
        $controller = new LoginController();
        $controller->login();
        break;
    case 'logout':
        require_once 'controllers/LogoutController.php';
        $controller = new LogoutController();
        $controller->logout();
        break;
    case 'publications':
        require_once 'controllers/PublicationController.php';
        $controller = new PublicationController();
        $controller->list();
        break;
    case 'publication':
        require_once 'controllers/PublicationController.php';
        $controller = new PublicationController();
        $controller->publish();
        break;
    case 'services':
        require_once 'controllers/ServiceController.php';
        $controller = new ServiceController();
        $controller->list();
        break;
    case 'contact':
        require_once 'controllers/ContactController.php';
        $controller = new ContactController();
        $controller->show();
        break;
    case 'apropos':
        require_once 'controllers/AboutController.php';
        $controller = new AboutController();
        $controller->show();
        break;
    default:
        require_once 'views/accueil.php';
        break;
}
