<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = $_POST["password"];

            if(empty($username) || empty($password)) {
                $_SESSION['error'] = "Todos los campos son requeridos";
                header("Location: index.php?action=loginForm");
                exit;
            }

            $result = $this->user->login($username, $password);

            if($result !== false) { 
                session_start();
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['nombre'];
                if(!isset($_SESSION['user_id'])) {
                    $_SESSION['error'] = "Error al iniciar sesión";
                    header("Location: index.php?action=loginForm");
                    exit;
                }

                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
                header("Location: index.php?action=loginForm");
                exit;
            }
        }
    }
    public function register() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            if(empty($username) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = "Todos los campos son requeridos";
                header("Location: index.php?action=registerForm");
                exit;
            }

            if($password !== $confirm_password) {
                $_SESSION['error'] = "Las contraseñas no coinciden";
                header("Location: index.php?action=registerForm");
                exit;
            }

            if($this->user->create($username, $password)) {
                $_SESSION['success'] = "Registro exitoso. Por favor inicia sesión.";
                header("Location: index.php?action=loginForm");
                exit;
            } else {
                $_SESSION['error'] = "Error al registrar el usuario";
                header("Location: index.php?action=registerForm");
                exit;
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=loginForm");
        exit;
    }
}