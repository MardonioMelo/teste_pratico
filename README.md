# Teste Prático
Teste prático para vaga de Desenvolvedor Back-end PHP. 

Neste teste foram apresentados 4 problemas a serem resolvidos. As soluções para os problemas apresentados podem ser vistos na sessão "Soluções" dentro dessa aplicação desenvolvida.

As 4 soluções são:
- Calculo da quantidade em anos em que um personagem vai ultrapassar outro personagem na altura sendo ele menor e com taxa de crescimento maior.
- Gerador de matriz 5x5 com números aleatórios, separação dos números impares e pares. 
- Gerador de recibo de livro para biblioteca
- Verificador de números se pertencem a sequência Fibonacci.

Ambiente de desenvolvimento:
- Tipo de servidor: MariaDB/MySql
- SGBD PhpMyAdmin
- PHP 7.4.19
- Servidor Apache/2.4.47
- XAMPP

Tecnologias utilizadas:
- PHP 7
- JavaScript
- CSS/ Bootstrap 5
- HTML
- Jquery
- Ajax
- Slim Framework 4 (como Roteador HTTP e Suporte PSR-7)
- MVC próprio
- coffeecode/datalayer (para abstração do db)
- Composer (como gerenciador de pacotes PHP)
- POO

IDE: VsCode

## Configuração e Instalação

### Arquivo: teste_pratico\src\config\app.php

- Renomeie \src\config\example.app.php para \src\config\app.php
- Informe na variável PATH_SUB o nome da pasta do projeto caso o projeto esteja em uma sub-pasta.
- Não precisa informar o PATH_SUB se o projeto estiver diretório raiz do servidor.
- Crie um banco de dados com nome teste_pratico ou de sua escola e importe a tabela teste_pratico\src\db\tab_altura.sql
- Informe os dados de acesso ao banco de dados.

### Terminal

Entre na pasta do projeto pelo terminal e execute o comando:

> composer install

