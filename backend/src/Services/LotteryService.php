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
        // Buscar todos os bilhetes cadastrados
        $bilheteModel = new Bilhete();
        $bilhetes = $bilheteModel->getAllLotteryDrawWinner();
    
        if (empty($bilhetes)) {
            return ['status' => 400, 'error' => 'Nenhum bilhete encontrado!'];
        }
    
        $bilhetePremiado = null;
        while (!$bilhetePremiado) {
            // Escolher um bilhete aleatório para definir os números do sorteio
            $bilheteSorteado = $bilhetes[array_rand($bilhetes)];
            $dezenasBilhete = explode(',', $bilheteSorteado['dezenas']);
    
            // Sortear 6 números a partir desse bilhete
            shuffle($dezenasBilhete);
            $numerosSorteados = array_slice($dezenasBilhete, 0, 6);
    
            // Verificar se algum outro bilhete contém pelo menos 6 desses números
            foreach ($bilhetes as $bilhete) {
                $dezenasBilheteCheck = explode(',', $bilhete['dezenas']);
                $matchCount = count(array_intersect($numerosSorteados, $dezenasBilheteCheck));
    
                if ($matchCount >= 6) {
                    $bilhetePremiado = $bilhete;
                    break;
                }
            }
        }
    
        // Salvar o bilhete premiado
        $bilhetePremiadoModel = new BilhetePremiado();
        $retornoId = $bilhetePremiadoModel->saveWinner($bilhetePremiado['id'], implode(',', $numerosSorteados));
        $bilheteModel->updateBilhete($bilhetePremiado['id'], $retornoId);
        $bilheteModel->updateSorteio($retornoId);
    
        return [
            'status' => 200,
            'success' => 'Bilhete premiado encontrado!',
            'numeros_sorteados' => $numerosSorteados,
            'bilhete_vencedor' => $bilhetePremiado
        ];
    }
    

private function generateFromExistingNumbers($numerosDisponiveis, $quantidade)
{
    shuffle($numerosDisponiveis); // Mistura os números
    return array_slice($numerosDisponiveis, 0, $quantidade); // Pega os primeiros 6 números
}

    /*
    private function addExtraNumber($numerosSorteados)
    {
        do {
            $novoNumero = rand(1, 60);
        } while (in_array($novoNumero, $numerosSorteados));

        $numerosSorteados[] = $novoNumero;
        sort($numerosSorteados);

        return $numerosSorteados;
    }
        */
}
?>
