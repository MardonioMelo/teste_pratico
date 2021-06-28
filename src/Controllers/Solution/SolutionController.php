<?php

namespace Src\Controllers\Solution;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\View\Solution\SolutionView;
use Src\Models\SolutionOneModel;

/**
 * Classe controller das soluções
 */
class SolutionController
{

    private $solution_view;
    private $solution_model;


    public function __construct()
    {
        $this->solution_view = new SolutionView();
        $this->solution_model = new SolutionOneModel();
    }

    /**
     * Executa pagina index
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function pageSolutionOne(Request $request, Response $response, array $args)
    {
        $payload = $this->solution_view->tplSolutionOne();
        $response->getBody()->write($payload);
        return $response;
    }

    /**
     * Criar e cadastrar solução do problema 1
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function createSolutionOne(Request $request, Response $response, array $args)
    {
        // Get all POST parameters
        $params = (array)$request->getParsedBody();

        // Get a single POST parameter
        $chico = (int) str_replace(",", "", strip_tags($params['chico']));
        $juca = (int) str_replace(",", "", strip_tags($params['juca']));
        $estimativa = (int) $this->solution_model->computTime($chico, $juca);
        $this->solution_model->saveAltura($chico, $juca, $estimativa);

        //Response
        $result = [];
        $result['result'] = $this->solution_model->getResult();
        $result['error'] = $this->solution_model->getError();
        $result['estimativa'] = $estimativa;       

        $payload = $this->solution_view->encodeJson($result);
        $response->getBody()->write($payload);
        return $response;
    }
}
