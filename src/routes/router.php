<?php

use Src\Controllers\Home\HomeController;
use Slim\Exception\HttpNotFoundException;
use Src\Controllers\Solution\SolutionOneController;
use Src\Controllers\Solution\SolutionTwoController;
use Src\Controllers\Solution\SolutionFourController;
use Src\Controllers\Solution\SolutionThreeController;


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
$app->get('/404', HomeController::class . ":page404");
$app->get('/solucao/1', SolutionOneController::class . ":pageSolution");
$app->get('/solucao/2', SolutionTwoController::class . ":pageSolution");
$app->get('/solucao/3', SolutionThreeController::class . ":pageSolution");
$app->get('/solucao/4', SolutionFourController::class . ":pageSolution");


// Rotas POST
$app->post('/solucao/one/create', SolutionOneController::class . ":createSolution");
$app->post('/solucao/one/read', SolutionOneController::class . ":readSolution");
$app->post('/solucao/one/delete', SolutionOneController::class . ":deleteSolution");
$app->post('/solucao/three/matriz', SolutionThreeController::class . ":matrizSolution");
$app->post('/solucao/four/fibonacci', SolutionFourController::class . ":fibonacciSolution");

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

    header("Location: " . PATH_SUB."/404");

    $arr = [
        "success" => false,
        "error" => "Esta ação não é permitida!"
    ];
    die(json_encode($arr));
}
