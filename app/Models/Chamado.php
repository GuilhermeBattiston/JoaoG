<?php

namespace App\Models;

use Closure;
use RuntimeException;

class Chamado
{
    private string $arquivo;

    public function __construct()
    {
        $this->arquivo = storage_path('app/chamados.json');
    }

    private function acessarArquivo(int $modo, Closure $operacao): mixed
    {
        $diretorio = dirname($this->arquivo);
        if (! is_dir($diretorio) && ! mkdir($diretorio, 0755, true) && ! is_dir($diretorio)) {
            throw new RuntimeException('Não foi possível criar o diretório de chamados.');
        }
        $arquivo = fopen($this->arquivo, 'c+');
        if ($arquivo === false) {
            throw new RuntimeException('Não foi possível abrir o arquivo de chamados.');
        }
        try {
            if (! flock($arquivo, $modo)) {
                throw new RuntimeException('Não foi possível bloquear o arquivo de chamados.');
            }
            $conteudo = stream_get_contents($arquivo);
            $chamados = $conteudo === '' ? [] : json_decode($conteudo, true, 512, JSON_THROW_ON_ERROR);
            if (! is_array($chamados) || ! array_is_list($chamados) || count(array_filter($chamados, 'is_array')) !== count($chamados)) {
                throw new RuntimeException('O arquivo de chamados não contém uma lista válida.');
            }
            $resultado = $operacao($chamados);
            if ($modo === LOCK_EX && $resultado === true) {
                $json = json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
                rewind($arquivo);
                if (! ftruncate($arquivo, 0) || fwrite($arquivo, $json) !== strlen($json) || ! fflush($arquivo)) {
                    throw new RuntimeException('Não foi possível salvar os chamados.');
                }
            }

            return $resultado;
        } finally {
            flock($arquivo, LOCK_UN);
            fclose($arquivo);
        }
    }

    public function lerChamados(): array
    {
        return $this->acessarArquivo(LOCK_SH, fn (array $chamados): array => $chamados);
    }

    public function salvarChamados(array $chamados): bool
    {
        return $this->acessarArquivo(LOCK_EX, function (array &$atuais) use ($chamados): bool {
            $atuais = array_values($chamados);

            return true;
        });
    }

    public function cadastrarChamados(string $nome, string $setor, string $equipamento, string $descricao, string $prioridade): bool
    {
        if (trim($nome) === '' || trim($descricao) === '') {
            return false;
        }

        return $this->acessarArquivo(LOCK_EX, function (array &$chamados) use ($nome, $setor, $equipamento, $descricao, $prioridade): bool {
            $chamados[] = ['nome' => trim($nome), 'setor' => $setor, 'equipamento' => $equipamento, 'descricao' => trim($descricao), 'prioridade' => $prioridade, 'status' => 'Aberto'];

            return true;
        });
    }

    public function atualizarChamado(int $posicao, string $novoStatus): bool
    {
        if (! in_array($novoStatus, ['Aberto', 'Em andamento', 'Resolvido'], true)) {
            return false;
        }

        return $this->acessarArquivo(LOCK_EX, function (array &$chamados) use ($posicao, $novoStatus): bool {
            if (! isset($chamados[$posicao])) {
                return false;
            }
            $chamados[$posicao]['status'] = $novoStatus;

            return true;
        });
    }

    public function excluirChamado(int $posicao): bool
    {
        return $this->acessarArquivo(LOCK_EX, function (array &$chamados) use ($posicao): bool {
            if (! isset($chamados[$posicao])) {
                return false;
            }
            unset($chamados[$posicao]);
            $chamados = array_values($chamados);

            return true;
        });
    }

    public function gerarRelatorio(): array
    {
        $chamados = $this->lerChamados();
        $relatorio = ['total' => count($chamados), 'abertos' => 0, 'andamento' => 0, 'resolvidos' => 0];
        $categorias = ['Aberto' => 'abertos', 'Em andamento' => 'andamento', 'Resolvido' => 'resolvidos'];
        foreach ($chamados as $chamado) {
            $categoria = $categorias[$chamado['status'] ?? ''] ?? null;
            if ($categoria !== null) {
                $relatorio[$categoria]++;
            }
        }

        return $relatorio;
    }
}
