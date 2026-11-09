<?php

namespace Tests\Feature;

use App\Models\Chamado;
use Tests\TestCase;

class HelpdeskTest extends TestCase
{
    private string $storageTemporario;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storageTemporario = sys_get_temp_dir().'/joaog-tests-'.bin2hex(random_bytes(8));
        mkdir($this->storageTemporario.'/app', 0755, true);
        $this->app->useStoragePath($this->storageTemporario);
    }

    protected function tearDown(): void
    {
        @unlink($this->storageTemporario.'/app/chamados.json');
        @rmdir($this->storageTemporario.'/app');
        @rmdir($this->storageTemporario);
        parent::tearDown();
    }

    public function test_helpdesk_creates_updates_reports_and_deletes_tickets(): void
    {
        $this->get('/helpdesk')->assertOk()->assertSee('name="_token"', false);
        $this->post('/helpdesk', ['acao' => 'cadastrar', 'nome' => '<script>teste</script>', 'setor' => 'ti', 'equipamento' => 'rede', 'descricao' => 'Sem conexão', 'prioridade' => 'alta'])->assertRedirect(route('helpdesk'));
        $this->get('/helpdesk')->assertOk()->assertSee('Sem conexão')->assertDontSee('<script>teste</script>', false);
        $model = new Chamado;
        $this->assertSame(1, $model->gerarRelatorio()['abertos']);
        $this->post('/helpdesk', ['acao' => 'atualizar', 'posicao' => 0, 'status' => 'Em andamento'])->assertRedirect(route('helpdesk'));
        $this->assertSame(1, $model->gerarRelatorio()['andamento']);
        $this->post('/helpdesk', ['acao' => 'atualizar', 'posicao' => 0, 'status' => 'Resolvido'])->assertRedirect(route('helpdesk'));
        $this->assertSame(1, $model->gerarRelatorio()['resolvidos']);
        $this->post('/helpdesk', ['acao' => 'excluir', 'posicao' => 0])->assertRedirect(route('helpdesk'));
        $this->assertSame([], $model->lerChamados());
    }

    public function test_invalid_actions_and_positions_do_not_modify_tickets(): void
    {
        $this->post('/helpdesk', ['acao' => 'cadastrar'])->assertSessionHasErrors(['nome', 'descricao']);
        $this->post('/helpdesk', ['acao' => 'atualizar', 'posicao' => 'abc', 'status' => 'Resolvido'])->assertSessionHasErrors('posicao');
        $this->post('/helpdesk', ['acao' => 'atualizar', 'posicao' => 0, 'status' => 'Inválido'])->assertSessionHasErrors('status');
        $this->post('/helpdesk', ['acao' => 'desconhecida'])->assertSessionHasErrors('acao');
        $model = new Chamado;
        $this->assertFalse($model->atualizarChamado(99, 'Resolvido'));
        $this->assertFalse($model->excluirChamado(99));
        $this->assertSame([], $model->lerChamados());
    }

    public function test_corrupted_json_is_not_silently_overwritten(): void
    {
        $arquivo = $this->storageTemporario.'/app/chamados.json';
        file_put_contents($arquivo, '{invalid');
        try {
            (new Chamado)->cadastrarChamados('Ana', 'ti', 'rede', 'Sem conexão', 'alta');
            $this->fail('JSON inválido deve ser rejeitado.');
        } catch (\JsonException $exception) {
            $this->assertSame('{invalid', file_get_contents($arquivo));
        }
    }
}
