<?php

namespace Src\Models;

use Src\Models\DataBase\TabAltura;

/**
 * Class responsável por gerenciar o Model da solução One
 */
class  SolutionOneModel
{

    private $tab_altura;
    private $Error;
    private $Result;

    /**
     * Set class de abstração do banco de dados
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
                $result[$key]['updated_at'] = $arr->data()->updated_at;
                $result[$key]['created_at'] = $arr->data()->created_at;
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
     * Consultar histórico de registros
     *
     * @param integer $limit
     * @param integer $offset
     * @param string $order
     * @return void
     */
    public function readHistory(int $limit, int $offset, string $order): void
    {
        $history = $this->tab_altura->find()->limit($limit)->offset($offset)->order($order)->fetch(true);

        if ($history) {
            $this->Result = $this->passeAllDataArray($history);
            $this->Error = "Sucesso!";
        } else {
            $this->Result = false;
            $this->Error = "Ainda não existem cadastros realizados!";
        }
    }

    /**
     * Consultar dados de um registro
     *
     * @param integer $id
     * @return null|Object
     */
    public function deleteCadastro(int $id)
    {
        $cad = $this->tab_altura->find("altura_id = :id", "id=" . $id)->fetch(true);
        if ($cad) {
            $this->Result = $cad[0]->destroy();
            $this->Error = "Sucesso!";
        } else {
            $this->Result = false;
            $this->Error = "O cadastro não existe ou já foi excluído!";
        }
    }

    /**
     * Verificar Ação. 
     * @return bool|array|object|string
     */
    public function getResult()
    {
        return $this->Result;
    }

    /**
     * Obter Erro.
     * @return string
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
