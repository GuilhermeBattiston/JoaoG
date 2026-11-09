<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class DeploymentTest extends TestCase
{
    use RefreshDatabase;

    private string $publicTemporario;

    protected function setUp(): void
    {
        parent::setUp();
        Process::fake(['*' => Process::result(output: 'commit-de-teste')]);
        $this->publicTemporario = sys_get_temp_dir().'/joaog-deploy-'.bin2hex(random_bytes(8));
        mkdir($this->publicTemporario.'/build/assets', 0755, true);
        touch($this->publicTemporario.'/index.php');
        touch($this->publicTemporario.'/.htaccess');
        $manifesto = [];
        foreach (['app.css', 'index.css', 'helpdesk.css', 'jogos.css', 'login.css', 'style.css', 'app.js'] as $asset) {
            $origem = str_ends_with($asset, '.css') ? 'resources/css/' : 'resources/js/';
            $manifesto[$origem.$asset] = ['file' => 'assets/'.$asset];
            touch($this->publicTemporario.'/build/assets/'.$asset);
        }
        file_put_contents($this->publicTemporario.'/build/manifest.json', json_encode($manifesto));
        $this->app->usePublicPath($this->publicTemporario);
        config(['app.key' => 'chave-privada-de-teste']);
    }

    protected function tearDown(): void
    {
        foreach (glob($this->publicTemporario.'/build/assets/*') as $arquivo) {
            unlink($arquivo);
        }
        unlink($this->publicTemporario.'/build/manifest.json');
        unlink($this->publicTemporario.'/index.php');
        unlink($this->publicTemporario.'/.htaccess');
        @unlink($this->publicTemporario.'/hot');
        rmdir($this->publicTemporario.'/build/assets');
        rmdir($this->publicTemporario.'/build');
        rmdir($this->publicTemporario);
        parent::tearDown();
    }

    public function test_deployment_check_validates_routes_assets_and_database_without_disclosing_keys(): void
    {
        $this->artisan('app:check-deploy')
            ->expectsOutputToContain('[OK] Tabela jogos existente')
            ->doesntExpectOutputToContain('chave-privada-de-teste')
            ->assertSuccessful();
    }

    public function test_deployment_check_detects_the_default_welcome_route(): void
    {
        Route::get('/', fn () => view('welcome'));
        $this->artisan('app:check-deploy', ['--skip-database' => true])
            ->expectsOutputToContain('[FALHA] GET /')
            ->assertFailed();
    }

    public function test_deployment_check_rejects_missing_built_assets_and_a_vite_dev_server(): void
    {
        unlink($this->publicTemporario.'/build/assets/index.css');
        file_put_contents($this->publicTemporario.'/hot', 'http://localhost:5173');
        $this->artisan('app:check-deploy', ['--skip-database' => true])
            ->expectsOutputToContain('[FALHA] Build de resources/css/index.css presente')
            ->expectsOutputToContain('[FALHA] public/hot ausente')
            ->assertFailed();
    }

    public function test_production_check_rejects_debug_and_an_http_url(): void
    {
        config(['app.debug' => true, 'app.url' => 'http://localhost', 'session.secure' => false]);
        $this->artisan('app:check-deploy', ['--production' => true, '--skip-database' => true])
            ->expectsOutputToContain('[FALHA] APP_ENV=production')
            ->expectsOutputToContain('[FALHA] APP_DEBUG=false')
            ->expectsOutputToContain('[FALHA] APP_URL usa HTTPS')
            ->expectsOutputToContain('[FALHA] SESSION_SECURE_COOKIE=true')
            ->assertFailed();
    }
}
