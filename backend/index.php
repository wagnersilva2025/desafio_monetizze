<?php

// Permite que qualquer origem faça a requisição
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Responde à requisição OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit(); // Encerra a execução do script após a resposta OPTIONS
}

require_once 'src/Controllers/LotteryController.php';
require_once 'src/Controllers/UserController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remova a parte "/index.php" da URL, se estiver presente
$uri = str_replace('/index.php', '', $uri);

switch ($uri) {
    case '/api/generate_ticket':
        $controller = new LotteryController();
        $controller->generateTicket();
        break;
    case '/api/lottery_results':
        $controller = new LotteryController();
        $controller->getLotteryResults();
        break;
    case '/api/user_register':
        $controller = new UserController();
        $controller->register();
        break;
    case '/api/user_auth':
        $controller = new UserController();
        $controller->login();
        break;
    case '/api/all_bets':
        $controller = new LotteryController();
        $controller->getLotteryBets();
        break;
    case '/api/drawWinner':
        $controller = new LotteryController();
        $controller->drawWinner();
        break;
    case '/api/list_winner':
        $controller = new LotteryController();
        $controller->listWinner();
            break;
    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["error" => "Rota não encontrada."]);
        break;
}
?>
