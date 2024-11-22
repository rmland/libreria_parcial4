<?php
class Stock
{
    private $conn;
    private $table_name = "stock";
    public $id_stock;
    public $id_book;
    public $total_stock;
    public $notes;
    public $last_inventory;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function crear()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET ID_BOOK = :id_book, 
                      TOTAL_STOCK = :total_stock, 
                      NOTES = :notes, 
                      LAST_INVENTORY = :last_inventory";

        $stmt = $this->conn->prepare($query);

        $this->id_book = htmlspecialchars(strip_tags($this->id_book));
        $this->total_stock = htmlspecialchars(strip_tags($this->total_stock));
        $this->notes = htmlspecialchars(strip_tags($this->notes));
        $this->last_inventory = htmlspecialchars(strip_tags($this->last_inventory));

        $stmt->bindParam(":id_book", $this->id_book);
        $stmt->bindParam(":total_stock", $this->total_stock);
        $stmt->bindParam(":notes", $this->notes);
        $stmt->bindParam(":last_inventory", $this->last_inventory);

        return $stmt->execute();
    }
    public function leerTodos()
    {
        $query = "SELECT * FROM " . $this->table_name .
            " s LEFT JOIN BOOK b ON s.ID_BOOK = b.ID_BOOK
                ORDER BY ID_STOCK";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUno()
    {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE ID_STOCK = :id_stock";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_stock", $this->id_stock);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->id_book = $row['ID_BOOK'];
            $this->total_stock = $row['TOTAL_STOCK'];
            $this->notes = $row['NOTES'];
            $this->last_inventory = $row['LAST_INVENTORY'];
            return true;
        }
        return false;
    }

    public function actualizar()
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET ID_BOOK = :id_book, 
                      TOTAL_STOCK = :total_stock, 
                      NOTES = :notes, 
                      LAST_INVENTORY = :last_inventory 
                  WHERE ID_STOCK = :id_stock";

        $stmt = $this->conn->prepare($query);

        $this->id_stock = htmlspecialchars(strip_tags($this->id_stock));
        $this->id_book = htmlspecialchars(strip_tags($this->id_book));
        $this->total_stock = htmlspecialchars(strip_tags($this->total_stock));
        $this->notes = htmlspecialchars(strip_tags($this->notes));
        $this->last_inventory = htmlspecialchars(strip_tags($this->last_inventory));

        $stmt->bindParam(":id_stock", $this->id_stock);
        $stmt->bindParam(":id_book", $this->id_book);
        $stmt->bindParam(":total_stock", $this->total_stock);
        $stmt->bindParam(":notes", $this->notes);
        $stmt->bindParam(":last_inventory", $this->last_inventory);

        return $stmt->execute();
    }

    public function eliminar()
    {
        $query = "DELETE FROM " . $this->table_name . " 
                  WHERE ID_STOCK = :id_stock";

        $stmt = $this->conn->prepare($query);

        $this->id_stock = htmlspecialchars(strip_tags($this->id_stock));
        $stmt->bindParam(":id_stock", $this->id_stock);

        return $stmt->execute();
    }
}
