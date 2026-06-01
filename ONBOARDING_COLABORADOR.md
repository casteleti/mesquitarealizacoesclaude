# Onboarding — Mesquita Realizações

> Documento de integração para novos colaboradores.
> Todas as informações foram extraídas diretamente dos arquivos do projeto.
> Última atualização: 2026-06-01

---

## 1. Informações Básicas

| Campo | Valor |
|---|---|
| **Nome do projeto** | Mesquita Realizações |
| **Descrição** | Site institucional + painel administrativo para empresa de construção industrial |
| **URL de produção** | https://mesquitarealizacoes.com.br |
| **URL do painel** | https://mesquitarealizacoes.com.br/admin/login |
| **Repositório** | https://github.com/casteleti/mesquitarealizacoesclaude |
| **Proprietário** | [VERIFICAR COM O PROPRIETÁRIO] |

---

## 2. Stack Tecnológico

| Camada | Tecnologia | Versão |
|---|---|---|
| **Linguagem** | PHP | 8.3+ (mínimo 8.0 — uso de `str_starts_with`, `match`, `named args`) |
| **Servidor web** | Apache + mod_rewrite | — |
| **Banco de dados** | MySQL | 8.4 (local: Laragon) |
| **Frontend** | CSS/JS vanilla | sem framework |
| **Gerenciador de deps** | Nenhum (sem Composer, sem npm) | — |

> ⚠️ **Sem frameworks externos.** O MVC foi construído do zero — sem Laravel, Symfony, React ou Vue.

### Dependências PHP externas
Nenhuma via Composer. Arquivo `includes/vendor/` contém:

```
public_html/includes/vendor/   ← verificar conteúdo com o proprietário
```

---

## 3. Estrutura de Diretórios

```
mesquitarealizacoesclaude/
├── .github/
│   └── workflows/
│       └── deploy.yml          ← CI/CD: deploy automático via FTP
├── public_html/                ← raiz do site (tudo aqui vai para o servidor)
│   ├── index.php               ← único ponto de entrada (front controller)
│   ├── .htaccess               ← roteamento Apache + headers de segurança
│   ├── .user.ini               ← configurações PHP (upload, sessão, erros)
│   ├── entrar.php              ← acesso à home enquanto index.html de "em breve" existe
│   ├── assets/
│   │   ├── css/
│   │   │   ├── style.css       ← CSS do site público
│   │   │   └── admin.css       ← CSS do painel administrativo
│   │   ├── js/
│   │   │   ├── app.js          ← JS do site público (menu, filtros, form AJAX)
│   │   │   └── admin.js        ← JS do painel
│   │   ├── icons/              ← ícones SVG (redes sociais, contato)
│   │   └── images/             ← logos e imagens estáticas
│   ├── config/
│   │   ├── app.php             ← configurações gerais + detecção local/produção
│   │   └── database.php        ← credenciais DB com detecção automática de ambiente
│   ├── controllers/            ← controllers do site público e painel admin
│   ├── core/                   ← classes base do MVC (Router, Controller, Model, etc.)
│   ├── includes/
│   │   ├── bootstrap.php       ← inicialização: sessão, autoloader, config, DB
│   │   └── helpers.php         ← funções globais (e(), url(), asset(), lucide_icon(), etc.)
│   ├── models/                 ← models (um por tabela do banco)
│   ├── uploads/                ← arquivos enviados via painel (não commitados)
│   │   ├── banners/
│   │   ├── obras/
│   │   ├── paginas/
│   │   └── setores/
│   └── views/
│       ├── admin/              ← views do painel administrativo
│       ├── partials/           ← componentes reutilizáveis (header, footer, sidebar)
│       └── site/               ← views das páginas públicas
└── ONBOARDING_COLABORADOR.md   ← este arquivo
```

---

## 4. Banco de Dados

**Tabelas** (conforme `SHOW TABLES` no MySQL local):

| Tabela | Função |
|---|---|
| `banners` | Banners do hero da home |
| `configuracoes` | Chave-valor: telefone, email, redes sociais, SMTP, URLs |
| `diferenciais` | Cards de diferenciais (home e quem somos) |
| `etapas_processo` | Etapas da página "Como Atuamos" |
| `gestao_cards` | Cards de gestão de obras |
| `leads` | Contatos recebidos pelo formulário |
| `login_attempts` | Rate limiting de tentativas de login |
| `obra_imagens` | Galeria de imagens por obra |
| `obras` | Portfólio de obras |
| `pagina_conteudos` | Conteúdo editável das páginas (JSON por página) |
| `seo_metas` | Metadados SEO por página |
| `setores` | Setores de atuação |
| `users` | Usuários do painel administrativo |
| `valores` | Cards de valores institucionais |

### Credenciais — Local
Definidas em `config/database.php` (detecção automática por hostname):

```
Host:     localhost
Database: mesquitarealizacoes
Username: root
Password: (vazio)
```

### Credenciais — Produção
```
Host:     dbmesquita.vpscronos0842.mysql.dbaas.com.br
Database: dbmesquita
Username: dbmesquita
Password: [VERIFICAR COM O PROPRIETÁRIO — não incluído por segurança]
```

> A detecção de ambiente é automática: se `HTTP_HOST` não for `localhost` ou `.test`, usa produção.

---

## 5. Repositório GitHub

| Campo | Valor |
|---|---|
| **URL** | https://github.com/casteleti/mesquitarealizacoesclaude |
| **Branch principal** | `main` |
| **Proteções de branch** | [VERIFICAR COM O PROPRIETÁRIO] |
| **Processo de PR** | [VERIFICAR COM O PROPRIETÁRIO] |

### Commits recentes (conforme `git log`)
```
eb8c6ba  Corrige server-dir do deploy FTP para /public_html/
81d6fcb  Corrige indentação do workflow de deploy via FTP
906cfa5  Remove bloco "Seção hero" redundante do painel Home
05d6ea6  Padroniza tipografia dos banners hero em todas as páginas
7add57a  Add FTP deployment workflow
3a24176  Initial commit
```

---

## 6. Pipeline de Deploy

**Arquivo:** `.github/workflows/deploy.yml`

```yaml
on:
  push:
    branches:
      - main        ← qualquer push na main dispara o deploy
```

### Fluxo completo
```
git push origin main
        ↓
GitHub Actions (ubuntu-latest)
        ↓
actions/checkout@v4   ← baixa o código
        ↓
SamKirkland/FTP-Deploy-Action@v4.3.5
        ↓
FTP → mesquitarealizacoes.com.br
      local-dir:  ./public_html/
      server-dir: /public_html/
        ↓
Site atualizado (~2-3 minutos)
```

### Secrets necessários no GitHub
`Settings → Secrets and variables → Actions`:

| Secret | Descrição |
|---|---|
| `FTP_SERVER` | Hostname do servidor FTP |
| `FTP_USER` | Usuário FTP |
| `FTP_PASS` | Senha FTP |

### Onde ver os logs
`github.com/casteleti/mesquitarealizacoesclaude → aba Actions`

> ⚠️ A pasta `uploads/` **não é commitada** no Git (imagens enviadas pelo painel). Ela existe no servidor mas não é sobrescrita pelo deploy.

---

## 7. Como Começar — Passo a Passo

### Pré-requisitos
- [Laragon](https://laragon.org/) (Windows) — inclui Apache, PHP 8.3, MySQL 8
- Git

### Setup local

```bash
# 1. Clone o repositório
git clone https://github.com/casteleti/mesquitarealizacoesclaude.git

# 2. Mova para a pasta do Laragon
# Coloque em: C:\laragon\www\mesquitarealizacoesclaude\

# 3. Inicie o Laragon (Start All)

# 4. Acesse o Laragon → Menu → MySQL → Criar banco
#    Nome do banco: mesquitarealizacoes

# 5. Importe o SQL de produção ou use um dump local
#    [VERIFICAR COM O PROPRIETÁRIO para obter o dump]

# 6. Não há passo de instalação de dependências (sem Composer/npm)

# 7. Configure o virtual host no Laragon:
#    Menu → Apache → sites-enabled → adicione:
#    mesquitarealizacoesclaude.test → C:\laragon\www\mesquitarealizacoesclaude\public_html

# 8. Acesse o site
http://mesquitarealizacoesclaude.test/

# 9. Acesse o painel
http://mesquitarealizacoesclaude.test/admin/login
# Email: admin@mesquita.com.br
# Senha: [VERIFICAR COM O PROPRIETÁRIO]
```

### Laragon já faz automaticamente
- Virtual host `.test` → `public_html/`
- Sem configuração extra de Apache

---

## 8. Arquitetura MVC (sem framework)

### Ciclo de uma requisição

```
Browser → .htaccess → index.php → Router → Controller → Model → View → Response
```

### Classes core (`public_html/core/`)

| Classe | Função |
|---|---|
| `Router` | Registra rotas GET/POST e despacha para o controller certo |
| `Controller` | Classe base: `view()`, `redirect()`, `flash()`, `json()`, `abort()`, `requireAdmin()` |
| `Model` | Classe base: `find()`, `findAll()`, `insert()`, `update()`, `delete()`, `paginate()` |
| `Database` | Singleton PDO — lê credenciais de `config/database.php` |
| `Auth` | Login/logout/verificação de sessão admin |
| `Csrf` | Geração e verificação de tokens CSRF |
| `View` | Renderiza views PHP com layout, `partial()` para componentes |
| `Upload` | Valida e salva imagens em `uploads/` |
| `Validator` | Validação de campos POST |
| `Mailer` | Envio de e-mail via SMTP |
| `Seo` | Geração de meta tags |

### Convenções importantes

```php
// Models: SEMPRE métodos estáticos, NUNCA instanciar
Setor::ativos();          // ✅ correto
(new Setor())->ativos();  // ❌ nunca faça isso

// Helpers globais (includes/helpers.php)
e($valor)               // escapa HTML — use em TODA saída de variável
url('setores')          // gera URL relativa
asset('css/style.css')  // gera URL para assets
upload_url($path)       // gera URL para arquivo de upload
lucide_icon('zap', 'icon', 24)  // renderiza ícone SVG inline
```

---

## 9. Rotas (conforme `public_html/index.php`)

### Site público
| Método | Rota | Controller@método |
|---|---|---|
| GET | `/` | `HomeController@index` |
| GET | `/quem-somos` | `PageController@quemSomos` |
| GET | `/setores` | `PageController@setores` |
| GET | `/setores/{slug}` | `PageController@setor` |
| GET | `/obras` | `WorkController@index` |
| GET | `/obras/{slug}` | `WorkController@show` |
| GET | `/como-atuamos` | `PageController@comoAtuamos` |
| GET/POST | `/contato` | `ContactController@index/send` |
| GET | `/sitemap.xml` | `SitemapController@index` |

### Painel admin (`/admin/*`)
Todas as rotas admin exigem autenticação (`requireAdmin()`).
Módulos: banners, setores, obras, diferenciais, valores, processo, gestão, leads, páginas, SEO, configurações, usuários, destaque.

---

## 10. Padrões de Código

### PHP
- `declare(strict_types=1)` em todos os arquivos PHP
- Controllers estendem `Controller`, Models estendem `Model`
- Nenhuma dependência externa (sem Composer)
- Saídas HTML sempre escapadas com `e()` (wrapper de `htmlspecialchars`)

### CSS
- Dois arquivos: `style.css` (site) e `admin.css` (painel)
- Variáveis CSS em `:root` — ex: `--color-red`, `--color-graphite`, `--font-heading`
- Sem preprocessador (CSS puro)
- Responsivo: breakpoints em `max-width: 759px`, `680px`, `520px`

### JavaScript
- Vanilla JS, sem bundler
- Dois arquivos: `app.js` (site) e `admin.js` (painel)
- Funções em IIFE `(function() { ... })()`

### Git
- Commits em português descritivo
- Trailer: `Co-Authored-By: Claude Sonnet 4.6 <noreply@anthropic.com>`
- Push direto na `main` (sem branches de feature atualmente)

---

## 11. Configurações PHP (conforme `.user.ini`)

```ini
display_errors = Off
log_errors = On
upload_max_filesize = 8M
post_max_size = 10M
max_execution_time = 30
session.cookie_httponly = On
session.use_strict_mode = On
```

---

## 12. Limitações e "Gotchas"

### ⚠️ Coisas fáceis de esquecer

1. **Laragon deve estar rodando** antes de acessar o site local — especialmente o MySQL. Sem MySQL: HTTP 500 em todas as páginas.

2. **`uploads/` não é versionado** — o Git ignora essa pasta. Imagens do painel não são sincronizadas entre ambientes.

3. **`entrar.php` na raiz** — arquivo temporário criado para acessar a home real enquanto um `index.html` de "em breve" estiver no servidor. Remova quando o site for ao ar oficialmente.

4. **Detecção de ambiente automática** — o arquivo `config/database.php` detecta se está em local ou produção pelo `HTTP_HOST`. Não há `.env`.

5. **Static cache em `Configuracao::getAll()`** — a classe usa `static $cache`. Em requests longos ou scripts CLI, o cache pode estar desatualizado.

6. **Ícones Lucide são inline SVG** — o helper `lucide_icon()` em `helpers.php` tem um mapa estático de nomes → paths SVG. Adicionar um novo ícone requer editar o array no helper.

7. **`session.cookie_samesite`** — só configurado se `PHP_VERSION_ID >= 70300` (conforme `bootstrap.php`).

---

## 13. Testes

Não há suite de testes automatizados configurada no projeto.

Testes são feitos manualmente via browser e scripts PHP temporários.

> [VERIFICAR COM O PROPRIETÁRIO] se há intenção de adicionar PHPUnit ou similar.

---

## 14. Pontos de Contato

| Papel | Contato |
|---|---|
| Proprietário do projeto | [VERIFICAR COM O PROPRIETÁRIO] |
| Responsável deploy/infra | [VERIFICAR COM O PROPRIETÁRIO] |
| Hospedagem | Cronos (VPS) — painel em `cronos-painel.com` |
| Repositório GitHub | github.com/casteleti/mesquitarealizacoesclaude |

---

## 15. Checklist — Novo Colaborador

- [ ] Clonou o repositório
- [ ] Instalou e iniciou o Laragon (Apache + MySQL)
- [ ] Criou o banco `mesquitarealizacoes` e importou o dump
- [ ] Acessou `http://mesquitarealizacoesclaude.test/` sem erro
- [ ] Acessou o painel em `http://mesquitarealizacoesclaude.test/admin/login`
- [ ] Entendeu o fluxo MVC (index.php → Router → Controller → Model → View)
- [ ] Leu `public_html/includes/helpers.php` (funções globais)
- [ ] Leu `public_html/core/` (classes base)
- [ ] Entendeu que Models só têm métodos estáticos
- [ ] Fez um `git push` e acompanhou o deploy na aba Actions do GitHub
- [ ] Sabe que `uploads/` não é versionado
- [ ] Confirmou que o site de produção atualizou após o push
