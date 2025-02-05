<?php

class Database
{
    private $host = '177.11.48.209';
    private $dbName = 'webponto_site';
    private $username = 'webpontocomcom_desafio';
    private $password = 's1338<E0>Hqv';
    private $conn;
//s1338<E0>Hqv
    public function getConnection()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 // Teste de conexão
                 if ($this->conn) {
                   // echo "Conexão bem-sucedida!";
                }else{
                   // echo "Conexão Falhou!";
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        return $this->conn;
    }
}
?>
