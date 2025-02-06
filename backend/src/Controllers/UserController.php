<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Services/UserService.php';

class UserController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(["error" => "Método não permitido. Use POST para o login."]);
            return;
        }
        $inputData = json_decode(file_get_contents("php://input"), true);
        if (!isset($inputData['name']) || !isset($inputData['password'])) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["error" => "Dados ausentes ou inválidos."]);
            return;
        }
        $name = $inputData['name'];
        $password = $inputData['password'];
        $response = $this->userService->registerUser($name, $password);

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function login() {
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(["error" => "Método não permitido. Use POST para o login."]);
            return;
        }
        
        $inputData = json_decode(file_get_contents("php://input"), true);
        if (!isset($inputData['name']) || !isset($inputData['password'])) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["error" => "Dados ausentes ou inválidos."]);
            return;
        }
        $name = $inputData['name'];
        $password = $inputData['password'];
       
        $result = $this->userService->loginUser($name, $password);

        echo json_encode($result);
    }
}

?>
