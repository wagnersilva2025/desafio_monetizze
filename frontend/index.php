<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Cadastro</title>
    <link rel="stylesheet" href="login/styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <!-- Login Form -->
            <div class="form login-form">
                <h2>Entrar</h2>
                <form id="login-form">
                    <input type="text" id="login-name" name="name" placeholder="Nome" required>
                    <input type="password" id="login-password" name="password" placeholder="Senha" required>
                    <button type="submit" class="btn">Entrar</button>
                </form>
                <p>Não tem uma conta? <a href="javascript:void(0)" onclick="toggleForm()">Cadastre-se</a></p>
            </div>

            <!-- Register Form -->
            <div class="form register-form">
                <h2>Cadastrar</h2>
                <form id="register-form">
                    <input type="text" id="register-name" name="name" placeholder="Nome" required>
                    <input type="password" id="register-password" name="password" placeholder="Senha" required>
                    <button type="submit" class="btn">Cadastrar</button>
                </form>
                <p>Já tem uma conta? <a href="javascript:void(0)" onclick="toggleForm()">Faça login</a></p>
            </div>
        </div>
    </div>

    <script src="login/js/scriptHome.js"></script>
     <script src="login/js/scriptForm.js"></script>
</body>

</html>
