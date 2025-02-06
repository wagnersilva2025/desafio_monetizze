
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loteria / Home</title>
        <link rel="stylesheet" href="styles/styleHome.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php include __DIR__ . '/../menu/index.php'; ?>
        <div class="containerFom">
            <h2>Cadastro de Bilhetes</h2>
            <form id="bilheteForm">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="quantidadeBilhete">Quantidade de Bilhetes:</label>
                <input type="number" id="quantidadeBilhete" name="quantidadeBilhete" required>

                <label for="quantidadeDezenas">Quantidade de Dezenas:</label>
                <input type="number" id="quantidadeDezenas" name="quantidadeDezenas" required>

                <button type="submit">Cadastrar</button>
            </form>
            <div id="mensagemSucesso" style="display: none; padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-top: 10px;">
                🎉 Bilhete gerado com sucesso!
            </div>

        </div>
        <script src="js/scriptFormGeraBilhete.js"></script>
    </body>
</html>
