<?php

require_once 'auth.php';

require_once 'config/database.php';
require_once 'models/User.php';
require_once 'controllers/UserController.php';
require_once 'controllers/GenreController.php';

$public_routes = ['login', 'loginForm', 'register', 'registerForm'];
$current_action = $_GET['action'] ?? 'index';

if (!in_array($current_action, $public_routes)) {
    verificarAutenticacion();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Libreria'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Mi Sitio</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=stock&action=index">Libros</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimiento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php?controller=genre&action=index">Géneros</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=author&action=index">Autores</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=book&action=index">Libros</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=stock&action=index">Stock</a></li>
                            <li><a class="dropdown-item" href="#">Usuarios</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="navbar-nav ms-auto">
                    <span class="nav-item nav-link text-light">
                        Bienvenido, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Usuario'); ?>
                    </span>
                    <a class="nav-item nav-link" href="index.php?action=logout">Cerrar Sesión</a>
                </div>
            </div>
            <?php else: ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="index.php?action=loginForm">Iniciar Sesión</a>
                    <a class="nav-link" href="index.php?action=registerForm">Registrarse</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </nav>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="container mt-3">
        <div class="alert alert-danger">
            <?php 
            echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']);
            ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success">
            <?php 
            echo htmlspecialchars($_SESSION['success']);
            unset($_SESSION['success']);
            ?>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>