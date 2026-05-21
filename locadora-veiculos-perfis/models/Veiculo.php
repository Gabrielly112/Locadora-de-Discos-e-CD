<?php
namespace Models;
use Interfaces\Alugavel;

/**
 * Classe que representa um Vinil no sistema
 */
class Vinil extends Disco implements Alugavel {
    public function calcularAluguel(int $dias): float {
        return $dias * VALOR_VINIL;
    }

    public function alugar(): string {
        if ($this->disponivel) {
            $this->disponivel = false;
            return "Vinil '{$this->titulo}' alugado com sucesso!";
        }
        return "Vinil '{$this->titulo}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel) {
            $this->disponivel = true;
            return "Vinil '{$this->titulo}' devolvido com sucesso!";
        }
        return "Vinil '{$this->titulo}' já está na locadora.";
    }
}