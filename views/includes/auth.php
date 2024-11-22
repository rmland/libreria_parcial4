<?php

function verificarAutenticacion()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Debe iniciar sesión para acceder a esta página";
        header("Location: index.php?action=loginForm");
        exit;
    }

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {

        session_unset();
        session_destroy();
        $_SESSION['error'] = "Su sesión ha expirado por inactividad";
        header("Location: index.php?action=loginForm");
        exit;
    }
    $_SESSION['last_activity'] = time();
    if (!isset($_SESSION['last_regeneration']) || (time() - $_SESSION['last_regeneration'] > 1800)) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
