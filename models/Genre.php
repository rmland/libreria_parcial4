<?php
class Genre {
    private $conn;
    private $table_name = "genre";

    public $id_genre;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                SET ID_GENRE = :id_genre, 
                    NAME = :name";

        $stmt = $this->conn->prepare($query);

        $this->id_genre = htmlspecialchars(strip_tags($this->id_genre));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":id_genre", $this->id_genre);
        $stmt->bindParam(":name", $this->name);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY ID_GENRE";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " 
                WHERE ID_GENRE = :id_genre";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_genre", $this->id_genre);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->name = $row['NAME'];
            return true;
        }
        return false;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . "
                SET NAME = :name 
                WHERE ID_GENRE = :id_genre";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id_genre = htmlspecialchars(strip_tags($this->id_genre));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id_genre", $this->id_genre);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE ID_GENRE = :id_genre";
        
        $stmt = $this->conn->prepare($query);
        
        $this->id_genre = htmlspecialchars(strip_tags($this->id_genre));
        $stmt->bindParam(":id_genre", $this->id_genre);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
