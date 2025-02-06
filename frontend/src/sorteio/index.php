<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sorteio</title>
        <link rel="stylesheet" href="styles/styleSorteio.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <?php include __DIR__ . '/../menu/index.php'; ?>
        <div class="btnSorteio">
            <button type="submit" class="btn">Sortear</button>
        </div>
        <div class="containerData">
            <div class="spinner" style="display: none;"></div>
        </div>
        <div class="containerTable"> 
            <table class="tabela" id="tabela" style="display: none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Dezenas</th>
                        <th>Apostador</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>
            <div id="mensagemSucesso" style="display: none; padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-top: 10px;">
                🎉 Bilhete gerado com sucesso!
            </div>
        </div>
        <script src="js/scriptFormGeraBilhete.js"></script>
    </body>
</html>
