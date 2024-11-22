<?php
class User
{
    private $conn;
    private $table_name = "users";
    public $id;
    public $username;
    public $password;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($username, $password)
    {
        $query = "SELECT id, nombre, password 
                 FROM " . $this->table_name . " 
                 WHERE nombre = :nombre";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {

                return [
                    'id' => $row['id'],
                    'nombre' => $row['nombre']
                ];
            }
        }
        return false;
    }

    public function create($username, $password)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                SET nombre = :nombre, 
                    password = :password";

        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":nombre", $username);
        $stmt->bindParam(":password", $hashed_password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
