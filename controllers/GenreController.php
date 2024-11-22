<?php
require_once 'models/Author.php';
class GenreController {
    private $genre;

    public function __construct($db) {
        $this->genre = new Genre($db);
    }

    public function index() {
        $stmt = $this->genre->leerTodos();
        require_once 'views/genre/index.php';
    }

    public function crear() {
        require_once 'views/genre/create.php';
    }

    public function store() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->genre->id_genre = $_POST['id_genre'];
            $this->genre->name = $_POST['name'];

            if($this->genre->crear()) {
                $_SESSION['success'] = "Género creado exitosamente";
                header("Location: index.php?controller=genre&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al crear el género";
                header("Location: index.php?controller=genre&action=create");
                exit;
            }
        }
    }

    public function edit() {
        if(isset($_GET['id'])) {
            $this->genre->id_genre = $_GET['id'];
            if($this->genre->leerUno()) {
                require_once 'views/genre/edit.php';
            } else {
                $_SESSION['error'] = "Género no encontrado";
                header("Location: index.php?controller=genre&action=index");
                exit;
            }
        }
    }
    public function actualizar() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->genre->id_genre = $_POST['id_genre'];
            $this->genre->name = $_POST['name'];

            if($this->genre->actualizar()) {
                $_SESSION['success'] = "Género actualizado exitosamente";
                header("Location: index.php?controller=genre&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al actualizar el género";
                header("Location: index.php?controller=genre&action=edit&id=" . $this->genre->id_genre);
                exit;
            }
        }
    }

    public function eliminar() {
        if(isset($_GET['id'])) {
            $this->genre->id_genre = $_GET['id'];
            if($this->genre->eliminar()) {
                $_SESSION['success'] = "Género eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el género";
            }
            header("Location: index.php?controller=genre&action=index");
            exit;
        }
    }
}