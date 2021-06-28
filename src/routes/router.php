<?php

use Slim\Exception\HttpNotFoundException;
use Src\Controllers\Home\HomeController;
use Src\Controllers\Solution\SolutionController;


$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

//Configuração do CORS
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// --------------------------+
// Inicio das rotas
// --------------------------+

//Rotas GET
$app->get('/', HomeController::class . ":pageHome");
$app->get('/solucao/1', SolutionController::class . ":pageSolutionOne");
$app->get('/solucao/2', SolutionController::class . ":pageSolutionTwo");
$app->get('/solucao/3', SolutionController::class . ":pageSolutionThree");
$app->get('/solucao/4', SolutionController::class . ":pageSolutionFour");

// Rotas POST
$app->post('/solucao/one/create', SolutionController::class . ":createSolutionOne");

// --------------------------+
// Fim rotas a partir daqui
// --------------------------+


/**
 * Rota pega-tudo para exibir uma página 404 não encontrada se nenhuma das rotas corresponder
 */
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});


//Resposta padrão em caso de erro
try {
    $app->run();
} catch (Exception $e) {

    $arr = [
        "success" => false,
        "error" => "Esta ação não é permitida!"
    ];

    die(json_encode($arr));
}