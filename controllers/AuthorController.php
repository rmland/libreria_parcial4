<?php
class AuthorController {
    private $author;

    public function __construct($db) {
        $this->author = new Author($db);
    }
    public function index() {
        $stmt = $this->author->leerTodos();
        require_once 'views/author/index.php';
    }
    public function crear() {
        require_once 'views/author/create.php';
    }
    public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->author->full_name = $_POST['full_name'];
            $this->author->date_of_birth = $_POST['date_of_birth'];
            $this->author->date_of_death = $_POST['date_of_death'];

            if ($this->author->crear()) {
                $_SESSION['success'] = "Autor creado exitosamente";
                header("Location: index.php?controller=author&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al crear el autor";
                header("Location: index.php?controller=author&action=create");
                exit;
            }
        }
    }
    public function edit() {
        if (isset($_GET['id'])) {
            $this->author->id_author = $_GET['id'];
            if ($this->author->leerUno()) {
                require_once 'views/author/edit.php';
            } else {
                $_SESSION['error'] = "Autor no encontrado";
                header("Location: index.php?controller=author&action=index");
                exit;
            }
        }
    }
    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->author->id_author = $_POST['id_author'];
            $this->author->full_name = $_POST['full_name'];
            $this->author->date_of_birth = $_POST['date_of_birth'];
            $this->author->date_of_death = $_POST['date_of_death'];

            if ($this->author->actualizar()) {
                $_SESSION['success'] = "Autor actualizado exitosamente";
                header("Location: index.php?controller=author&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al actualizar el autor";
                header("Location: index.php?controller=author&action=edit&id=" . $this->author->id_author);
                exit;
            }
        }
    }
    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->author->id_author = $_GET['id'];
            if ($this->author->eliminar()) {
                $_SESSION['success'] = "Autor eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el autor";
            }
            header("Location: index.php?controller=author&action=index");
            exit;
        }
    }
}
?>
