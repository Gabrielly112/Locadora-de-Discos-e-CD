<?php
namespace Models;

/**
 * Classe abstrata base para todos os tipos de discos
 */
abstract class Disco {
    protected string $titulo;
    protected string $artista;
    protected bool $disponivel;

    public function __construct(string $titulo, string $artista) {
        $this->titulo = $titulo;
        $this->artista = $artista;
        $this->disponivel = true;
    }

    /**
     * Calcula o valor do aluguel baseado na quantidade de dias
     */
    abstract public function calcularAluguel(int $dias): float;

    public function isDisponivel(): bool {
        return $this->disponivel;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getArtista(): string {
        return $this->artista;
    }

    public function setDisponivel(bool $disponivel): void {
        $this->disponivel = $disponivel;
    }
}