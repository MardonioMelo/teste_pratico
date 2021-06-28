<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use Slim\Factory\AppFactory;

# Iniciar App
$app = AppFactory::create();

# Define o caminho base
PATH_SUB === "" ?: $app->setBasePath(PATH_SUB);

# Rotas do App
require '../src/routes/router.php';
