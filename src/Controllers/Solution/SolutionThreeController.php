<?php

namespace Src\Controllers\Solution;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\View\Solution\SolutionThreeView;

/**
 * Classe controller da solução Two
 */
class SolutionThreeController
{

    private $solution_view;

    /**
     * Set Model e View da solução Two
     */
    public function __construct()
    {
        $this->solution_view = new SolutionThreeView();
    }

    /**
     * Executa pagina index
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function pageSolution(Request $request, Response $response, array $args)
    {
        $payload = $this->solution_view->tplSolution();
        $response->getBody()->write($payload);
        return $response;
    }

    /**
     * Gerar matriz
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function matrizSolution(Request $request, Response $response, array $args)
    {
        // Get all POST parameters
        $params = (array)$request->getParsedBody();

        $this->solution_model->gerarMatriz($params["n_matriz"]);

        //Response
        $result = [];
        $result['result'] = $this->solution_model->getResult();
        $result['error'] = $this->solution_model->getError();

        $payload = $this->solution_view->encodeJson($result);
        $response->getBody()->write($payload);
        return $response;
    }
}
