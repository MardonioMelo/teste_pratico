<?php

namespace Src\View\Solution;

use Src\View\DefaultView\DefaultView;

/**
 * Class para administrar view das solução Three
 */
class SolutionThreeView extends DefaultView
{
    private $path;

    public function __construct()
    {
        $this->setDirTpl();
        $this->path = PATH_SUB !== "" ? PATH_SUB . "/" : "";
    }

    /**
     * Método para povoar e retornar conteúdo da página
     *
     * @param array $data
     * @return string
     */
    public function tplSolution(): string
    {
        return $this->page(
            $this->head(),
            $this->body(
                ["navbar", "content", "footer", "scriptjs", "path"],
                [$this->navbar(), $this->content(), $this->footer(), "solution_three", $this->path]
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
            "Soluções - Teste Prático",
            "Teste Prático para vaga de desenvolvedor back-end",
            $this->path
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
            $this->path
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
        $this->setTplHtml("solution/content_three");
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

    /**
     * Formatar dados para retorno json
     *
     * @param array|objeto $arr
     * @return string
     */
    public function encodeJson($arr): string
    {
        return json_encode($arr);
    }
}
