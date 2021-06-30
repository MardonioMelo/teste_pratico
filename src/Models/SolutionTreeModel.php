<?php

namespace Src\Models;

/**
 * Class responsável por gerenciar o Model da solução Treen
 */
class  SolutionTreeModel
{  
    private $Error;
    private $Result;   
   

    /**
     * gerar matriz
     *
     * @param int $chico
     * @param int $juca
     * @return int
     */
    public function gerarMatriz(int $matriz)
    {
        

      
    }
  
    /**
     * Verificar Ação. Para verificar erros execute um getError();
     * @return bool|array|object|string
     */
    public function getResult()
    {
        return $this->Result;
    }

    /**
     * Obter Erro. Retorna um string com o erro.
     * @return string
     */
    public function getError(): string
    {
        return $this->Error;
    }
}
