<?php

class Database
{
    private $host = '177.53.141.144';
    private $dbName = 'webponto_site';
    private $username = 'webponto_wagner';
    private $password = 'asconprev140680';
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
