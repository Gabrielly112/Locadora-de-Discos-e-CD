<?php
namespace Services;

use Models\{CD, Vinil, Disco};

class Locadora {
    private array $discos = [];

    public function __construct() {
        $this->carregarDiscos();
    }

    private function carregarDiscos(): void {
        if (file_exists(ARQUIVO_JSON)) {
            $dados = json_decode(file_get_contents(ARQUIVO_JSON), true);
            if (is_array($dados)) {
                foreach ($dados as $item) {
                    $disco = ($item['tipo'] === 'CD') 
                        ? new CD($item['titulo'], $item['artista']) 
                        : new Vinil($item['titulo'], $item['artista']);
                    $disco->setDisponivel($item['disponivel']);
                    $this->discos[] = $disco;
                }
            }
        }
    }

    private function salvarDiscos(): void {
        $dados = [];
        foreach ($this->discos as $disco) {
            $dados[] = [
                'tipo' => ($disco instanceof CD) ? 'CD' : 'Vinil',
                'titulo' => $disco->getTitulo(),
                'artista' => $disco->getArtista(),
                'disponivel' => $disco->isDisponivel()
            ];
        }
        $dir = dirname(ARQUIVO_JSON);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
    }

    public function adicionarDisco(Disco $disco): void {
        $this->discos[] = $disco;
        $this->salvarDiscos();
    }

    public function listarDiscos(): array {
        return $this->discos;
    }

    public function alugarDisco(string $titulo, int $dias): string {
        foreach ($this->discos as $disco) {
            if ($disco->getTitulo() === $titulo) {
                if ($disco->isDisponivel()) {
                    $mensagem = $disco->alugar();
                    $valor = $disco->calcularAluguel($dias);
                    $this->salvarDiscos();
                    return $mensagem . " Valor total: R$ " . number_format($valor, 2, ',', '.');
                }
                return "O disco '{$titulo}' não está disponível para aluguel.";
            }
        }
        return "Disco não encontrado.";
    }

    public function devolverDisco(string $titulo): string {
        foreach ($this->discos as $disco) {
            if ($disco->getTitulo() === $titulo) {
                $mensagem = $disco->devolver();
                $this->salvarDiscos();
                return $mensagem;
            }
        }
        return "Disco não encontrado.";
    }

    public function deletarDisco(string $titulo, string $artista): string {
        foreach ($this->discos as $index => $disco) {
            if ($disco->getTitulo() === $titulo && $disco->getArtista() === $artista) {
                unset($this->discos[$index]);
                $this->discos = array_values($this->discos);
                $this->salvarDiscos();
                return "Disco '{$titulo}' removido do acervo com sucesso!";
            }
        }
        return "Disco não encontrado.";
    }

    public function calcularPrevisaoAluguel(string $tipo, int $dias): float {
        if ($tipo === 'CD') {
            return $dias * VALOR_CD;
        } elseif ($tipo === 'Vinil') {
            return $dias * VALOR_VINIL;
        }
        return 0.0;
    }
}
