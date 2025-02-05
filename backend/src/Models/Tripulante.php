<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/config/Database.php';

class Tripulante
{
    private $id;
    private $nome;
    private $email;
    private $conn;

    public function __construct($nome, $email, $id = null)
    {
        $this->conn = (new Database())->getConnection();
        $this->nome = $nome;
        $this->email = $email;
        $this->id = $id;
    }

    public function save()
    {
        if ($this->id === null) {
            $stmt = $this->conn->prepare("INSERT INTO tripulantes (nome, email) VALUES (:nome, :email)");
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $this->id = $this->conn->lastInsertId();
        }
    }

    public function getId()
    {
        return $this->id;
    }
}
?>
