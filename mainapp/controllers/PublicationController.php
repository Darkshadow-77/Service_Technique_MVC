<?php
require_once __DIR__.'/../models/Publication.php';
require_once __DIR__.'/../utils/db.php';
class PublicationController {
    public function list() {
        $db = getPDO();
        $publication = new Publication($db);
        $publications = $publication->getAll();
        $message = '';
        require __DIR__.'/../views/publications_liste.php';
    }
    public function publish() {
        require_once __DIR__.'/../utils/session_helper.php';
        if (!safe_session_start()) {
            handle_session_error();
            exit;
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=connexion');
            exit;
        }
        $db = getPDO();
        $publication = new Publication($db);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $publication->create($_POST, $_FILES);
            if ($result === true) {
                $message = "Publication enregistrée avec succès !";
                $_SESSION['form_success'] = true;
            } else {
                $message = $result;
            }
        }
        require __DIR__.'/../views/publication.php';
    }
} 