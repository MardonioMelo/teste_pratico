<?php

namespace Src\Controllers\Solution;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Models\SolutionThreeModel;
use Src\View\Solution\SolutionThreeView;

/**
 * Classe controller da solução Three
 */
class SolutionThreeController
{

    private $solution_view;
    private $solution_model;

    /**
     * Set Model e View da solução Three
     */
    public function __construct()
    {
        $this->solution_view = new SolutionThreeView();
        $this->solution_model = new SolutionThreeModel();
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
        //Gerar matriz
        $this->solution_model->gerarMatriz((int) str_replace(".", "", trim(strip_tags($params["n_max"]))));

        //Response
        $result = [];
        $result['result'] = $this->solution_model->getResult();
        $result['error'] = $this->solution_model->getError();

        $payload = $this->solution_view->encodeJson($result);
        $response->getBody()->write($payload);
        return $response;
    }
}
