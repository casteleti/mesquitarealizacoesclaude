# Instruções do Projeto

## Objetivo

Desenvolver um site institucional leve, rápido, durável e fácil de publicar em hospedagem compartilhada Locaweb, usando apenas FTP e banco MySQL.

O projeto deve priorizar:

- performance
- SEO técnico
- responsividade
- UX/UI refinada
- painel administrativo simples e intuitivo
- baixa manutenção
- publicação simples por FTP
- compatibilidade com PHP 8.2 e MySQL

## Stack obrigatório

Use:

- PHP 8.2+
- MySQL/MariaDB
- PDO
- HTML5 semântico
- CSS custom ou Tailwind compilado localmente
- JavaScript Vanilla
- Alpine.js apenas se necessário
- Swiper.js apenas se realmente necessário
- PHPMailer via SMTP
- uploads em `/uploads`
- arquitetura MVC leve própria

## Não usar

Não utilizar:

- Laravel
- Filament
- WordPress
- React
- Vue
- Next.js
- Nuxt
- Angular
- Node.js no servidor
- Composer obrigatório em produção
- npm obrigatório em produção
- Docker
- Vite obrigatório no servidor
- SSR
- SPA
- API externa obrigatória
- banco NoSQL
- symlink
- storage fora de `/public_html`
- comandos shell
- exec
- shell_exec
- proc_open
- system
- passthru
- mail()
- putenv

## Restrições da hospedagem

A hospedagem disponível possui:

- PHP 8.2.8
- Apache
- MySQL
- FTP
- banco de dados
- sem SSH confirmado
- sem Composer no servidor
- sem terminal
- funções shell bloqueadas
- symlink bloqueado
- mail() bloqueado
- document root em `/public_html`

Portanto, tudo deve funcionar apenas com upload via FTP.

## Estrutura sugerida

/public_html
/admin
/assets
/assets/css
/assets/js
/assets/images
/uploads
/includes
/views
/controllers
/models
/config
/core
index.php
.htaccess

## Painel administrativo

Criar painel próprio, limpo e muito fácil de usar.

Áreas do painel:

- Dashboard
- Home
- Quem Somos
- Setores
- Obras
- Como Atuamos
- Contato
- Banners
- SEO
- Configurações gerais
- Usuários

## Regras do painel

O painel deve ter:

- login seguro
- logout
- sessões seguras
- CRUD completo
- upload de imagens
- preview de imagem
- ordenação
- status ativo/inativo
- campos SEO por página
- mensagens claras de sucesso/erro
- layout responsivo
- navegação simples
- baixa curva de aprendizado

## Performance

O site deve:

- carregar rápido
- evitar bibliotecas desnecessárias
- usar imagens WebP quando possível
- usar lazy loading
- minimizar CSS e JS
- evitar animações pesadas
- evitar sliders excessivos
- gerar HTML limpo
- ter boa pontuação em Core Web Vitals

## SEO

Implementar:

- title por página
- meta description
- canonical
- Open Graph
- schema.org quando fizer sentido
- sitemap.xml
- robots.txt
- URLs amigáveis
- headings corretos
- textos editáveis pelo painel
- alt text nas imagens

## Segurança

Implementar:

- PDO com prepared statements
- proteção CSRF
- sanitização de entradas
- validação de uploads
- restrição de tipos de arquivos
- sessões seguras
- hash de senha com password_hash
- proteção contra acesso direto a arquivos sensíveis

## Regra principal

Não escolher tecnologias que exijam terminal, build no servidor, Composer em produção ou painel de hospedagem.

O projeto precisa ser simples de publicar copiando arquivos via FTP e importando o banco MySQL.