<?php

require_once 'src/Services/LotteryService.php';

class LotteryController
{
    private $lotteryService;

    public function __construct()
    {
        $this->lotteryService = new LotteryService();
    }

    public function generateTicket()
    {
        $inputData = json_decode(file_get_contents("php://input"), true);
        if (!isset($inputData['tripulante']) || !isset($inputData['quantidade_dezenas']) || !isset($inputData['quantidade_bilhetes'])) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["error" => "Dados ausentes ou inválidos."]);
            return;
        }

        $tripulante = $inputData['tripulante'];
        $quantidadeDezenas = $inputData['quantidade_dezenas'];
        $quantidadeBilhetes = $inputData['quantidade_bilhetes'];

        $tickets = $this->lotteryService->generateTickets($tripulante, $quantidadeDezenas, $quantidadeBilhetes);

        echo json_encode($tickets);
    }

    public function getLotteryResults()
    {
        $results = $this->lotteryService->getLotteryResults();

        echo json_encode($results);
    }
    public function getLotteryBets()
    {
        $results = $this->lotteryService->getLotteryBets();

        echo json_encode($results);
    }

    public function drawWinner()
    {
        $results = $this->lotteryService->drawWinner();

        echo json_encode($results);
    }

    public function listWinner(){
        $results = $this->lotteryService->listWinner();

        echo json_encode($results);
    }

    public function listBetsPrizeDraw(){
        $inputData = json_decode(file_get_contents("php://input"), true);
        if (!isset($inputData['idsorteio'])) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["error" => "Dados ausentes ou inválidos."]);
            return;
        }

        $idsorteio = $inputData['idsorteio'];
      
        $results = $this->lotteryService->listBetsPrizeDraw($idsorteio);

        echo json_encode($results);
    }

    

}
?>
