<?php
class Author
{
    private $conn;
    private $table_name = "author";
    public $id_author;
    public $full_name;
    public $date_of_birth;
    public $date_of_death;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function crear()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                SET FULL_NAME = :full_name, 
                    DATE_OF_BIRTH = :date_of_birth, 
                    DATE_OF_DEATH = :date_of_death";

        $stmt = $this->conn->prepare($query);

        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->date_of_death = htmlspecialchars(strip_tags($this->date_of_death));

        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":date_of_death", $this->date_of_death);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function leerTodos()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY ID_AUTHOR";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUno()
    {
        $query = "SELECT * FROM " . $this->table_name . " 
                WHERE ID_AUTHOR = :id_author";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_author", $this->id_author);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->full_name = $row['FULL_NAME'];
            $this->date_of_birth = $row['DATE_OF_BIRTH'];
            $this->date_of_death = $row['DATE_OF_DEATH'];
            return true;
        }
        return false;
    }

    public function actualizar()
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET FULL_NAME = :full_name, 
                      DATE_OF_BIRTH = :date_of_birth, 
                      DATE_OF_DEATH = :date_of_death 
                  WHERE ID_AUTHOR = :id_author";

        $stmt = $this->conn->prepare($query);

        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->date_of_death = htmlspecialchars(strip_tags($this->date_of_death));
        $this->id_author = htmlspecialchars(strip_tags($this->id_author));

        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":date_of_birth", $this->date_of_birth);
        $stmt->bindParam(":date_of_death", $this->date_of_death);
        $stmt->bindParam(":id_author", $this->id_author);

        return $stmt->execute();
    }
    public function eliminar()
    {
        $query = "DELETE FROM " . $this->table_name . " 
                WHERE ID_AUTHOR = :id_author";

        $stmt = $this->conn->prepare($query);

        $this->id_author = htmlspecialchars(strip_tags($this->id_author));
        $stmt->bindParam(":id_author", $this->id_author);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
