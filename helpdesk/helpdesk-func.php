<?php
    $caminho = __DIR__ . "/chamados.json";

    $json = file_get_contents($caminho);

    $chamados = json_decode($json, true);

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        function cadastrarChamado($chamados, $dados, $caminho) {
            if (empty($dados["nome_funcionario"]) || empty($dados["problema_desc"])) {
                return false;
            }
        
            $novoChamado = [
                "nome_funcionario" => $dados["nome_funcionario"],
                "setor" => $dados["setor"],
                "equipamento" => $dados["equipamento"],
                "status" => "Aberto",
                "problema_desc" => $dados["problema_desc"],
                "prioridade" => $dados["prioridade"]
            ];
        
            $chamados[] = $novoChamado;
        
            $jsonAtualizado = json_encode(
                $chamados,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        
            return file_put_contents($caminho, $jsonAtualizado) !== false;
        }

        function atualizarChamado($chamados, $posicao, $novoStatus, $caminho) {
            if (
                !in_array($novoStatus, ["Aberto", "Em andamento", "Resolvido"], true)
                || !isset($chamados[$posicao])
            ) {
                return false;
            }
        
            $chamados[$posicao]["status"] = $novoStatus;
        
            $jsonAtualizado = json_encode(
                $chamados,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        
            return file_put_contents($caminho, $jsonAtualizado) !== false;
        }
    }