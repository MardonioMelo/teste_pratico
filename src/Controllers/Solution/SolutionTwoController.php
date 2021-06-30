<?php

namespace Src\Controllers\Solution;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\View\Solution\SolutionTwoView;

/**
 * Classe controller da solução Two
 */
class SolutionTwoController
{

    private $solution_view; 

    /**
     * Set Model e View da solução Two
     */
    public function __construct()
    {
        $this->solution_view = new SolutionTwoView();   
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
}
