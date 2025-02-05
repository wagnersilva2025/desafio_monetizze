<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/config/Database.php';

class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function create($name, $passwordHash) {
        $sql = "INSERT INTO " . $this->table . " (name, password, active) VALUES (:name, :password, :active)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":password", $passwordHash);
        $stmt->bindValue(":active", 0);
        return $stmt->execute();
    }

    public function checkIfUserExists($name) {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        
        // If count > 0, the user exists
        return $stmt->fetchColumn() > 0;
    }

    public function getUserByName($name) {
        $sql = "SELECT * FROM " . $this->table . " WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retorna os dados do usuário
    }
    
}
?>
