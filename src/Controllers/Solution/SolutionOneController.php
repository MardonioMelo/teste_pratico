<?php

namespace Src\Controllers\Solution;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\View\Solution\SolutionOneView;
use Src\Models\SolutionOneModel;

/**
 * Classe controller da solução One
 */
class SolutionOneController
{

    private $solution_view;
    private $solution_model;

    /**
     * Set Model e View da solução One
     */
    public function __construct()
    {
        $this->solution_view = new SolutionOneView();
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
    public function pageSolution(Request $request, Response $response, array $args)
    {
        $payload = $this->solution_view->tplSolution();
        $response->getBody()->write($payload);
        return $response;
    }

    /**
     * Criar e cadastrar solução do problema
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function createSolution(Request $request, Response $response, array $args)
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

    /**
     * Consultar os dados cadastrados
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function readSolution(Request $request, Response $response, array $args)
    {
        // Get all POST parameters
        $params = (array)$request->getParsedBody();
    
        $this->solution_model->readHistory(
            (int) strip_tags($params['limit']), 
            (int) strip_tags($params['offset']), 
            "altura_id DESC"
        );

        //Response
        $result = [];
        $result['result'] = $this->solution_model->getResult();
        $result['error'] = $this->solution_model->getError();

        $payload = $this->solution_view->encodeJson($result);
        $response->getBody()->write($payload);
        return $response;
    }

    /**
     * Deletar dados cadastrados
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function deleteSolution(Request $request, Response $response, array $args)
    {
        // Get all POST parameters
        $params = (array)$request->getParsedBody();
    
        $this->solution_model->deleteCadastro((int) strip_tags($params['cad']));

        //Response
        $result = [];
        $result['result'] = $this->solution_model->getResult();
        $result['error'] = $this->solution_model->getError();

        $payload = $this->solution_view->encodeJson($result);
        $response->getBody()->write($payload);
        return $response;
    }
}
