<?php

namespace Src\Models\DataBase;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Class responsável pela tabela tab_altura
 */
class TabAltura extends DataLayer
{
    private $Error;
    private $Result;

    /**
     * Constructor.
     */
    public function __construct()
    {
        //string "TABLE_NAME", array ["REQUIRED_FIELD_1", "REQUIRED_FIELD_2"], string "PRIMARY_KEY", bool "TIMESTAMPS"
        parent::__construct(
            "tab_altura",
            [
                "altura_chico",
                "altura_juca",
                "altura_estimativa"
            ],
            "altura_id",
            true
        );
    }    

    /**
     * Consulta todos os dados da tabela
     *
     * @return void
     */
    public function readAll()
    {
        $read = $this->find()->fetch(true);

        if ($read) {
            $this->Result = $read;
            $this->Error = "Sucesso!";
        } else {
            $this->Result = false;
            $this->Error = "Não foi possível consultar!";
        }
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
