<?php

namespace Src\Models;

use Src\Models\DataBase\TabAltura;

/**
 * Class responsável por gerenciar os dados do problema 1
 */
class  SolutionOneModel
{

    private $tab_altura;
    private $Error;
    private $Result;

    /**
     * Declara a classe TabAltura na inicialização
     */
    public function __construct()
    {
        $this->tab_altura = new TabAltura();
    }

    /**
     * Salva dados no banco de dados
     *
     * @param int $altura_chico
     * @param int $altura_juca
     * @param int $altura_estimativa
     * @return void
     */
    public function saveAltura(int $altura_chico, int $altura_juca, int $altura_estimativa): void
    {
        $this->tab_altura->altura_chico = (int) $altura_chico;
        $this->tab_altura->altura_juca = (int) $altura_juca;
        $this->tab_altura->altura_estimativa = (int) $altura_estimativa;

        $this->saveCreate();
    }

    /**
     * Calcular estimativa
     *
     * @param int $chico
     * @param int $juca
     * @return int
     */
    public function computTime(int $chico, int $juca): int
    {
        $qtd_ano = 0;

        while ($juca <= $chico) {
            $chico += 2;
            $juca += 3;
            $qtd_ano++;
        }       

        return $qtd_ano;
    }

    /**
     * Organizar dados ara envio  
     *
     * @param Object $obj
     * @return array
     */
    public function passeAllDataArray($obj): array
    {
        $result = [];

        if ($obj) {
            foreach ($obj as $key => $arr) {
                $result[$key]['altura_id'] = $arr->data()->altura_id;
                $result[$key]['altura_chico'] = $arr->data()->altura_chico;
                $result[$key]['altura_juca'] = $arr->data()->altura_juca;
                $result[$key]['altura_estimativa'] = $arr->data()->altura_estimativa;
                $result[$key]['updated_at'] = $arr->data()->altura_updated_at;
                $result[$key]['created_at'] = $arr->data()->altura_created_at;
            }
        }
        return $result;
    }

    /**
     * Consultar dados de um registro
     *
     * @param integer $id
     * @return null|Object
     */
    public function getCadastro(int $id)
    {
        if ($this->tab_altura->findById($id)) {
            return $this->tab_altura->findById($id)->data();
        } else {
            return false;
        }
    }

    /**
     * <b>Verificar Ação:</b> Retorna TRUE se ação for efetuada ou FALSE se não. Para verificar erros
     * execute um getError();
     * @return string $Var = True(com o id) or False
     */
    public function getResult(): string
    {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um string com o erro.
     * @return string $Error = String com o erro
     */
    public function getError(): string
    {
        return $this->Error;
    }

    /**
     * Salvar dados no banco de dados
     *
     * @return string
     */
    private function saveCreate(): void
    {
        $id = $this->tab_altura->save();

        if ((int)$id > 0) {
            $this->Result = $this->tab_altura->altura_id;
            $this->Error = "Cadastro realizado com sucesso!";
        } else {
            $this->Result = $id;
            $this->Error = $this->tab_altura->fail()->getMessage();
        }
    }
}
