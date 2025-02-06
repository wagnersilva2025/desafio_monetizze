# desafio_monetizze

Projeto: API de Sorteio de Loteria

Descrição

Este projeto consiste em uma API desenvolvida em PHP para realizar sorteios de loteria. O frontend, desenvolvido em PHP, consome essa API para exibir os resultados. O projeto segue os princípios de POO, SOLID e Clean Code, além de estar containerizado com Docker para facilitar a execução.

Tecnologias Utilizadas

Backend: PHP

Frontend: PHP

Banco de Dados: MySQL

Containerização: Docker

Estrutura do Projeto

/
├── backend/               
│   ├── src/
│   │   ├── controllers/
│   │   ├── models/
│   │   ├── services/
│   ├── tests/            
├── frontend/              
|   ├── src/ 
├── docker-compose.yml     
├── README.md              

Como Executar o Projeto

1. Clonar o Repositório

git clone https://github.com/projeto-repositorio.git
cd seu-repositorio

2. Subir os Containers com Docker

docker-compose up --build

3. Front-end está disponível em: http://localhost:8081/src/home/
- Tela para geração de bilhetes, onde é necessário inserir o nome do apostador, a quantidade de bilhetes (de 1 a 50) e a quantidade de dezenas por bilhete (de 6 a 10).

4.  Lista de jogos http://localhost:8081/src/jogos/
- Lista todos os jogos gerados, exibindo o status: "Aguardando", "Sorteio Efetuado" ou "Bilhete Premiado".

5. Jogos premiados http://localhost:8081/src/premiado/
- Lista de todos os jogos premiados

6.  http://localhost:8081/src/sorteio/
- Realiza o sorteio com base em todos os jogos em aberto. Caso não haja nenhum bilhete cadastrado, o sorteio não será efetuado.

4. Testar a API

A API estará rodando em http://localhost:8080/

Criar bilhete : POST / http://localhost:8080/index.php/api/generate_ticket

{
    "tripulante": "wagner",
    "quantidade_dezenas": 5,
    "quantidade_bilhetes": 6
}

Listar todos os bilhetes : GET http://localhost:8080/index.php/api/all_bets

Listar todos os bilhetes premiados: GET http://localhost:8080/index.php/api/list_winner

Realizar sorteio: GET http://localhost:8080/index.php/api/drawWinner

O que o Projeto Faz

✅ Cria bilhetes para sorteio
✅ Realiza sorteios automáticos
✅ Identifica bilhetes premiados
✅ Exibe resultados no frontend

O que o Projeto NÃO Faz

❌ Não suporta múltiplos sorteios simultâneos (ainda)
❌ Não tem sistema de login/administração

