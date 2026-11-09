<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjetosTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_portfolio_projects_open_and_have_csrf_tokens(): void
    {
        $this->get('/')->assertOk()->assertSee(route('idade'));
        foreach (['idade', 'notas', 'login-basico', 'jogos', 'poo2'] as $projeto) {
            $this->get('/projetos/'.$projeto)->assertOk()->assertSee('name="_token"', false)
                ->assertDontSee('<<<<<<<', false)
                ->assertDontSee('>>>>>>>', false);
            $this->get('/resources/views/projetos/'.$projeto.'.php')->assertRedirect('/projetos/'.$projeto);
        }
    }

    public function test_age_is_calculated_and_user_input_is_escaped(): void
    {
        $this->post('/projetos/idade', ['name' => '<script>alert(1)</script>', 'idade' => 18])
            ->assertOk()->assertSee('maior de idade')->assertDontSee('<script>alert(1)</script>', false);
        $this->post('/projetos/idade', ['name' => 'Ana', 'idade' => 17])->assertSee('menor de idade');
        $this->post('/projetos/idade', ['name' => 'Ana', 'idade' => 'abc'])->assertSessionHasErrors('idade');
    }

    public function test_weighted_grades_and_attendance_are_calculated_correctly(): void
    {
        $notas = ['name' => 'Ana', 'idade' => 18, 'frequencia' => 90, 'nota1' => 10, 'nota2' => 8, 'nota3' => 6, 'nota4' => 4, 'nota5' => 2];
        $this->post('/projetos/notas', $notas)->assertOk()->assertViewHas('media', 6)->assertSee('Recuperação');
        $this->post('/projetos/notas', array_replace($notas, ['frequencia' => 74]))->assertSee('Reprovado por frequência');
        $this->post('/projetos/notas', array_replace($notas, ['nota1' => 11]))->assertSessionHasErrors('nota1');
        $this->post('/projetos/notas', array_replace($notas, ['frequencia' => -1]))->assertSessionHasErrors('frequencia');
    }

    public function test_demo_login_accepts_valid_credentials_and_rejects_invalid_credentials(): void
    {
        $this->post('/projetos/login-basico', ['usuario' => 'alunosenai', 'senha' => 'senhasenai'])->assertOk()->assertSee('Login realizado com sucesso!');
        $this->post('/projetos/login-basico', ['usuario' => 'alunosenai', 'senha' => 'errada'])->assertSessionHasErrors('usuario');
    }

    public function test_games_are_saved_with_bound_values_and_escaped_on_display(): void
    {
        $jogo = ['usuario' => 'alunosenai', 'senha' => 'senhasenai', 'nome' => "Jogo'); DROP TABLE jogos; --", 'genero' => '<script>teste</script>', 'nota' => 9, 'ano_lancamento' => 2026];
        $this->post('/projetos/jogos', $jogo)->assertRedirect(route('jogos'));
        $this->assertDatabaseHas('jogos', ['nome' => $jogo['nome'], 'nota' => 9]);
        $this->get('/projetos/jogos')->assertOk()->assertSee($jogo['genero'])->assertDontSee($jogo['genero'], false);
        $this->post('/projetos/jogos', array_replace($jogo, ['nota' => 20]))->assertSessionHasErrors('nota');
        $this->post('/projetos/jogos', array_replace($jogo, ['senha' => 'errada']))->assertSessionHasErrors('usuario');
        $this->assertDatabaseCount('jogos', 1);
    }

    public function test_machines_persist_across_requests_without_serializing_objects(): void
    {
        $maquina = ['nome' => 'Prensa 1', 'tipo' => 'prensa', 'quantidade' => 50];
        $this->post('/projetos/poo2', $maquina)->assertRedirect(route('poo2'))->assertSessionHas('maquinas', [$maquina]);
        $this->get('/projetos/poo2')->assertOk()->assertSee('Prensa 1')->assertSee('Prensando peças...')->assertSee('50 unidades');
        $this->post('/projetos/poo2', array_replace($maquina, ['tipo' => 'inexistente']))->assertSessionHasErrors('tipo');
        $this->post('/projetos/poo2', array_replace($maquina, ['quantidade' => 'abc']))->assertSessionHasErrors('quantidade');
    }
}
