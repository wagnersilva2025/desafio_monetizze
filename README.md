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
├── backend/               # Código da API em Node.js
│   ├── src/
│   │   ├── controllers/
│   │   ├── models/
│   │   ├── routes/
│   │   ├── services/
│   │   ├── utils/
│   ├── tests/            # Testes unitários
├── frontend/              # Código do frontend em PHP
├── docker-compose.yml     # Configuração do Docker
├── README.md              # Documentação do projeto

Como Executar o Projeto

1. Clonar o Repositório

git clone https://github.com/seu-repositorio.git
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

O que o Projeto Faz

✅ Cria bilhetes para sorteio
✅ Realiza sorteios automáticos
✅ Identifica bilhetes premiados
✅ Exibe resultados no frontend

O que o Projeto NÃO Faz

❌ Não suporta múltiplos sorteios simultâneos (ainda)
❌ Não tem sistema de login/administração

