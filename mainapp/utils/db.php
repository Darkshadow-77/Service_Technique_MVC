<?php
// Fichier de configuration centralisé pour la connexion à la base de données

define('DB_HOST', 'localhost');
define('DB_NAME', 't-service');
define('DB_USER', 'root');
define('DB_PASS', '');

function getPDO() {
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
} 