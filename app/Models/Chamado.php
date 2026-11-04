<?php

    class Chamado{

        //READ - Ler todos os chamados 
        public function lerChamados() {
            $arquivo = __DIR__ . "/../../storage/data/chamados.json";

            //verificação se o arquivo .json já existe
            if (!file_exists($arquivo)) {
                file_put_contents($arquivo, "[]");
            }

            // Ler o arquivo
            $conteudo = file_get_contents($arquivo);

            // Converter o JSON para Array PHP
            $chamados = json_decode($conteudo, true);

            return is_array($chamados) ? $chamados : [];

            // if (is_array($chamados)) {
            //     $chamados;
            // } else {
            //     [];
            // }
        }


        //Salvar os chamados no JSON
        public function salvarChamados($chamados) {
            $arquivo = __DIR__ . "/../../storage/data/chamados.json";

            return file_put_contents(
                $arquivo, json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            ) !== false;
        }

        //CREATE - Cadastrar chamados
        public function cadastrarChamados($nome, $setor, $eqipamento, $descricao, $prioridade) {
            if (trim($nome) === "" || trim($descricao) === "") {
                return false;
            }

            $chamados = $this->lerChamados();
            
            $novoChamado = [
                "nome" => trim($nome),
                "setor" => $setor,
                "equipamento" => $eqipamento,
                "descricao" => trim($descricao),
                "prioridade" => $prioridade,
                "status" => "Aberto"
            ];

            $chamados[] = $novoChamado;

            return $this->salvarChamados($chamados);
        }

        //UPDATE - Atualizar status do chamado
        public function atualizarChamado($posicao, $novoStatus) {
            $chamados = $this->lerChamados();

            $statusPermitidos = [
                "Aberto",
                "Em andamento",
                "Resolvido"
            ];

            //isset() verefica se uma variável ou posição existe e não contém null.
            // O ! inverte o resultado.
            // Portanto:
            // "Se não existir um chamado naquela posição, encerre a função retornando false

            if (!isset($chamados[$posicao])) {
                return false;
            }

            // in_array() verefica se um valor existe dentro de um array.
            // Nesse caso:
            // - $novoStatus: valor que queremos procurar.
            // - $statusPermitidos: lista de valores aceitos.
            // - true: exige comparação estrita.
            // O ! significa que a condição será verdadeira quando o valor não estiver na lista.

            if (!in_array($novoStatus, $statusPermitidos, true)) {
                return false;
            }

            $chamados[$posicao]["status"] = $novoStatus;

            return $this->salvarChamados($chamados);
        }

        //DELETE - Excluir chamados
        public function excluirChamado($posicao) {
            $chamados = $this->lerChamados();

            if (!isset($chamados[$posicao])) {
                return false;
            }

            // DELETAR AQUELA POSIÇÃO ESPECIFICA
            unset($chamados[$posicao]);


            // ATUALIZAR A LISTA DE CHAMADOS EM ARRAY
            $chamados = array_values($chamados);

            //SALVAR OS CHAMADOS NOVAMENTE PELA FUNÇÃO salvarChamados
            return $this->salvarChamados($chamados);
        }

        //Relatório de atendimentos
        public function gerarRelatorio() {
            $chamados = $this->lerChamados();

            $relatorio = [
                "total" => count($chamados),
                "abertos" => 0,
                "andamento" => 0,
                "resolvidos" => 0
            ];

            foreach ($chamados as $chamado) {
                if ($chamado["status"] === "Aberto") {
                    $relatorio["abertos"]++;
                } elseif ($chamado["status"] === "Em andamento") {
                    $relatorio["andamento"]++;
                } elseif ($chamado["status"] === "Resolvido") {
                    $relatorio["resolvidos"]++;
                }
            }

            return $relatorio;
        }
    }
?>
