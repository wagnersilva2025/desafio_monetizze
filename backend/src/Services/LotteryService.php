<?php

require_once 'src/Models/Bilhete.php';
require_once 'src/Models/BilhetePremiado.php';
require_once 'src/Models/Tripulante.php';

class LotteryService
{
    public function generateTickets($tripulante, $quantidadeDezenas, $quantidadeBilhetes)
    {
        if ($quantidadeBilhetes > 50) {
            return ["error" => "Você não pode gerar mais de 50 bilhetes."];
        }
        if ($quantidadeDezenas > 10) {
            return ["error" => "Você não pode gerar mais de 10 Números."];
        }

        $tickets = [];
        for ($i = 0; $i < $quantidadeBilhetes; $i++) {
            $dezenas = $this->generateDezenas($quantidadeDezenas);
            $bilhete = new Bilhete($tripulante, $dezenas);
            $bilhete->save();
            $tickets[] = $bilhete->getBilheteData();
        }

        return ["status" => 200, 
        "success" => "Bilhetes gerados!", 
            'data' =>  $tickets
           ];
       
    }

    private function generateDezenas($quantidadeDezenas)
    {
        $dezenas = [];
        while (count($dezenas) < $quantidadeDezenas) {
            $numero = rand(1, 60);
            if (!in_array($numero, $dezenas)) {
                $dezenas[] = $numero;
            }
        }

        sort($dezenas);
        return $dezenas;
    }

    public function getLotteryResults()
    {
        $bilhetePremiado = new BilhetePremiado();
        return $bilhetePremiado->getBilhetePremiadoData();
    }

    public function listWinner()
    {
        $bilhetePremiado = new BilhetePremiado();
        return $bilhetePremiado->getBilhetePremiadoData();
    }

    public function getLotteryBets()
    {
        $bilhete = new Bilhete();
        $lotteryBets = $bilhete->getAllLotteryBets();

        if (!$lotteryBets) {
            return ['status' => 400, 'error' => 'Nenhum bilhete encontrado!'];
        }

        return ["status" => 200, 
        "success" => "Bilhetes encontrados!", 
            'data' =>  $lotteryBets
           ];
    }
   
    public function drawWinner()
    {
     
        $bilheteModel = new Bilhete();
        $bilhetes = $bilheteModel->getAllLotteryDrawWinner();
    
        if (empty($bilhetes)) {
            return ['status' => 400, 'error' => 'Nenhum bilhete encontrado!'];
        }
    
        $bilhetePremiado = null;
        while (!$bilhetePremiado) {
           
            $bilheteSorteado = $bilhetes[array_rand($bilhetes)];
            $dezenasBilhete = explode(',', $bilheteSorteado['dezenas']);
    
            shuffle($dezenasBilhete);
            $numerosSorteados = array_slice($dezenasBilhete, 0, 6);
    
            foreach ($bilhetes as $bilhete) {
                $dezenasBilheteCheck = explode(',', $bilhete['dezenas']);
                $matchCount = count(array_intersect($numerosSorteados, $dezenasBilheteCheck));
    
                if ($matchCount >= 6) {
                    $bilhetePremiado = $bilhete;
                    break;
                }
            }
        }
    
        $bilhetePremiadoModel = new BilhetePremiado();
        $retornoId = $bilhetePremiadoModel->saveWinner($bilhetePremiado['id'], implode(',', $numerosSorteados));
        $bilheteModel->updateBilhete($bilhetePremiado['id'], $retornoId);
        $bilheteModel->updateSorteio($retornoId);
    
        return [
            'status' => 200,
            'success' => 'Bilhete premiado encontrado!',
            'numeros_sorteados' => $numerosSorteados,
            'bilhete_vencedor' => $bilhetePremiado,
            'id_sorteio' => $retornoId
        ];
    }
    

    private function generateFromExistingNumbers($numerosDisponiveis, $quantidade)
    {
        shuffle($numerosDisponiveis); 
        return array_slice($numerosDisponiveis, 0, $quantidade); 
    }

    public function listBetsPrizeDraw($idsorteio)
    {
        
        $bilhete = new Bilhete();
        $retorno = $bilhete->listBetsPrizeDraw($idsorteio);

        if (!empty($retorno)) {
            return ['status' => 200, 'data' => $retorno];
        }

        return ['status' => 400, 'error' => 'Nenhum bilhete encontrado!'];
    }
}
?>
