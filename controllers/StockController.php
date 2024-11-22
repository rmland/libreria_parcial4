<?php

require_once 'models/Stock.php';
class StockController
{
    private $stock;

    private $books;
    public function __construct($db)
    {
        $this->stock = new Stock($db);
        $this->books = new Book($db);
    }

    public function index()
    {
        $stmt = $this->stock->leerTodos();
        require_once 'views/stock/index.php';
    }

    public function crear()
    {
        $stmt_genres = $this->books->leerTodos();
        $books = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/stock/create.php';
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->stock->id_book = $_POST['id_book'];
            $this->stock->total_stock = $_POST['total_stock'];
            $this->stock->notes = $_POST['notes'];
            $this->stock->last_inventory = $_POST['last_inventory'];

            if ($this->stock->crear()) {
                $_SESSION['success'] = "Stock creado exitosamente";
                header("Location: index.php?controller=stock&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al crear el stock";
                header("Location: index.php?controller=stock&action=create");
                exit;
            }
        }
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $this->stock->id_stock = $_GET['id'];
            if ($this->stock->leerUno()) {
                $stmt_genres = $this->books->leerTodos();
                $books = $stmt_genres->fetchAll(PDO::FETCH_ASSOC);
                require_once 'views/stock/edit.php';
            } else {
                $_SESSION['error'] = "Stock no encontrado";
                header("Location: index.php?controller=stock&action=index");
                exit;
            }
        }
    }

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->stock->id_stock = $_POST['id_stock'];
            $this->stock->id_book = $_POST['id_book'];
            $this->stock->total_stock = $_POST['total_stock'];
            $this->stock->notes = $_POST['notes'];
            $this->stock->last_inventory = $_POST['last_inventory'];

            if ($this->stock->actualizar()) {
                $_SESSION['success'] = "Stock actualizado exitosamente";
                header("Location: index.php?controller=stock&action=index");
                exit;
            } else {
                $_SESSION['error'] = "Error al actualizar el stock";
                header("Location: index.php?controller=stock&action=edit&id=" . $this->stock->id_stock);
                exit;
            }
        }
    }

    public function eliminar()
    {
        if (isset($_GET['id'])) {
            $this->stock->id_stock = $_GET['id'];
            if ($this->stock->eliminar()) {
                $_SESSION['success'] = "Stock eliminado exitosamente";
            } else {
                $_SESSION['error'] = "Error al eliminar el stock";
            }
            header("Location: index.php?controller=stock&action=index");
            exit;
        }
    }
}
