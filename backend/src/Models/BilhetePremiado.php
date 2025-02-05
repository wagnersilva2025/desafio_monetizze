<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/config/Database.php';

class BilhetePremiado
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function generate()
    {
        $dezenas = [];
        while (count($dezenas) < 6) {
            $numero = rand(1, 60);
            if (!in_array($numero, $dezenas)) {
                $dezenas[] = $numero;
            }
        }

        sort($dezenas);
        $this->save($dezenas);

        return ['dezenas' => implode(", ", $dezenas)];
    }

    private function save($dezenas)
    {
        $stmt = $this->conn->prepare("INSERT INTO bilhete_premiado (dezenas, data_sorteio) VALUES (:dezenas, NOW())");
        $stmt->bindParam(':dezenas', implode(",", $dezenas));
        $stmt->execute();
    }

    public function getBilhetePremiadoData()
    {
        $stmt = $this->conn->query("SELECT
                                        bilhete_premiado.id,
                                        bilhete_premiado.dezenas,
                                        bilhete_premiado.data_sorteio,
                                        bilhetes.tripulante,
                                        bilhete_premiado.bilhete_id
                                        FROM
                                        bilhete_premiado
                                        INNER JOIN bilhetes ON bilhete_premiado.bilhete_id = bilhetes.id
                                        ORDER BY
                                        bilhetes.data_sorteio ASC
                                    ");
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$row) {
            return ['status' => 400, 'error' => 'Nenhum bilhete premiado encontrado'];
        }

        return ['status' => 200, 'data' => $row];
    }

    public function saveWinner($bilheteId, $dezenas)
    {
        $stmt = $this->conn->prepare("INSERT INTO bilhete_premiado (bilhete_id, dezenas) VALUES (:bilhete_id, :dezenas)");
        $stmt->bindParam(":bilhete_id", $bilheteId);
        $stmt->bindParam(":dezenas", $dezenas);
        $stmt->execute();
        return $this->conn->lastInsertId(); // Retorna o ID inserido
    }

    
}
?>
