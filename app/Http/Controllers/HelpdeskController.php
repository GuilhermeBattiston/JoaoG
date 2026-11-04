<?php
 
require_once __DIR__ . "/../../Models/Chamado.php";
 
class HelpdeskController
{
    // GET - Exibir a página do Helpdesk
    public function index()
    {
        $model = new Chamado();
 
        $chamados = $model->lerChamados();
        $relatorio = $model->gerarRelatorio();
 
        $mensagem = "";
 
        require __DIR__ . "/../../../resources/Views/projetos/helpdesk.php";
    }
 
    // POST - Receber os formulários do Helpdesk
    public function salvar()
    {
        $model = new Chamado();
 
        $acao = $_POST["acao"] ?? "";
        $sucesso = false;
 
        if ($acao === "cadastrar") {
            $sucesso = $model->cadastrarChamados(
                $_POST["nome"] ?? "",
                $_POST["setor"] ?? "",
                $_POST["equipamento"] ?? "",
                $_POST["descricao"] ?? "",
                $_POST["prioridade"] ?? ""
            );
        }
 
        elseif ($acao === "atualizar") {
            $sucesso = $model->atualizarChamado(
                (int) ($_POST["posicao"] ?? -1),
                $_POST["status"] ?? ""
            );
        }
 
        elseif ($acao === "excluir") {
            $sucesso = $model->excluirChamado(
                (int) ($_POST["posicao"] ?? -1)
            );
        }
 
        // Mensagem de retorno para o usuário
        $mensagem = $sucesso
            ? "Operação realizada com sucesso!"
            : "Não foi possível realizar a operação.";
 
        // Atualizar os dados após a operação
        $chamados = $model->lerChamados();
        $relatorio = $model->gerarRelatorio();
 
        require __DIR__ . "/../../../resources/Views/projetos/helpdesk.php";
    }
}