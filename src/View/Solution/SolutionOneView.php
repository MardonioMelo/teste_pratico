<?php

namespace Src\View\Solution;

use Src\View\DefaultView\DefaultView;

/**
 * Class para administrar view das solução One
 */
class SolutionOneView extends DefaultView
{     

    /**
     * Método para povoar e retornar conteúdo da página
     *    
     * @return string
     */
    public function tplSolution(): string
    {
        return $this->tplView($this->navbar(), $this->content(), $this->footer(), "solution_one", $this->getPath());       
    }

    /**
     * Montar content da página
     *
     * @return string
     */
    public function content(): string
    {
        $this->setTplHtml("solution/content_one");
        return $this->getWrite();
    } 

}
