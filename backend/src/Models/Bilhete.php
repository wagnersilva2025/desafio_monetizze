<?php


require_once 'Database.php';


class Bilhete
{
    private $id;
    private $tripulante;
    private $dezenas;
    private $conn;

    public function __construct($tripulante = null, $dezenas = null, $id = null)
    {
        $this->conn = (new Database())->getConnection();
        $this->tripulante = $tripulante;
        $this->dezenas = $dezenas ? implode(",", $dezenas) : null;
        $this->id = $id;
    }

    public function save()
    {
        $stmt = $this->conn->prepare("INSERT INTO bilhetes (tripulante, quantidade_dezenas, data_geracao) VALUES (:tripulante, :quantidade_dezenas, NOW())");
       
        $stmt->bindParam(':tripulante', $this->tripulante);
        $stmt->bindValue(':quantidade_dezenas', count(explode(",", $this->dezenas)), PDO::PARAM_INT);
        $stmt->execute();
        $bilheteId = $this->conn->lastInsertId();

        $this->saveDezenas($bilheteId);
    }

    private function saveDezenas($bilheteId)
    {
        $stmt = $this->conn->prepare("INSERT INTO bilhetes_dezenas (bilhete_id, dezenas) VALUES (:bilhete_id, :dezenas)");
        $stmt->bindParam(':bilhete_id', $bilheteId);
        $stmt->bindParam(':dezenas', $this->dezenas);
        $stmt->execute();
    }

    public function updateBilhete($bilheteId, $idSorteio)
    {
        $stmt = $this->conn->prepare("UPDATE bilhetes SET data_sorteio = NOW(), premiado = :premiado, sorteio_id = :sorteio_id WHERE id = :id");
        $stmt->bindParam(':id', $bilheteId);
        $stmt->bindValue(':premiado', 1, PDO::PARAM_INT);
        $stmt->bindParam(':sorteio_id', $idSorteio);
        $stmt->execute();
    }

    public function updateSorteio($idSorteio)
    {
        $stmt = $this->conn->prepare("UPDATE bilhetes SET data_sorteio = NOW(), sorteio_id = :sorteio_id WHERE sorteio_id is null");
        $stmt->bindParam(':sorteio_id', $idSorteio);
        $stmt->execute();
    }

    public function getBilheteData()
    {
        return [
            'tripulante' => $this->tripulante,
            'dezenas' => $this->dezenas
        ];
    }

    public function getAllLotteryBets()
    {
        $stmt = $this->conn->prepare("SELECT
                                        bilhetes.id,
                                        bilhetes.tripulante,
                                        bilhetes.quantidade_dezenas,
                                        bilhetes.data_geracao,
                                        bilhetes.data_sorteio,
                                        bilhetes.premiado,
                                        bilhetes.sorteio_id,
                                        bilhetes_dezenas.id,
                                        bilhetes_dezenas.dezenas
                                        FROM
                                        bilhetes
                                        INNER JOIN bilhetes_dezenas ON bilhetes_dezenas.bilhete_id = bilhetes.id
                                    ");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllLotteryDrawWinner()
    {
        $stmt = $this->conn->prepare("SELECT
                                        bilhetes.id,
                                        bilhetes.sorteio_id,
                                        bilhetes.tripulante,
                                        bilhetes.quantidade_dezenas,
                                        bilhetes.data_geracao,
                                        bilhetes.data_sorteio,
                                        bilhetes.premiado,
                                        bilhetes_dezenas.dezenas
                                        FROM
                                        bilhetes
                                        INNER JOIN bilhetes_dezenas ON bilhetes_dezenas.bilhete_id = bilhetes.id
                                        WHERE
                                        bilhetes.sorteio_id IS null
                                    ");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listBetsPrizeDraw($idSorteio)
    {
        $stmt = $this->conn->prepare("SELECT
                                        bilhetes.id,
                                        bilhetes.tripulante,
                                        bilhetes.quantidade_dezenas,
                                        bilhetes.data_geracao,
                                        bilhetes.data_sorteio,
                                        bilhetes.premiado,
                                        bilhetes.sorteio_id,
                                        bilhetes_dezenas.dezenas,
                                        bilhete_premiado.dezenas as dezenas_sorteada
                                        FROM
                                        bilhetes
                                        INNER JOIN bilhetes_dezenas ON bilhetes.id = bilhetes_dezenas.bilhete_id
                                        INNER JOIN bilhete_premiado ON bilhetes.sorteio_id = bilhete_premiado.id
                                        WHERE
                                        bilhetes.sorteio_id = $idSorteio
                                    ");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
