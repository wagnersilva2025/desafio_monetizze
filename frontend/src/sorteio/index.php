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
        <script src="js/scriptFormGeraBilhete.js"></script>
    </body>
</html>
