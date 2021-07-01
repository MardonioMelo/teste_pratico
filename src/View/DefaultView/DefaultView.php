<?php

namespace Src\View\DefaultView;

/**
 * Class para administrar view geral
 */
class DefaultView
{
    private $dir_tlp;
    private $tpl;
    private $data;
    private $data_var;
    private $path;

    public function __construct()
    {
        $this->setDirTpl();
        $this->path = PATH_SUB !== "" ? PATH_SUB . "/" : "";
    }

    /**
     * Set diretório principal dos templates
     *
     * @param string $dir_tlp
     * @return void
     */
    public function setDirTpl(string $dir_tlp = ""): void
    {
        if (empty($dir_tlp)) {
            $this->dir_tlp = "../src/resources/";
        } else {
            $this->dir_tlp = $dir_tlp;
        }
    }

    /**
     * Obter path padrão
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Método para povoar e retornar conteúdo da página
     *
     * @param string $navbar
     * @param string $content
     * @param string $footer
     * @param string $scriptjs
     * @param string $path
     * @return string
     */
    public function tplView($navbar = "",  $content = "",  $footer = "",  $scriptjs = "",  $path = ""): string
    {
        return $this->page(
            $this->head(),
            $this->body(
                ["navbar", "content", "footer", "scriptjs", "path"],
                [$navbar, $content, $footer, $scriptjs, $path]
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
     * Método para escrever conteúdo povoado da página
     *
     * @return string
     */
    public function getWrite(): string
    {
        return str_replace($this->data_var, $this->data, $this->tpl);
    }

    /**
     * Método para escrever tpl com conteúdo povoado
     *
     * @return void
     */
    public function write(): void
    {
        echo str_replace($this->data_var, $this->data, $this->tpl);
    }

    /**
     * Set dados da tpl passados em um array
     *
     * @param array $arr
     * @return void
     */
    public function setData(array $arr): void
    {
        $this->data = $arr;
    }

    /**
     * Set nome das variáveis da tpl a serem substituídas
     *
     * @param array $arr
     * @return void
     */
    public function setDataName(array $arr): void
    {
        $this->data_var = array_map(function ($str) {
            return '{{' . $str . '}}';
        }, $arr);
    }

    /**
     * Set template Html - Informe o nome do template e a extensão caso não seja um tpl html
     *
     * @param string $tpl
     * @param string $ext
     * @return void
     */
    public function setTplHtml($tpl, $ext = ".html"): void
    {
        $this->tpl = file_get_contents($this->dir_tlp . $tpl . $ext);
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
