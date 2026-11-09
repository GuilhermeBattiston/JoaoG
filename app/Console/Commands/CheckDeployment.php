<?php

namespace App\Console\Commands;

use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjetoController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Throwable;

class CheckDeployment extends Command
{
    protected $signature = 'app:check-deploy
                            {--production : Exige ambiente de produção, HTTPS e debug desativado}
                            {--skip-database : Não verifica conexão e tabelas do banco}';

    protected $description = 'Verifica a identidade, rotas, assets e requisitos da instalação sem alterar dados';

    public function handle(): int
    {
        $this->info('Diagnóstico da instalação executada pelo PHP CLI');
        $this->line('Diretório: '.base_path());
        $this->line('Document root esperado: '.public_path());
        $this->line('PHP CLI: '.PHP_VERSION.' | Laravel: '.app()->version());
        $this->line('Ambiente: '.app()->environment());
        $this->line('Caches: config='.(app()->configurationIsCached() ? 'sim' : 'não')
            .', rotas='.(app()->routesAreCached() ? 'sim' : 'não'));
        try {
            $commit = Process::path(base_path())->run(['git', 'rev-parse', '--short=12', 'HEAD']);
            $this->line('Commit: '.($commit->successful() ? trim($commit->output()) : 'indisponível (instalação sem Git)'));
        } catch (Throwable) {
            $this->line('Commit: indisponível (Git ou execução de processos indisponível)');
        }
        $this->warn('Este comando não comprova qual diretório ou PHP-FPM o domínio utiliza. Compare com o painel e com HTTP.');

        $falhas = 0;
        $verificar = function (bool $valido, string $descricao) use (&$falhas): void {
            if ($valido) {
                $this->line('[OK] '.$descricao);
            } else {
                $this->error('[FALHA] '.$descricao);
                $falhas++;
            }
        };

        $verificar(version_compare(PHP_VERSION, '8.4.1', '>='), 'PHP >= 8.4.1, conforme as dependências travadas');
        $verificar((string) config('app.key') !== '', 'APP_KEY configurada (valor oculto)');
        foreach (['storage', 'bootstrap/cache'] as $diretorio) {
            $verificar(is_dir(base_path($diretorio)) && is_writable(base_path($diretorio)), $diretorio.' gravável pelo usuário CLI');
        }
        $arquivoChamados = storage_path('app/chamados.json');
        $verificar(is_writable(storage_path('app')) && (! is_file($arquivoChamados) || is_writable($arquivoChamados)), 'Armazenamento de chamados gravável pelo usuário CLI');
        $verificar(is_file(public_path('index.php')) && is_file(public_path('.htaccess')), 'Front controller e .htaccess presentes (Apache precisa de mod_rewrite e AllowOverride)');

        $esperadas = [
            '/' => ['portfolio', PortfolioController::class.'@index'],
            '/helpdesk' => ['helpdesk', HelpdeskController::class.'@index'],
        ];
        foreach (['idade', 'notas', 'login-basico', 'jogos', 'poo2'] as $projeto) {
            $esperadas['/projetos/'.$projeto] = [$projeto, ProjetoController::class.'@exibir'];
        }
        foreach ($esperadas as $caminho => [$nome, $acao]) {
            try {
                $rota = Route::getRoutes()->match(Request::create($caminho, 'GET'));
                $verificar($rota->getName() === $nome && $rota->getActionName() === $acao, 'GET '.$caminho.' → '.$acao);
            } catch (Throwable) {
                $verificar(false, 'GET '.$caminho.' registrada');
            }
        }
        try {
            $rota = Route::getRoutes()->match(Request::create('/helpdesk', 'POST'));
            $verificar($rota->getActionName() === HelpdeskController::class.'@salvar', 'POST /helpdesk → HelpdeskController@salvar');
        } catch (Throwable) {
            $verificar(false, 'POST /helpdesk registrada');
        }
        foreach (['portfolio', 'projetos.helpdesk', 'projetos.idade', 'projetos.notas', 'projetos.login-basico', 'projetos.jogos', 'projetos.poo2'] as $view) {
            $verificar(view()->exists($view), 'View '.$view.' encontrada');
        }

        $verificar(! is_file(public_path('hot')), 'public/hot ausente (produção usa o build, sem servidor Vite)');
        try {
            $manifesto = public_path('build/manifest.json');
            $assets = is_file($manifesto) ? json_decode(file_get_contents($manifesto), true, 512, JSON_THROW_ON_ERROR) : [];
            foreach (['app.css', 'index.css', 'helpdesk.css', 'jogos.css', 'login.css', 'style.css'] as $css) {
                $arquivo = $assets['resources/css/'.$css]['file'] ?? null;
                $verificar(is_string($arquivo) && is_file(public_path('build/'.$arquivo)), 'Build de resources/css/'.$css.' presente');
            }
            $js = $assets['resources/js/app.js']['file'] ?? null;
            $verificar(is_string($js) && is_file(public_path('build/'.$js)), 'Build de resources/js/app.js presente');
        } catch (Throwable) {
            $verificar(false, 'Manifesto Vite contém JSON válido e legível');
        }

        if ($this->option('production')) {
            $verificar(app()->environment('production'), 'APP_ENV=production');
            $verificar(config('app.debug') === false, 'APP_DEBUG=false');
            $verificar(parse_url((string) config('app.url'), PHP_URL_SCHEME) === 'https', 'APP_URL usa HTTPS');
            $verificar(config('session.secure') === true, 'SESSION_SECURE_COOKIE=true');
        }
        if (! $this->option('skip-database')) {
            try {
                DB::connection()->getPdo();
                $verificar(true, 'Conexão com o banco configurado disponível (credenciais ocultas)');
                $tabelas = ['migrations', 'jogos'];
                if (config('session.driver') === 'database') {
                    $tabelas[] = 'sessions';
                }
                if (config('cache.default') === 'database') {
                    $tabelas[] = 'cache';
                    $tabelas[] = 'cache_locks';
                }
                foreach ($tabelas as $tabela) {
                    $verificar(Schema::hasTable($tabela), 'Tabela '.$tabela.' existente');
                }
            } catch (Throwable) {
                $verificar(false, 'Banco indisponível; confira conexão, driver, caminho SQLite e migrações sem compartilhar credenciais');
            }
        } else {
            $this->warn('Banco não verificado (--skip-database).');
        }

        $this->line($falhas === 0 ? 'Verificações solicitadas aprovadas nesta instalação CLI.' : 'Falhas encontradas: '.$falhas);

        return $falhas === 0 ? self::SUCCESS : self::FAILURE;
    }
}
