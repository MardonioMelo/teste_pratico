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
     * Método para povoar e retornar conteúdo da página
     *
     * @param array $data
     * @return string
     */
    public function tplHomeView(): string
    {      
        return $this->page(
            $this->head(),
            $this->body(
                ["navbar", "content", "footer", "scriptjs", "path"],
                [$this->navbar(), $this->content(), $this->footer(), "home", ""]
            )
        );
    }

    /**
     * Montar Head da página
     *
     * @return string
     */
    public function head(): string
    {
        $this->setDataName([
            "title",
            "description",
            "path"
        ]);
        $this->setData([
            "Teste Prático",
            "Teste Prático para vaga de desenvolvedor back-end",
            ""
        ]);
        $this->setTplHtml("default/head");
        return $this->getWrite();
    }

    /**
     * Montar Navbar da página
     *
     * @return string
     */
    public function navbar(): string
    {
        $this->setDataName([          
            "path"
        ]);
        $this->setData([          
            ""
        ]);
        $this->setTplHtml("default/navbar");
        return $this->getWrite();
    }

    /**
     * Montar content da página
     *
     * @return string
     */
    public function content(): string
    {
        $this->setTplHtml("home/content");
        return $this->getWrite();
    }

    /**
     * Montar footer da página
     *
     * @return string
     */
    public function footer(): string
    {
        $this->setTplHtml("default/footer");
        return $this->getWrite();
    }

    /**
     * Montar uma lista
     *
     * @return string
     */
    public function todoList(array $keys, array $data, $tpl): string
    {
        $this->setDataName($keys);
        $this->setTplHtml($tpl);

        $result = "";
        foreach ($data as $item) {
            $this->setData($item);
            $result .= $this->getWrite();
        };

        return $result;
    }

    /**
     * Montar body da página
     *
     * @param array $keys
     * @param array $data
     * @return string
     */
    public function body(array $keys, array $data): string
    {
        $this->setDataName($keys);
        $this->setData($data);
        $this->setTplHtml("default/body");
        return $this->getWrite();
    }

    /**
     * Montar página
     *
     * @param string $head
     * @param string $body
     * @return string
     */
    public function page(string $head, string $body): string
    {
        $this->setDataName(["head", "body"]);
        $this->setData([$head, $body]);
        $this->setTplHtml("default/index");
        return $this->getWrite();
    }
}
