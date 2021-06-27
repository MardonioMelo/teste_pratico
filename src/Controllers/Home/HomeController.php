<?php

namespace Src\Controllers\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\View\Home\HomeView;

/**
 * Classe controller principal da API
 */
class HomeController
{   

    private $home_view;

    public function __construct()
    {
       $this->home_view = new HomeView();
    }

    /**
     * Executa pagina index
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function home(Request $request, Response $response, array $args)
    {
        $payload = $this->home_view->tplHomeView();
        $response->getBody()->write($payload);
        return $response;
    }    
    
}
