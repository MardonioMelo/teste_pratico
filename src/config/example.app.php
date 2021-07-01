<?php
# hora local
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set("Brazil/East");

# Definições path padrão - defina essa variável apenas se o site estiver em um subdiretório
define("PATH_SUB",  "/teste_pratico"); //http://localhost/teste_pratico/

# Definições para conexão com banco de dados
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "teste_pratico",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("LINK_ZAP", "https://api.whatsapp.com/send?phone=5562991002841&text=Ol%C3%A1!%20Quero%20dar%20minha%20avalia%C3%A7%C3%A3o%20sobre%20o%20projeto%20que%20voc%C3%AA%20fez!");
