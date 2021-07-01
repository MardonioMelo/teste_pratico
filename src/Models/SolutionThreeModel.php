<?php

namespace Src\Models;

/**
 * Class responsável por gerenciar o Model da solução Three
 */
class  SolutionThreeModel
{
    private $Error;
    private $Result;


    /**
     * Gerar matriz
     *    
     * @return int
     */
    public function gerarMatriz(int $n_max)
    {
        $matriz = [];
        for ($i = 0; $i < 5; $i++) {

            for ($i2 = 0; $i2 < 5; $i2++) {
                $matriz2[$i2] = rand(1, $n_max);
                $matriz_impar2[$i2] = $this->checkPar($matriz2[$i2]);
                $matriz_par2[$i2] = $this->checkImpar($matriz2[$i2]);
            }
            $matriz[$i] = $matriz2;
            $matriz_impar[$i] = $matriz_impar2;
            $matriz_par[$i] = $matriz_par2;
        }

        if (!empty($matriz) && count($matriz) === 5) {
            $this->Result = true;
            $this->Error['error'] = "Sucesso!";
            $this->Error['matriz'] = $matriz;
            $this->Error['matriz_impar'] = $matriz_impar;
            $this->Error['matriz_par'] = $matriz_par;
        } else {
            $this->Result = false;
            $this->Error['error'] = "Não foi possível criar a matriz!";
        }
    }

    /**
     * Verificar se o número é par, se for retorna o numero, se não, retorna "- 
     *
     * @param integer $var
     * @return mixed
     */
    public function checkPar(int $var)
    {
        return $var % 2 == 0 ? $var : "-";
    }

    /**
     * Verificar se o número é impar, se for, retorna o número, se não, retorna "-" 
     *
     * @param integer $var
     * @return mixed
     */
    public function checkImpar(int $var)
    {
        return $var % 2 == 0 ?  "-" : $var;
    }

    /**
     * Verificar Ação.
     * @return bool
     */
    public function getResult(): bool
    {
        return $this->Result;
    }

    /**
     * Obter Erro. 
     * @return array
     */
    public function getError(): array
    {
        return $this->Error;
    }
}
