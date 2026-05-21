<?php
namespace Models;
use Interfaces\Alugavel;

/**
 * Classe que representa um CD no sistema
 */
class CD extends Disco implements Alugavel {
    public function calcularAluguel(int $dias): float {
        return $dias * VALOR_CD;
    }

    public function alugar(): string {
        if ($this->disponivel) {
            $this->disponivel = false;
            return "CD '{$this->titulo}' alugado com sucesso!";
        }
        return "CD '{$this->titulo}' não está disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel) {
            $this->disponivel = true;
            return "CD '{$this->titulo}' devolvido com sucesso!";
        }
        return "CD '{$this->titulo}' já está na locadora.";
    }
}