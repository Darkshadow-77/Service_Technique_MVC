<?php
/**
 * Gestionnaire de session sécurisé
 * Masque les erreurs de session et affiche un message convivial
 */

function safe_session_start() {
    // Masquer les erreurs de session
    $old_error_reporting = error_reporting();
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    
    try {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        error_reporting($old_error_reporting);
        return true;
    } catch (Exception $e) {
        error_reporting($old_error_reporting);
        return false;
    }
}

function handle_session_error() {
    echo '<div style="
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        border: 2px solid #e74c3c;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        z-index: 10000;
        text-align: center;
        max-width: 400px;
        font-family: Arial, sans-serif;
    ">
        <div style="
            font-size: 48px;
            color: #e74c3c;
            margin-bottom: 20px;
        ">⚠️</div>
        <h2 style="
            color: #e74c3c;
            margin: 0 0 15px 0;
            font-size: 24px;
        ">Erreur</h2>
        <p style="
            color: #555;
            margin: 0 0 20px 0;
            line-height: 1.5;
        ">Une erreur est survenue. Veuillez recharger la page.</p>
        <button onclick="location.reload()" style="
            background: #e74c3c;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        ">Recharger la page</button>
    </div>';
}

function safe_session_destroy() {
    $old_error_reporting = error_reporting();
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    
    try {
        session_destroy();
        error_reporting($old_error_reporting);
        return true;
    } catch (Exception $e) {
        error_reporting($old_error_reporting);
        return false;
    }
}
?> 