# JoaoG: diagnóstico e publicação no DevLook

## Diagnóstico confirmado em 09/11/2026

Às 16:42 de São Paulo, a consulta pública a `https://joao315.devlook.xyz/`
retornou HTTP 200 com o título `Joao` e a página padrão “Let's get started” do
Laravel. `/helpdesk`, `/projetos/idade` e `/projetos/jogos` retornaram HTTP 404;
`/up` retornou 200. O CSS referenciado pela página padrão também retornou 200.
Nenhum formulário foi enviado à produção durante a investigação.

O GitHub `origin/main`, no commit `a53583d`, já incorporava o PR #1.
Nesse código, `/` usa `PortfolioController@index`, que retorna `portfolio`,
e estão registradas as rotas de Helpdesk e dos cinco projetos. A instalação
local confirmou essas rotas, sem cache de configuração ou de rotas. O
`bootstrap/app.php` carrega `routes/web.php`; `public/index.php` carrega o
autoload e o bootstrap do mesmo projeto; `public/.htaccess` existe e contém
as regras usuais de reescrita do Laravel. O Vite inclui os estilos dos projetos.

**Conclusão:** o conjunto de rotas observado no domínio difere do código
atual do repositório. Não há evidência para escolher, sem acesso ao servidor,
entre código antigo, outra instalação/document root, cache antigo ou PHP-FPM
servindo uma versão antiga. O `route:list` fornecido pelo usuário é compatível
com uma instalação padrão, mas ainda falta comprovar seu diretório e commit.
O funcionamento de `/up` sozinho não comprova que o portfólio foi publicado.

O ambiente Codex é separado do servidor DevLook. Os testes locais não
comprovam os arquivos, o PHP-FPM ou as variáveis efetivamente usados pelo domínio.
Nenhuma alteração foi implantada em produção automaticamente.

## 1. Identificar a instalação antes de atualizar

No **terminal do DevLook**, entre na raiz real do projeto (a pasta que contém
`artisan` e `composer.json`, não `public/`) e execute:

```bash
pwd -P
git remote -v
git branch --show-current
git status --short --branch
git log -1 --oneline
git fetch origin
git rev-parse HEAD origin/main
git log --oneline --left-right HEAD...origin/main
php -v
composer --version
php artisan about
php artisan route:list --except-vendor
```

Antes de compartilhar a saída de `git remote -v`, remova eventual token embutido
na URL. Não compartilhe `.env`, cookies, logs completos nem valores de chaves.
Se a instalação não tem `.git`, isso pode ser publicação por artefato; identifique
no painel a origem e a revisão do artefato. Não inicialize outro repositório por cima.

No **painel do DevLook**, confirme o domínio, a aplicação vinculada, o diretório
de publicação e o document root. O caminho deve terminar em **`/JoaoG/public`**
(ou `/public` dentro da raiz real identificada por `pwd -P`). Compare o caminho
absoluto do painel com o terminal. O nome exato dos campos depende do painel;
não foi possível inspecioná-lo nesta sessão.

- Se o terminal tem as rotas corretas e o domínio continua na tela padrão,
  verifique primeiro se o domínio aponta para essa mesma instalação.
- Se `routes/web.php` no servidor ainda retorna `view('welcome')`, o código
  não foi atualizado nessa pasta.
- Se o arquivo contém o controlador do portfólio, mas `route:list` não,
  elimine o cache de rotas dessa instalação e confira novamente.
- Se CLI e arquivos estão corretos, mas HTTP continua antigo, confira PHP-FPM,
  OPcache e eventual cache da hospedagem. Reinicie o serviço pelo painel ou
  com o suporte, depois de confirmar o destino. `opcache_reset()` no CLI
  não limpa o OPcache do PHP-FPM.

Não copie apenas `portfolio.blade.php` para `welcome.blade.php`: isso não
registra os projetos nem corrige a aplicação que o domínio executa.

## 2. Requisitos reais

- **PHP >= 8.4.1 no CLI e no PHP-FPM** para o `composer.lock` atual. Embora o
  requisito direto do projeto/Laravel seja `^8.3`, o lock inclui Symfony
  `8.1.11`, que exige `>=8.4.1`. Nesta investigação foi usado PHP 8.5.12.
  Não use `--ignore-platform-reqs` nem rode `composer update` na hospedagem.
- Composer 2; confira as extensões com `composer check-platform-reqs --no-dev`
  após instalar. Inclua `pdo_sqlite` ou `pdo_mysql`, conforme o banco, além
  das extensões exigidas pelo Laravel e pelo lock.
- Node **22.12+** (ou 20.19+) e npm somente no ambiente que compila os assets.
  Se não houver Node na hospedagem, compile fora e envie **todo** `public/build/`,
  inclusive `manifest.json`. Nunca publique `public/hot` nem execute Vite dev
  como solução de produção.
- O usuário do PHP-FPM precisa ler o código e gravar em `storage/`,
  `bootstrap/cache/`, `storage/app/chamados.json` e, usando SQLite, no arquivo
  do banco **e na pasta que o contém**. O teste do CLI não prova as permissões do FPM.
- SQLite, `storage/app/chamados.json` e sessões precisam de armazenamento
  persistente entre publicações. Em releases separados, preserve/compartilhe
  `storage/`, `.env` e o banco; não copie um SQLite vazio sobre o existente.
  O Helpdesk usa JSON com bloqueio de arquivo; não distribua cópias independentes
  desse arquivo entre múltiplas instâncias.

### Servidor web

Em Apache, mantenha `public/.htaccess`, habilite `mod_rewrite` e permita as
regras com `AllowOverride All` (ou configuração equivalente pelo provedor).
Em Nginx, `.htaccess` não é usado: o suporte/painel deve configurar o root
para `public/` e a regra equivalente `try_files $uri $uri/ /index.php?$query_string;`,
com o PHP-FPM apropriado. Não exponha a raiz do repositório na web.
Não é necessário alterar `public/index.php` para apontar para outro projeto.

## 3. Ambiente e banco

O arquivo `.env.production.example` é um modelo público sem credenciais.
Em uma instalação nova, copie-o para `.env` e preencha os dados no servidor.
Em atualizações, **preserve o `.env` e a `APP_KEY` existentes**.

Valores de produção: `APP_ENV=production`, `APP_DEBUG=false`,
`APP_URL=https://joao315.devlook.xyz`, `SESSION_SECURE_COOKIE=true`.
Se houver proxy TLS, confira no navegador se os assets/links usam HTTPS.
Configure proxies confiáveis apenas com os endereços fornecidos pelo DevLook.

Escolha o banco existente:

- SQLite: use `DB_CONNECTION=sqlite`; omitir `DB_DATABASE` utiliza
  `database/database.sqlite`. Se preencher, use o caminho absoluto do banco
  persistente do servidor. **Somente numa instalação nova**, crie o arquivo
  se não existir: `test -f database/database.sqlite || touch database/database.sqlite`.
- MySQL: configure `DB_CONNECTION=mysql`, host, porta, nome, usuário e senha
  fornecidos pelo painel, somente no `.env`. Não transfira credenciais para o Git.

`SESSION_DRIVER=database` e `CACHE_STORE=database` exigem as tabelas criadas
pelas migrações incluídas. A tabela `jogos` é criada por sua própria migração.
As operações do Helpdesk persistem em `storage/app/chamados.json`.
Se o banco preexistente já tem tabelas mas não registra as migrações, pare e
planeje a compatibilização antes de migrar; não apague/recrie essas tabelas.

Gere a chave **apenas se a instalação for nova e não houver APP_KEY**:

```bash
php artisan key:generate --force
```

Não execute `composer setup` para atualizar produção: o script é de instalação
local e chama `key:generate` incondicionalmente. Não regenere a chave existente.
O login de exemplo é uma atividade educacional; não é autenticação de produção.
Os chamados não possuem controle de acesso: não use esse exercício para dados
reais ou restritos sem implementar autenticação e autorização.

## 4. Atualização segura depois de revisar e integrar o PR

Faça backup privado do banco, `.env` e `storage/app/chamados.json`, com as
ferramentas da hospedagem e sem publicá-los no Git. Planeje uma janela de
atualização ou use o mecanismo de releases do provedor.

Só continue se `git status --short` estiver vazio e o repositório/diretório
forem os corretos. Os comandos abaixo não são executados automaticamente:

```bash
git fetch origin
git switch main
git merge --ff-only origin/main
```

Se aparecer `Not possible to fast-forward`, **pare**: existem históricos
divergentes. Não use `reset --hard`, `clean -fd`, push forçado ou rebase
improvisado no servidor. Preserve a branch atual e analise
`git log --oneline --graph --decorate --all -20` e
`git log --oneline --left-right HEAD...origin/main`; resolva a divergência em
um checkout separado antes de publicar a revisão aprovada.

Depois da atualização do código e da configuração privada do ambiente:

```bash
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
composer check-platform-reqs --no-dev
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan migrate:status
php artisan migrate --force --no-interaction
```

`migrate` aplica migrações pendentes; revise-as e confirme o backup antes.
Não use `migrate:fresh`, `migrate:refresh` ou `db:wipe`. Não rode `cache:clear`
apenas para corrigir rotas: ele limpa dados do cache da aplicação.

Se for compilar no servidor (caso contrário envie o build da mesma revisão):

```bash
npm ci --ignore-scripts
npm run build
```

Se necessário, conceda acesso **ao proprietário/grupo correto** pelo painel.
Quando o grupo já é o do PHP-FPM, é possível ajustar apenas as pastas graváveis:

```bash
chmod -R ug+rwX storage bootstrap/cache
```

Não use `chmod -R 777`. Confirme separadamente as permissões do SQLite.
Antes de gerar caches:

```bash
php artisan route:list --except-vendor
php artisan app:check-deploy --production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan app:check-deploy --production
```

O comando novo retorna código 1 se detectar falhas, não mostra credenciais,
não altera o banco nem publica arquivos. Mostra a raiz e o commit do **CLI**,
confere as rotas/controladores, views, build, chave, permissões e tabelas.
`--skip-database` pula explicitamente a validação do banco; não equivale à
verificação completa. O comando precisa estar instalado pelo PR antes de usá-lo.

## 5. Aceite no domínio e pendências do painel

```bash
curl --fail --silent --show-error https://joao315.devlook.xyz/ -o /tmp/joaog-inicio.html
grep -F 'Meu Portfólio' /tmp/joaog-inicio.html
curl --fail --silent --show-error https://joao315.devlook.xyz/helpdesk -o /dev/null
curl --fail --silent --show-error https://joao315.devlook.xyz/projetos/idade -o /dev/null
curl --fail --silent --show-error https://joao315.devlook.xyz/projetos/notas -o /dev/null
curl --fail --silent --show-error https://joao315.devlook.xyz/projetos/login-basico -o /dev/null
curl --fail --silent --show-error https://joao315.devlook.xyz/projetos/jogos -o /dev/null
curl --fail --silent --show-error https://joao315.devlook.xyz/projetos/poo2 -o /dev/null
```

No navegador, confira o conteúdo do portfólio e as respostas 200 dos arquivos
`/build/assets/...` referenciados. Teste os formulários com dados fictícios,
incluindo cadastro, atualização e exclusão de um chamado de teste, após aprovar
a publicação. Não basta receber 200 na página padrão.

Dependem do acesso do responsável ao DevLook: comprovar raiz/domínio/revisão,
selecionar PHP-FPM compatível, configurar banco/variáveis, ajustar permissões e
persistência, habilitar rewrite e reiniciar FPM/OPcache se necessário. Não há
acesso administrativo à hospedagem nesta sessão; a causa específica dentro do
servidor permanece pendente. Produção só pode ser declarada corrigida depois
desse aceite no próprio domínio.

## Validação realizada no Codex

- `composer validate --strict`, `npm ci --ignore-scripts`, `npm run build`,
  Pint e a análise de sintaxe de todos os PHP da aplicação passaram.
- A suíte passou com **15 testes e 109 asserções**. O teste da raiz exige
  explicitamente a view `portfolio`; os testes do diagnóstico simulam a rota
  `welcome`, assets ausentes, `public/hot` indevido e ambiente inseguro.
- Uma cópia isolada foi instalada com `composer install --no-dev`, banco
  SQLite novo de teste e o modelo de ambiente de produção. Foram aprovados
  `composer check-platform-reqs --no-dev`, migrações, os três caches e
  `php artisan app:check-deploy --production` após os caches.
- Nessa cópia local em produção, Chromium verificou os seis links do portfólio,
  CRUD de chamados com CSRF, cadastro de jogos com apóstrofo e persistência de
  máquinas após recarregar, além das sete páginas em 1280 e 390 px, sem erros
  de rede/JavaScript. Os dados de teste ficaram exclusivamente no ambiente local.
- Apache/Nginx e PHP-FPM do DevLook não foram acessados administrativamente.
  As requisições públicas confirmaram a divergência, não sua correção em produção.
