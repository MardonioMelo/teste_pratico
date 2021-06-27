<?php

namespace Src\View\Home;

use Src\View\DefaultView\DefaultView;

/**
 * Class para administrar view da home
 */
class HomeView extends DefaultView
{  
    public function __construct()
    {
        $this->setDirTpl();
    }

    /**
     * Método para povoar e retornar conteúdo da página home
     *
     * @param array $data
     * @return string
     */
    public function tplHomeView(array $data = []): string
    {
        $data = ["Teste Prático"];
        $name = [
            "{{title}}"         
        ];

        $this->setDataName($name);
        $this->setData($data);
        $this->setTplHtml("home/home");  
        return $this->getWrite();       
    }

}
