<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Models/User.php';

class UserService {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function registerUser($name, $password) {
        if (empty($name) || empty($password)) {
            return ["error" => "Nome e senha são obrigatórios."];
        }
        $checkUser = $this->userModel->checkIfUserExists($name);
        if ($checkUser) {
            return ['status' => 400, 'error' => 'O nome de usuário já existe!'];
        }
       
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if ($this->userModel->create($name, $hashedPassword)) {
            return ["success" => "Usuário cadastrado com sucesso!"];
        } else {
            return ["error" => "Erro ao cadastrar usuário."];
        }
    }

    public function userCheck($name) {
        if (empty($name)) {
            return ["error" => "Nome e senha são obrigatórios."];
        }

        if ($this->userModel->checkIfUserExists($name)) {
            return ['status' => 400, "error" => "O nome de usuário já existe!"];
        } else {
            return ['status' => 200, "success" => "Nome de usuário valido"];
        }
    }

    public function loginUser($name, $password) {
        if (empty($name) || empty($password)) {
            return ["error" => "Nome e senha são obrigatórios."];
        }

        $user = $this->userModel->getUserByName($name);

        if (!$user) {
            return ['status' => 400, 'error' => 'Usuário não encontrado!'];
        }
      
        if (password_verify($password, $user['password'])) {
        return ["status" => 200, 
                "success" => "Login bem-sucedido!", 
                    'data' => [ 'id' => $user['id'], 
                    'name' => $user['name']]];
        } else {
            return ['status' => 400, 'error' => 'Senha incorreta!'];
        }
    }
}
?>
