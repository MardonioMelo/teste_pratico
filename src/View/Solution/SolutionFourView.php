<?php

namespace Src\View\Solution;

use Src\View\DefaultView\DefaultView;

/**
 * Class para administrar view das solução Four
 */
class SolutionFourView extends DefaultView
{

    /**
     * Método para povoar e retornar conteúdo da página
     *   
     * @return string
     */
    public function tplSolution(): string
    {
        return $this->tplView($this->navbar(), $this->content(), $this->footer(), "solution_four", $this->getPath());
    }

    /**
     * Montar content da página
     *
     * @return string
     */
    public function content(): string
    {
        $this->setTplHtml("solution/content_four");
        return $this->getWrite();
    }
}
