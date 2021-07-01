<?php

namespace Src\Models;

/**
 * Class para verificar números validos da sequencia Fibonacci
 */
class FibonacciModel
{
    private $n_validos;
    private $text_compl;

    /**
     * init atributo
     */
    public function __construct()
    {
        $this->n_validos = [];
        $this->text_desc = "";
    }

    /**
     * Tratar e verificar a sequencia de números informados e se fazem parte da sequência Fibonacci.
     *
     * @param string $seq_numbers
     * @return void
     */
    public function isFibonacci(string $seq_numbers): void
    {
        $this->checkSequenceInput($seq_numbers);

        if (!empty($this->n_validos)) {          
            $this->Result = true;
            $this->Error['seq'] = "Números Válidos: ".implode(", ", array_unique($this->n_validos)).".";
            $this->Error['text'] = "Números válidos da sequência Fibonacci em ordem crescente.";
            $this->Error['text_desc'] = $this->text_desc;
        } else {          
            $this->Result = false;
            $this->Error['error']['text'] = "Nenhum dos números fazem parte da sequência Fibonacci.";
        };      
    }

    /**
     * Checar os números validos da sequencia Fibonacci.
     *
     * @param string $i_input
     * @return void
     */
    public function checkSequenceInput(string $i_input)
    {
        $i_arr = explode(",", $i_input);
        asort($i_arr);

        foreach ($i_arr as $i) {

            $n1 = 0;
            $n2 = 1;
            $n3 = 0;
            $i = (int)$i;

            while ($i > $n3) {
                $n3 = $n1 + $n2;
                $n1 = $n2;
                $n2 = $n3;
            };

            if ($i == 0) {
                $this->text_desc .= "<li><i class='fa fa-check'></i> O número 0 está na sequência e o próximo número é 1,</li>";
                $this->n_validos[] = $i;
            } elseif ($i == $n3) {
                $this->text_desc .= "<li><i class='fa fa-check'></i> O numero " . $n3 . " está na sequencia e o próximo número é " . ($n1 + $i).",</li>";
                $this->n_validos[] = $i;
            } else {
                $this->text_desc .= "<li><i class='fa fa-exclamation-triangle'></i> O numero " . $i . " não faz parte.</li>";
            };
        };

        ksort($this->n_validos);
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
