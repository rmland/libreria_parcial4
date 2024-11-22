<?php
class Book
{
    private $conn;
    private $table_name = "book";

    public $id_book;
    public $title;
    public $description;
    public $year_publication;
    public $id_author;
    public $id_genre;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function crear()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET TITLE = :title, 
                      DESCRIPTION = :description, 
                      YEAR_PUBLICATION = :year_publication, 
                      ID_AUTHOR = :id_author, 
                      ID_GENRE = :id_genre";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->year_publication = htmlspecialchars(strip_tags($this->year_publication));
        $this->id_author = htmlspecialchars(strip_tags($this->id_author));
        $this->id_genre = htmlspecialchars(strip_tags($this->id_genre));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":year_publication", $this->year_publication);
        $stmt->bindParam(":id_author", $this->id_author);
        $stmt->bindParam(":id_genre", $this->id_genre);

        return $stmt->execute();
    }

    public function leerTodos()
    {
        $query = "SELECT * FROM " . $this->table_name . " b
              LEFT JOIN author a ON b.ID_AUTHOR = a.ID_AUTHOR
              LEFT JOIN genre g ON b.ID_GENRE = g.ID_GENRE  ORDER BY ID_BOOK";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUno()
    {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE ID_BOOK = :id_book";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_book", $this->id_book);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->title = $row['TITLE'];
            $this->description = $row['DESCRIPTION'];
            $this->year_publication = $row['YEAR_PUBLICATION'];
            $this->id_author = $row['ID_AUTHOR'];
            $this->id_genre = $row['ID_GENRE'];
            return true;
        }
        return false;
    }

    public function actualizar()
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET TITLE = :title, 
                      DESCRIPTION = :description, 
                      YEAR_PUBLICATION = :year_publication, 
                      ID_AUTHOR = :id_author, 
                      ID_GENRE = :id_genre 
                  WHERE ID_BOOK = :id_book";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->year_publication = htmlspecialchars(strip_tags($this->year_publication));
        $this->id_author = htmlspecialchars(strip_tags($this->id_author));
        $this->id_genre = htmlspecialchars(strip_tags($this->id_genre));
        $this->id_book = htmlspecialchars(strip_tags($this->id_book));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":year_publication", $this->year_publication);
        $stmt->bindParam(":id_author", $this->id_author);
        $stmt->bindParam(":id_genre", $this->id_genre);
        $stmt->bindParam(":id_book", $this->id_book);

        return $stmt->execute();
    }

    public function eliminar()
    {
        $query = "DELETE FROM " . $this->table_name . " 
                  WHERE ID_BOOK = :id_book";

        $stmt = $this->conn->prepare($query);

        $this->id_book = htmlspecialchars(strip_tags($this->id_book));
        $stmt->bindParam(":id_book", $this->id_book);

        return $stmt->execute();
    }
}
