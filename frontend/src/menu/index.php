<?php
    $uriSegments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $lastSegment = end($uriSegments);
?>
<header>
    <nav class="menu">
        <ul>
            <li><a href="http://localhost:8081/src/home" <?= $lastSegment == 'home' ? 'style="pointer-events: none; color: grey;"' : '' ?>>Gerar Bilhete</a></li>
            <li><a href="http://localhost:8081/src/jogos" <?= $lastSegment == 'jogos' ? 'style="pointer-events: none; color: grey;"' : '' ?>>Listar Jogos</a></li>
            <li><a href="http://localhost:8081/src/premiado" <?= $lastSegment == 'premiado' ? 'style="pointer-events: none; color: grey;"' : '' ?>>Jogos Premiado</a></li>
            <li><a href="http://localhost:8081/src/sorteio" <?= $lastSegment == 'sorteio' ? 'style="pointer-events: none; color: grey;"' : '' ?>>Sorteio</a></li>
        </ul>
    </nav>
</header>

    <style>
    header {
        width: 100%;
        background-color: #0056b3;
        padding: 10px 0;
    }

    .menu ul {
        list-style: none;
        display: flex;
        justify-content: center;
    }

    .menu ul li {
        margin: 0 15px;
    }

    .menu ul li a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: color 0.3s;
    }

    .menu ul li a:hover {
        color: #ffcc00;
    }
</style>