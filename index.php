<?php
define('BASE_PATH', __DIR__);
session_start();

require_once 'config/database.php';
require_once 'models/User.php';
require_once 'models/Genre.php';
require_once 'controllers/UserController.php';
require_once 'controllers/GenreController.php';
require_once 'controllers/AuthorController.php';
require_once 'controllers/BookController.php';
require_once 'controllers/StockController.php';

include(BASE_PATH . '/views/includes/header.php');

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);
$genreController = new GenreController($db);
$authorController = new AuthorController($db);
$bookController = new BookController($db);
$stockController = new StockController($db);


$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

$public_routes = ['loginForm', 'login', 'registerForm', 'register'];

if (!in_array($action, $public_routes)) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Debe iniciar sesión para acceder a esta página";
        header("Location: index.php?action=loginForm");
        exit;
    }
}

switch ($controller) {
    case 'genre':
        switch ($action) {
            case 'index':
                $genreController->index();
                break;
            case 'create':
                $genreController->crear();
                break;
            case 'store':
                $genreController->store();
                break;
            case 'edit':
                $genreController->edit();
                break;
            case 'update':
                $genreController->actualizar();
                break;
            case 'delete':
                $genreController->eliminar();
                break;
            default:
                $genreController->index();
                break;
        }
        break;
    case 'author':
        switch ($action) {
            case 'index':
                $authorController->index();
                break;
            case 'create':
                $authorController->crear();
                break;
            case 'store':
                $authorController->store();
                break;
            case 'edit':
                $authorController->edit();
                break;
            case 'update':
                $authorController->actualizar();
                break;
            case 'delete':
                $authorController->eliminar();
                break;
            default:
                $authorController->index();
                break;
        }
        break;
    case 'book':
        switch ($action) {
            case 'index':
                $bookController->index();
                break;
            case 'create':
                $bookController->crear();
                break;
            case 'store':
                $bookController->store();
                break;
            case 'edit':
                $bookController->edit();
                break;
            case 'update':
                $bookController->actualizar();
                break;
            case 'delete':
                $bookController->eliminar();
                break;
            default:
                $bookController->index();
                break;
        }
        break;
    case 'stock':
        switch ($action) {
            case 'index':
                $stockController->index();
                break;
            case 'create':
                $stockController->crear();
                break;
            case 'store':
                $stockController->store();
                break;
            case 'edit':
                $stockController->edit();
                break;
            case 'update':
                $stockController->actualizar();
                break;
            case 'delete':
                $stockController->eliminar();
                break;
            default:
                $stockController->index();
                break;
        }
        break;
    default:
        switch ($action) {
            case 'loginForm':
                require_once 'views/login.php';
                break;
            case 'login':
                $userController->login();
                break;
            case 'registerForm':
                require_once 'views/register.php';
                break;
            case 'register':
                $userController->register();
                break;
            case 'dashboard':
                require_once 'views/dashboard.php';
                break;
            case 'logout':
                $userController->logout();
                break;
            default:
                require_once 'views/login.php';
                break;
        }
        break;
}
