<header>
    <nav class="menu">
        <ul>
            <li><a href="http://localhost:8081/src/home">Gerar Bilhete</a></li>
            <li><a href="http://localhost:8081/src/jogos">Listar Jogos</a></li>
            <li><a href="http://localhost:8081/src/premiado">Jogos Premiado</a></li>
            <li><a href="http://localhost:8081/src/sorteio">Sortear</a></li>
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