<?php

require_once 'models/Book.php';
class BookController
{
    private $book;
    private $genres;
    private $authors;
    public function __construct($db)
    {
        $this->book = new Book($db);
        $this->genres = new Genre($db);
        $this->authors = new Author($db);
    }

    public function index()
    {
        $stmt = $this->book->leerTodos();

        require_once 'views/book/index.php';
    }

    public function crear()
    {
        $stmt_genres = $this->genres->leerTodos();
        $genres = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);

        $stmt_authors = $this->authors->leerTodos();
        $authors = $stmt_authors->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/book/create.php';
    }
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->book->title = $_POST['title'];
            $this->book->description = $_POST['description'];
            $this->book->year_publication = $_POST['year_publication'];
            $this->book->id_author = $_POST['id_author'];
            $this->book->id_genre = $_POST['id_genre'];

            if ($this->book->crear()) {
                $_SESSION['success'] = "Libro creado exitosamente";
                header("Location: index.php?controller=book&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al crear el libro";
                header("Location: index.php?controller=book&action=create");
                exit;
            }
        }
    }
    public function edit()
    {
        if (isset($_GET['id'])) {
            $this->book->id_book = $_GET['id'];
            if ($this->book->leerUno()) {
                $stmt_genres = $this->genres->leerTodos();
                $genres = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);
                $stmt_authors = $this->authors->leerTodos();
                $authors = $stmt_authors->fetchAll(PDO::FETCH_ASSOC);
                require_once 'views/book/edit.php';
            } else {
                $_SESSION['error'] = "Libro no encontrado";
                header("Location: index.php?controller=book&action=index");
                exit;
            }
        }
    }
    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->book->id_book = $_POST['id_book'];
            $this->book->title = $_POST['title'];
            $this->book->description = $_POST['description'];
            $this->book->year_publication = $_POST['year_publication'];
            $this->book->id_author = $_POST['id_author'];
            $this->book->id_genre = $_POST['id_genre'];

            if ($this->book->actualizar()) {
                $_SESSION['success'] = "Libro actualizado exitosamente";
                header("Location: index.php?controller=book&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al actualizar el libro";
                header("Location: index.php?controller=book&action=edit&id=" . $this->book->id_book);
                exit;
            }
        }
    }
    public function eliminar()
    {
        if (isset($_GET['id'])) {
            $this->book->id_book = $_GET['id'];
            if ($this->book->eliminar()) {
                $_SESSION['success'] = "Libro eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el libro";
            }
            header("Location: index.php?controller=book&action=index");
            exit;
        }
    }
}
