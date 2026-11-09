<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProjetoController extends Controller
{
    public function exibir(Request $request, string $projeto): View|RedirectResponse
    {
        $dados = [];
        if ($request->isMethod('post')) {
            if ($projeto === 'idade') {
                $dados = $request->validate(['name' => ['required', 'string', 'max:100'], 'idade' => ['required', 'integer', 'between:0,150']]);
                $dados['nome'] = $dados['name'];
                $dados['resultado'] = $dados['idade'] >= 18 ? 'maior de idade' : 'menor de idade';
            } elseif ($projeto === 'notas') {
                $regras = ['name' => ['required', 'string', 'max:100'], 'idade' => ['required', 'integer', 'between:1,150'], 'frequencia' => ['required', 'numeric', 'between:0,100']];
                foreach (range(1, 5) as $numero) {
                    $regras['nota'.$numero] = ['required', 'numeric', 'between:0,10'];
                }
                $dados = $request->validate($regras);
                $dados['nome'] = $dados['name'];
                $media = ($dados['nota1'] * 2 + $dados['nota2'] * 3 + $dados['nota3'] + $dados['nota4'] + $dados['nota5'] * 3) / 10;
                $dados['media'] = $media;
                [$dados['resultado'], $dados['resultado_class']] = match (true) {
                    $dados['frequencia'] < 75 => ['Reprovado por frequência', 'reprovado_frequencia'],
                    $media == 10 => ['Aprovado com excelência!', 'excelencia'],
                    $media >= 7 => ['Aprovado', 'aprovado'],
                    $media >= 5 => ['Recuperação', 'recuperar'],
                    default => ['Reprovado', 'reprovado'],
                };
                $dados['pontos'] = max(0, 7 - $media);
            } elseif (in_array($projeto, ['login-basico', 'jogos'], true)) {
                $regras = ['usuario' => ['required', 'string'], 'senha' => ['required', 'string']];
                if ($projeto === 'jogos') {
                    $regras += ['nome' => ['required', 'string', 'max:100'], 'genero' => ['required', 'string', 'max:50'], 'nota' => ['required', 'integer', 'between:0,10'], 'ano_lancamento' => ['required', 'integer', 'between:1950,2100']];
                }
                $entrada = $request->validate($regras);
                // These credentials belong only to the educational login demonstration.
                if ($entrada['usuario'] !== 'alunosenai' || $entrada['senha'] !== 'senhasenai') {
                    return back()->withErrors(['usuario' => 'Usuário ou senha incorretos!']);
                }
                if ($projeto === 'jogos') {
                    DB::table('jogos')->insert(array_intersect_key($entrada, array_flip(['nome', 'genero', 'nota', 'ano_lancamento'])));

                    return to_route('jogos')->with('mensagem', 'Jogo cadastrado!');
                }
                $dados['mensagem'] = 'Login realizado com sucesso!';
            } elseif ($projeto === 'poo2') {
                $entrada = $request->validate(['nome' => ['required', 'string', 'max:100'], 'tipo' => ['required', Rule::in(['esteira', 'prensa', 'robosoldagem'])], 'quantidade' => ['required', 'integer', 'min:1', 'max:2147483647']]);
                $maquinas = $request->session()->get('maquinas', []);
                $maquinas[] = $entrada;
                $request->session()->put('maquinas', $maquinas);

                return to_route('poo2')->with('mensagem', 'Máquina cadastrada com sucesso!');
            }
        }
        if ($projeto === 'jogos') {
            $dados['jogos'] = DB::table('jogos')->orderBy('id')->get()->map(fn ($jogo) => (array) $jogo)->all();
        }

        return view('projetos.'.$projeto, $dados);
    }
}
