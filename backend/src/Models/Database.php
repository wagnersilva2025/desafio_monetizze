<?php

class Database
{
    private $host = '177.11.48.209';
    private $dbName = 'webponto_site';
    private $username = 'webpontocomcom_desafio';
    private $password = 's1338<E0>Hqv';
    private $conn;

    public function getConnection()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        return $this->conn;
    }
}
?>
