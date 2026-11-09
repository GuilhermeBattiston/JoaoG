<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HelpdeskController extends Controller
{
    public function index(Chamado $model): View
    {
        return view('projetos.helpdesk', [
            'chamados' => $model->lerChamados(),
            'relatorio' => $model->gerarRelatorio(),
            'mensagem' => session('mensagem', ''),
        ]);
    }

    public function salvar(Request $request, Chamado $model): RedirectResponse
    {
        $dados = $request->validate([
            'acao' => ['required', Rule::in(['cadastrar', 'atualizar', 'excluir'])],
            'nome' => ['required_if:acao,cadastrar', 'string', 'max:100'],
            'setor' => ['required_if:acao,cadastrar', Rule::in(['producao', 'administrativo', 'logistica', 'financeiro', 'ti'])],
            'equipamento' => ['required_if:acao,cadastrar', Rule::in(['computador', 'impressora', 'rede', 'sistema', 'outro'])],
            'descricao' => ['required_if:acao,cadastrar', 'string', 'max:5000'],
            'prioridade' => ['required_if:acao,cadastrar', Rule::in(['baixa', 'media', 'alta'])],
            'posicao' => ['required_unless:acao,cadastrar', 'integer', 'min:0'],
            'status' => ['required_if:acao,atualizar', Rule::in(['Aberto', 'Em andamento', 'Resolvido'])],
        ]);

        $sucesso = match ($dados['acao']) {
            'cadastrar' => $model->cadastrarChamados($dados['nome'], $dados['setor'], $dados['equipamento'], $dados['descricao'], $dados['prioridade']),
            'atualizar' => $model->atualizarChamado((int) $dados['posicao'], $dados['status']),
            'excluir' => $model->excluirChamado((int) $dados['posicao']),
        };

        return to_route('helpdesk')->with('mensagem', $sucesso
            ? 'Operação realizada com sucesso!'
            : 'Não foi possível realizar a operação.');
    }
}
