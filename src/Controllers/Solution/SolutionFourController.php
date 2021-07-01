<?php

namespace Src\Controllers\Solution;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Models\FibonacciModel;
use Src\View\Solution\SolutionFourView;

/**
 * Classe controller da solução Four
 */
class SolutionFourController
{

    private $solution_view;
    private $solution_model;

    /**
     * Set Model e View da solução Four
     */
    public function __construct()
    {
        $this->solution_view = new SolutionFourView();
        $this->solution_model = new FibonacciModel();
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
     * Computar e verificar sequência de números informados que fazem parte da sequência Fibonacci
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function fibonacciSolution(Request $request, Response $response, array $args)
    {
        // Get all POST parameters
        $params = (array)$request->getParsedBody();
        //Computar números
        $this->solution_model->isFibonacci(trim(strip_tags($params["seq_numbers"])));

        //Response
        $result = [];
        $result['result'] = $this->solution_model->getResult();
        $result['error'] = $this->solution_model->getError();

        $payload = $this->solution_view->encodeJson($result);
        $response->getBody()->write($payload);
        return $response;
    }
}
