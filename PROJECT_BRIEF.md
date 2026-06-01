# PROJECT BRIEF - Mesquita Realizacoes

Documento de referencia para reconstruir o projeto em outra arquitetura mantendo estrutura, experiencia, CMS, logica, conteudos dinamicos, fluxo administrativo, identidade visual e comportamento das paginas.

## 1. Visao Geral

### Objetivo do site

O site apresenta a Mesquita Realizacoes como empresa de construcao industrial e infraestrutura para obras de grande porte. O objetivo principal e comunicar confiabilidade tecnica, experiencia, organizacao, previsibilidade e capacidade de execucao para empresas que precisam implantar, ampliar ou modernizar operacoes industriais.

O site tambem funciona como ferramenta comercial: apresenta setores de atuacao, portfolio de obras, metodo de trabalho, diferenciais institucionais e canal de contato com captura de leads.

### Publico-alvo

- Empresas industriais que precisam contratar obras de implantacao, expansao ou infraestrutura.
- Gestores industriais, equipes de engenharia, suprimentos, diretoria tecnica e decisores de obras.
- Clientes em setores como bioenergia, energia, industria e infraestrutura logistica.
- Visitantes que precisam validar experiencia, portfolio, capacidade tecnica e canais de contato.

### Posicionamento visual

O projeto tem posicionamento institucional, tecnico e premium. A linguagem visual usa contraste forte entre fundo escuro grafite e vermelho institucional. O layout evita excesso decorativo e prioriza clareza, blocos amplos, cards objetivos e hierarquia tipografica forte.

O visual transmite:

- Solidez e engenharia.
- Controle e previsibilidade.
- Industria e infraestrutura.
- Modernidade sem parecer startup ou produto SaaS.
- Seriedade comercial sem ficar excessivamente corporativo.

### Estilo do projeto

- Editorial institucional com secoes grandes e ritmadas.
- Heroes escuros com overlay, imagem opcional e padrao geometrico quando nao ha imagem.
- Cards brancos ou em fundo leve, com bordas discretas.
- Chamadas em vermelho para labels, botoes e detalhes de navegacao.
- Tipografia sans serif moderna: Inter para corpo e Manrope para titulos.
- Animacoes sutis de entrada, hover e carrosseis.

### Arquitetura geral do sistema

O sistema atual e uma aplicacao web com:

- Site publico renderizado server-side por templates Blade.
- CMS administrativo em Filament, acessado por `/painel`.
- Conteudos estruturados em tabelas relacionais.
- Conteudos textuais de paginas institucionais armazenados em um registro JSON por pagina.
- Configuracoes globais armazenadas em chave-valor.
- Uploads no disco publico, servidos por `/storage`.
- Formulario de contato assinado por CSRF, processado via JSON/AJAX, persistido como lead e enviado por e-mail quando SMTP esta configurado.
- Frontend com Alpine.js para interacoes locais, Swiper para carrosseis, GLightbox para galeria, AOS para animacoes de entrada e IMask para mascara de telefone.

## 2. Mapa do Site

### Paginas publicas

- Home: `/`
- Quem Somos: `/quem-somos`
- Setores: `/setores`
- Obras: `/obras`
- Detalhe de obra: `/obras/{slug}`
- Como Atuamos: `/como-atuamos`
- Contato: `/contato`
- Redirect legado: `/sobre` redireciona 301 para `/quem-somos`

### Hierarquia de navegacao

Menu principal no header:

- Home
- Quem Somos
- Setores
- Obras
- Como Atuamos
- CTA fixo do header: Fale Conosco

Footer:

- Coluna institucional com logo, texto curto e redes sociais.
- Coluna Navegacao com Home, Quem Somos, Setores, Obras, Como Atuamos e Contato.
- Coluna Setores gerada dinamicamente a partir dos setores ativos.
- Coluna Contato com endereco, telefone e e-mail vindos de configuracoes globais.

Nao ha submenus no header. A pagina Setores possui navegacao interna por ancoras, com sidebar sticky no desktop e menu horizontal com scroll no mobile.

### Estrutura do header

- Header fixo no topo.
- Altura aproximada: 72px no mobile e 80px no desktop.
- Logo principal em `public/images/logo.svg`.
- Em paginas com hero fullscreen, o header inicia transparente enquanto o usuario esta no topo; depois fica branco com sombra discreta.
- O header se oculta ao rolar para baixo depois de 200px e reaparece ao rolar para cima.
- No desktop, exibe menu horizontal e botao "Fale Conosco".
- No mobile, exibe botao hamburguer que abre painel lateral direito com overlay escuro.
- Link ativo recebe destaque vermelho e underline animado.

### Estrutura do footer

- Fundo `escuro-premium`.
- Logo branco em `public/images/logo-white.svg`.
- Texto institucional estatico.
- Redes sociais condicionais: LinkedIn, Instagram e Facebook aparecem se houver URL configurada.
- Setores dinamicos: lista todos os setores ativos ordenados por `ordem`, apontando para `/setores#{slug}`.
- Contato dinamico: endereco com quebras de linha, telefone com link `tel:` e e-mail com link `mailto:`.
- Copyright com ano atual.

## 3. Componentes Globais

### CTA mobile fixo

Exibido somente em telas pequenas quando telefone ou WhatsApp existem nas configuracoes globais. Fica fixo no rodape mobile.

- Botao "Ligar": usa telefone normalizado sem caracteres nao numericos.
- Botao "WhatsApp": usa `https://wa.me/{whatsapp}`.

### WhatsApp flutuante

Exibido quando ha WhatsApp configurado. Aparece apos rolagem de 300px. No desktop fica no canto inferior direito; no mobile respeita o CTA inferior. Possui tooltip no hover.

### Voltar ao topo

Botao circular que aparece apos rolagem de 500px. Executa scroll suave para o topo.

### Toast global

Sistema de notificacoes em Alpine.js com tipos `success`, `error` e `info`. Usado principalmente no formulario de contato.

### Breadcrumb

Componente reutilizavel que:

- Renderiza trilha visual.
- Gera JSON-LD `BreadcrumbList`.
- E usado no detalhe de obra.

## 4. Paginas Publicas

### Home (`/`)

Objetivo: apresentar rapidamente a empresa, direcionar para portfolio, setores, metodo e contato.

Ordem exata das secoes:

1. Hero principal
2. Setores de atuacao
3. Obras em destaque
4. Diferenciais / Por que confiar
5. Como Atuamos resumido
6. CTA final

Hero:

- Se houver banners ativos, usa carrossel Swiper com todos os banners ativos, ordenados por `ordem`.
- Cada banner possui label, headline, subheadline, imagem, botao primario e botao secundario.
- Se o banner nao tiver imagem, usa fundo grafite com padrao geometrico discreto.
- Se houver mais de um banner, exibe paginacao e setas.
- Autoplay de 6 segundos, efeito fade, pausa no hover, loop ativo.
- Respeita `prefers-reduced-motion` desativando autoplay.
- Caso nao haja banners, usa os campos antigos de hero vindos de `PaginaConteudo.home`.

Setores de atuacao:

- Fundo `fundo-leve`.
- Cabecalho visual com label vermelho, titulo e subtitulo.
- Cards dinamicos de setores ativos ordenados por `ordem`.
- Cada card exibe icone SVG de `public/icons/{icone}.svg`, titulo curto, descricao curta e link "Saiba mais".
- Link automatico: `/setores#{slug}`.
- Grid: 1 coluna mobile, 2 em tablet, 4 em desktop.

Obras em destaque:

- Fundo branco.
- Cabecalho editavel via CMS: label, titulo, subtitulo e texto do link para portfolio.
- Obras dinamicas: somente `ativo = true` e `destaque = true`, ordenadas por `ordem`.
- Exibicao em carrossel Swiper.
- Card exibe imagem principal ou placeholder, setor, titulo, cliente, localizacao e CTA de detalhe.
- Breakpoints do carrossel: 1 card mobile, 2 em telas medias, 3 em desktop.

Diferenciais:

- Fundo `fundo-leve`.
- Cabecalho editavel via Home Page do CMS.
- Cards dinamicos de `Diferencial` com `ativo = true` e `exibir_em` em Home ou Ambas.
- Card tem linha vermelha decorativa, titulo e texto curto.
- Colunas se ajustam conforme quantidade: 1, 2, 3 ou 4 colunas no desktop.

Como Atuamos resumido:

- Fundo grafite.
- Usa as 3 primeiras etapas ativas do processo, ordenadas por `ordem`.
- Desktop: tres colunas com numero grande, titulo e descricao.
- Mobile: accordion em Alpine.js.
- CTA leva para `/como-atuamos`.

CTA final:

- Fundo `escuro-premium`.
- Conteudo vem primeiro dos campos da Home; se vazios, cai para configuracoes globais.
- Botao primario vermelho e botao secundario opcional com contorno branco.
- Botoes so devem aparecer quando texto e link existirem.

SEO:

- `seo_title` e `seo_description` vindos de `PaginaConteudo.home`.
- Open Graph herda os mesmos campos.
- JSON-LD com `Organization` e `WebPage`.

### Quem Somos (`/quem-somos`)

Objetivo: contar posicionamento institucional, experiencia, diferenciais e valores.

Ordem exata das secoes:

1. Hero
2. Experiencia
3. Frase institucional
4. Diferenciais
5. Valores
6. CTA final

Hero:

- Altura minima aproximada: 70vh.
- Fundo com imagem opcional `hero_imagem` ou fundo grafite com padrao geometrico.
- Conteudo: label, headline e subheadline de `PaginaConteudo.quem-somos`.

Experiencia:

- Layout desktop em 3 colunas: card de destaque na lateral esquerda e texto na direita.
- Card mostra numero destacado, texto complementar e linha vermelha.
- Texto principal e rich text vindo de `exp_texto`.

Frase institucional:

- Secao escura com imagem opcional `frase_imagem`.
- Exibe aspas grandes decorativas e frase centralizada.

Diferenciais:

- Usa `Diferencial` com `ativo = true` e `exibir_em` em Quem Somos ou Ambas.
- Grid 1/2/4 colunas conforme viewport.
- Card com borda, linha vermelha, titulo e texto.

Valores:

- Usa `Valor` ativo ordenado por `ordem`.
- Desktop: lista lateral de valores e painel de detalhe interativo. O estado ativo e controlado por Alpine.js.
- Mobile: accordion, primeiro item aberto.
- Cada valor pode ter icone, titulo, resumo, texto e ate tres topicos.

CTA final:

- Campos da pagina com fallback para CTA global.

SEO:

- `seo_title` e `seo_description` de `PaginaConteudo.quem-somos`.
- JSON-LD `WebPage` e `BreadcrumbList`.

### Setores (`/setores`)

Objetivo: detalhar cada setor de atuacao e conectar o usuario ao portfolio filtrado.

Ordem exata das secoes:

1. Hero
2. Navegacao interna + lista detalhada de setores
3. CTA final

Hero:

- Altura minima aproximada: 60vh.
- Imagem opcional `hero_imagem`, com overlay grafite; fallback grafite geometrico.
- Conteudo editavel via `PaginaConteudo.setores`: label, headline e subheadline.

Navegacao interna:

- Mobile: chips horizontais com scroll, cada um apontando para `#{slug}`.
- Desktop: sidebar sticky com lista de setores. Um IntersectionObserver atualiza visualmente o setor ativo.

Lista de setores:

- Todos os setores ativos ordenados por `ordem`.
- Cada artigo tem `id={slug}` e alterna layout de imagem/texto em desktop.
- Imagem quadrada de setor ou placeholder "Imagem nao cadastrada".
- Conteudo: label "SETOR", titulo da pagina, descricao rich text e botao.
- Botao aponta automaticamente para `/obras?setor={slug}`.

CTA final:

- Vem de `PaginaConteudo.setores` com fallback global.

SEO:

- `seo_title` e `seo_description` de `PaginaConteudo.setores`.
- JSON-LD `WebPage`.

### Obras (`/obras`)

Objetivo: listar o portfolio de obras e permitir busca/filtro por setor.

Ordem exata das secoes:

1. Hero
2. Filtros + grid de obras
3. Paginacao
4. CTA final

Hero:

- Altura minima aproximada: 50vh.
- Label, headline, subheadline e imagem opcional de `PaginaConteudo.obras`.

Filtros:

- Container branco com borda sobre fundo leve.
- Campo de busca local por titulo, cliente, setor e localizacao.
- Select de setor, exibindo apenas setores ativos que possuem obras ativas.
- Contador de obras atualizado pelo filtro.
- Botao "Limpar filtros" aparece quando ha busca ou setor ativo.
- O filtro por setor sincroniza a query string `?setor={slug}`.
- A busca client-side so filtra efetivamente a partir de 2 caracteres.

Grid:

- Obras ativas, ordenadas por `ordem`, paginadas em 9 por pagina.
- Cada card exibe imagem principal ou primeira imagem da galeria ou placeholder.
- Exibe setor como badge, titulo, cliente, localizacao e link de detalhe.
- Cards filtrados client-side entram/saem com transicao.
- Estado vazio servidor: nenhuma obra cadastrada.
- Estado vazio client-side: nenhuma obra encontrada, com botao para limpar filtros.

Paginacao:

- Server-side.
- Fica oculta quando ha filtro client-side ativo.
- Textos anterior/proxima sao editaveis via CMS.

CTA final:

- Campos da pagina com fallback global.

SEO:

- `seo_title` e `seo_description` de `PaginaConteudo.obras`.
- JSON-LD `WebPage`, `BreadcrumbList` e `ItemList`.

### Detalhe de Obra (`/obras/{slug}`)

Objetivo: apresentar detalhes tecnicos, imagens e contexto de uma obra especifica.

Ordem exata das secoes:

1. Hero da obra
2. Breadcrumb
3. Detalhes + descricao
4. Galeria, se houver imagens
5. Obras relacionadas, se houver
6. CTA final especifico de detalhe

Hero:

- Usa `imagem_principal`; se ausente, usa primeira imagem da galeria; se ausente, fundo grafite.
- Overlay em gradiente de baixo para cima.
- Exibe setor como badge, titulo e localizacao.

Detalhes:

- Layout desktop: card lateral sticky e conteudo principal.
- Card lateral exibe cliente, setor, localizacao, periodo e status se existirem.
- Periodo: `data_inicio -> data_conclusao`; se nao houver conclusao, exibe status em andamento.
- Status: `1 = Concluida`, `2 = Em andamento`.

Descricao:

- Exibe subtitulo, label, titulo de descricao e rich text `descricao`.
- Se houver `escopo`, exibe bloco separado "Escopo tecnico".

Galeria:

- Exibida somente quando a obra possui imagens relacionadas.
- Grid 2 colunas mobile, 3 medio, 4 desktop.
- Cada imagem abre em GLightbox.
- Usa `alt` e `legenda` cadastrados.
- Legenda aparece no hover.

Obras relacionadas:

- Primeiro busca outras obras ativas do mesmo setor, excluindo a atual, ate 3.
- Se nao houver, busca outras obras ativas gerais, ate 3.
- Cards similares aos da listagem.

CTA final:

- Usa campos `show_cta_*` de `PaginaConteudo.obras`.

SEO:

- Por obra: `seo_title`, `seo_description`, `seo_image`.
- Fallback de title: `{title} | Mesquita Realizacoes`.
- Fallback de description: descricao ou subtitulo limitado a 155 caracteres.
- Fallback de OG image: `seo_image`, depois `imagem_principal`.
- JSON-LD `WebPage`, `BreadcrumbList` e `ImageGallery` quando ha galeria.

### Como Atuamos (`/como-atuamos`)

Objetivo: explicar metodo, processo e gestao de execucao.

Ordem exata das secoes:

1. Hero
2. Metodo
3. Processo interativo
4. Gestao da execucao
5. Previsibilidade
6. CTA final

Hero:

- Label, headline, subheadline e imagem opcional de `PaginaConteudo.como-atuamos`.
- Fundo grafite geometrico quando nao ha imagem.

Metodo:

- Layout 2 colunas.
- Texto principal rich text.
- Card lateral sticky de pontos-chave quando existem topicos no repeater `metodo_topicos`.

Processo:

- Usa `EtapaProcesso` ativo, ordenado por `ordem`.
- Desktop: lista de etapas a esquerda e painel detalhado a direita, controlado por Alpine.js.
- Mobile: accordion por etapa.
- Cada etapa pode conter numero, titulo, descricao, bloco de topicos, ate tres topicos, titulo de resultado e texto de resultado.

Gestao da execucao:

- Usa `GestaoCard` ativo, ordenado por `ordem`.
- Grid dinamico: 2, 3 ou 4 colunas no desktop conforme quantidade.
- Cada card exibe icone SVG, titulo e texto.

Previsibilidade:

- Layout 2 colunas.
- Texto rich text a esquerda.
- Card com resultados praticos vindo do repeater `prev_topicos`.

CTA final:

- Campos especificos da pagina com fallback global.

SEO:

- `seo_title` e `seo_description` de `PaginaConteudo.como-atuamos`.
- JSON-LD `WebPage` e `BreadcrumbList`.

### Contato (`/contato`)

Objetivo: capturar leads comerciais e exibir canais de atendimento.

Ordem exata das secoes:

1. Introducao
2. Formulario + canais
3. Mapa, se configurado

Introducao:

- Fundo leve.
- Label, headline e subheadline vindos de `PaginaConteudo.contato`.

Formulario:

- Envio sem reload via fetch JSON.
- CSRF via meta tag.
- Estado loading no botao.
- Estado de sucesso substitui o formulario por confirmacao.
- Toast global exibe retorno de sucesso ou erro.
- Honeypot oculto `website`.
- Campos: nome, empresa, e-mail, telefone, tipo de projeto, local, mensagem.
- Contador de caracteres em mensagem, limite 2000.
- Mascara de telefone com IMask.

Validacoes server-side:

- `nome`: obrigatorio, string, max 100.
- `empresa`: obrigatorio, string, max 100.
- `email`: obrigatorio, e-mail, max 100.
- `telefone`: obrigatorio, string, max 20.
- `tipo_projeto`: obrigatorio, enum `implantacao`, `expansao`, `infraestrutura-produtiva`, `infraestrutura-logistica`, `outro`.
- `local`: opcional, string, max 100.
- `mensagem`: obrigatorio, string, max 2000.

Anti-spam e seguranca:

- Honeypot retorna sucesso falso para bots sem gravar lead.
- Rate limit de 3 envios por hora por IP.
- Sanitizacao remove tags e normaliza espacos antes de salvar.

Persistencia e e-mail:

- Todo envio valido vira registro em `leads` com status `1 = Novo`.
- E-mail destino usa `email_leads`; se vazio, usa `email`.
- Falha de SMTP e registrada em log, mas nao bloqueia retorno de sucesso ao usuario.

Canais:

- Endereco, telefone e e-mail vindos de configuracoes globais.
- Redes sociais condicionais.

Mapa:

- Se `maps_embed` existir, renderiza iframe embed em container 16:9.

SEO:

- `seo_title` e `seo_description` de `PaginaConteudo.contato`.
- JSON-LD `WebPage`, `LocalBusiness` e `BreadcrumbList`.

## 5. CMS / Painel Administrativo

### Estrutura geral

Painel administrativo em `/painel`, com login Filament. O acesso ao painel e permitido para qualquer usuario autenticado pelo metodo `canAccessPanel`.

Grupos de navegacao:

- Paginas do Site
- Conteudo
- Comercial
- Sistema

Dashboard:

- Widget de conta.
- Widget de resumo com: obras cadastradas ativas, setores ativos, leads novos e total de leads.

### Modulo: Banners

Objetivo: gerenciar banners do hero da Home.

Campos:

- `label`: texto, opcional, max 100. Aparece acima da headline.
- `headline`: texto, obrigatorio, max 150. Titulo principal.
- `subheadline`: textarea, opcional, max 255.
- `imagem`: imagem, opcional, disco public, formatos JPG/PNG/WebP, max 5MB.
- `botao_primario_texto`: texto, opcional, max 60.
- `botao_primario_link`: texto/link, opcional, max 255.
- `botao_secundario_texto`: texto, opcional, max 60.
- `botao_secundario_link`: texto/link, opcional, max 255.
- `ativo`: boolean, default true.
- `ordem`: numero, default 0, minimo 0.

Regras:

- Somente banners ativos aparecem.
- Ordem crescente define sequencia.
- Botao primario ou secundario so aparece quando texto e link estao preenchidos.
- Se imagem estiver ausente, usa fundo padrao escuro.
- Imagem ideal: 1920x1080, 16:9.
- O servico de imagem possui processamento para WebP e limite 1920x1080, mas o upload Filament atual salva em `banners-temp`; preservar a intencao de otimizacao.

Listagem:

- Imagem, titulo/headline, label como descricao, botao primario, ordem e toggle ativo.
- Filtro por status.
- Reordenacao por `ordem`.
- Exclusao remove imagem associada quando usado o fluxo configurado.

### Modulo: Setores

Objetivo: gerenciar setores de atuacao exibidos na Home, na pagina Setores, no filtro de Obras e no footer.

Campos:

- `title`: texto, obrigatorio, max 100. Nome base do setor.
- `slug`: texto, obrigatorio, unico, max 100. Gerado automaticamente pelo title.
- `icone`: texto, opcional, max 50. Nome de SVG em `public/icons`.
- `titulo_home`: texto, opcional, max 30. Fallback: `title`.
- `descricao_curta`: textarea, opcional, max 80. Usada no card da Home.
- `imagem`: imagem, opcional, 1:1, ideal 550x550, max 3MB.
- `titulo_pagina`: texto, opcional, max 60. Fallback: `title`.
- `descricao`: rich text, opcional. Usada na pagina Setores.
- `botao_texto`: texto, opcional, max 50. Fallback: "Ver obras de {nome do setor}".
- `ordem`: numero, default 0.
- `ativo`: boolean, default true.

Relacionamentos:

- Setor tem muitas Obras.
- Obras pertencem a um Setor.

URLs geradas:

- Ancora da pagina Setores: `/setores#{slug}`.
- Portfolio filtrado: `/obras?setor={slug}`.

Regras:

- Somente setores ativos aparecem no site e nos filtros.
- Footer lista setores ativos.
- Filtro de Obras lista apenas setores ativos com obras ativas.
- Ordem crescente define exibicao.

Listagem:

- Imagem, icone, nome do setor, descricao curta, contagem de obras, ordem e toggle ativo.
- Filtro por ativo.
- Reordenacao por `ordem`.

### Modulo: Obras

Objetivo: gerenciar portfolio de obras, detalhes, galeria, SEO e destaque na Home.

Campos de dados:

- `title`: texto, obrigatorio, max 200.
- `slug`: texto, obrigatorio, unico, max 200, gerado pelo titulo.
- `cliente`: texto, opcional, max 100.
- `setor_id`: relacionamento opcional com setor ativo.
- `localizacao`: texto, opcional, max 100.
- `subtitulo`: texto, opcional, max 200.
- `data_inicio`: texto, opcional, max 20.
- `data_conclusao`: texto, opcional, max 20.
- `status`: select obrigatorio, `1 = Concluida`, `2 = Em andamento`.

Campos de conteudo:

- `descricao`: rich text, opcional.
- `escopo`: rich text, opcional.

Campos de imagem:

- `imagem_principal`: imagem, opcional, disco public, pasta `obras`, max 5MB.
- Galeria `imagens`: relacionamento hasMany com `ObraImagem`.
- Para cada imagem de galeria:
  - `caminho`: imagem, obrigatoria, pasta `obras/galerias`, max 5MB.
  - `alt`: texto, obrigatorio, max 200.
  - `legenda`: texto, obrigatorio, max 200.
  - `ordem`: numero usado pelo repeater.

Campos de configuracao:

- `destaque`: boolean. Se true e ativo, aparece no carrossel da Home.
- `ativo`: boolean. Se false, nao aparece na listagem nem no detalhe publico.
- `ordem`: numero. Define ordenacao em listagens, destaque e relacionadas.

Campos SEO:

- `seo_title`: texto, opcional, max 60.
- `seo_description`: textarea, opcional, max 155.
- `seo_image`: imagem Open Graph, opcional, pasta `seo`, max 2MB, ideal 1200x630.

Regras:

- Detalhe publico so abre obra ativa.
- Slug define URL `/obras/{slug}`.
- Se a obra nao tem imagem principal, cards e hero usam primeira imagem da galeria.
- Obras relacionadas priorizam mesmo setor e fazem fallback para outras obras.

Listagem:

- Foto, titulo, cliente, setor, status, destaque, ativo e ordem.
- Filtros por setor, status, destaque e ativo.
- Reordenacao por `ordem`.

### Modulo: Diferenciais

Objetivo: gerenciar cards de diferenciais usados na Home e/ou Quem Somos.

Campos:

- `titulo`: texto, obrigatorio, max 25 no CMS, max 100 na tabela.
- `texto`: textarea, opcional, max 100 no CMS.
- `icone`: texto, opcional, max 50.
- `exibir_em`: select obrigatorio, `1 = Home`, `2 = Quem Somos`, `3 = Ambas`.
- `ordem`: numero, default 0.
- `ativo`: boolean, default true.

Regras:

- Home carrega `exibir_em` 1 ou 3.
- Quem Somos carrega `exibir_em` 2 ou 3.
- Somente ativos aparecem.
- Grid se adapta ao numero de itens.

### Modulo: Valores

Objetivo: gerenciar valores institucionais exibidos na pagina Quem Somos.

Campos:

- `titulo`: texto, obrigatorio, max 100.
- `resumo`: texto, opcional, max 150.
- `texto`: textarea, opcional.
- `icone`: texto, opcional, max 50.
- `topico_1`: texto, opcional, max 150.
- `topico_2`: texto, opcional, max 150.
- `topico_3`: texto, opcional, max 150.
- `ordem`: numero, default 0.
- `ativo`: boolean, default true.

Regras:

- Somente valores ativos aparecem em Quem Somos.
- Desktop usa lista lateral + painel.
- Mobile usa accordion.

### Modulo: Etapas do Processo

Objetivo: gerenciar etapas usadas na Home e em Como Atuamos.

Campos:

- `numero`: texto, obrigatorio, max 10.
- `titulo`: texto, obrigatorio, max 100.
- `descricao`: textarea, opcional, max 255.
- `icone`: texto, opcional, max 50.
- `bloco_titulo`: texto, opcional, max 100.
- `topico_1`: texto, opcional, max 200.
- `topico_2`: texto, opcional, max 200.
- `topico_3`: texto, opcional, max 200.
- `resultado_titulo`: texto, opcional, max 100.
- `resultado_texto`: textarea, opcional, max 255.
- `ordem`: numero, default 0.
- `ativo`: boolean, default true.

Regras:

- Home usa as 3 primeiras etapas ativas.
- Como Atuamos usa todas as etapas ativas.
- Ordem crescente define sequencia.

### Modulo: Cards de Gestao

Objetivo: gerenciar cards da secao "Gestao da execucao" em Como Atuamos.

Campos:

- `icone`: texto, obrigatorio, max 50.
- `titulo`: texto, obrigatorio, max 100.
- `texto`: textarea, opcional, max 255.
- `ordem`: numero, default 0.
- `ativo`: boolean, default true.

Regras:

- Somente ativos aparecem.
- Ordem crescente define exibicao.
- Grid desktop se adapta a quantidade.

### Modulo: Leads

Objetivo: armazenar e gerenciar contatos recebidos pelo formulario.

Campos persistidos:

- `nome`: texto, obrigatorio no formulario, max 100.
- `empresa`: texto, obrigatorio no formulario, max 100.
- `email`: e-mail, obrigatorio, max 100.
- `telefone`: texto, obrigatorio, max 20.
- `tipo_projeto`: texto enum, obrigatorio.
- `local`: texto, opcional, max 100.
- `mensagem`: textarea, obrigatoria, max 2000.
- `ip`: texto, max 45.
- `status`: inteiro.

Status:

- 1: Novo
- 2: Visualizado
- 3: Em contato
- 4: Convertido
- 5: Descartado

Tela administrativa:

- Visualizacao com secoes Dados do contato, Mensagem e Controle.
- Edicao permite alterar apenas status; dados do contato ficam desabilitados.
- Listagem exibe nome, empresa, e-mail, tipo de projeto, data e status.
- Badge no menu mostra quantidade de leads novos.

### Modulo: Configuracoes Globais

Objetivo: gerenciar informacoes compartilhadas por todo o site.

Armazenamento: tabela `configuracoes` em chave-valor.

Campos:

- `telefone`: texto, max 20.
- `whatsapp`: texto, max 20, com DDI e sem simbolos.
- `email`: e-mail de contato, max 100.
- `email_leads`: e-mail para receber leads, max 100.
- `endereco`: textarea.
- `linkedin`: URL, max 255.
- `instagram`: URL, max 255.
- `facebook`: URL, max 255.
- `maps_embed`: textarea com iframe do Google Maps.
- `ga_id`: texto, max 20.
- `cta_titulo`: texto, max 120.
- `cta_texto`: textarea.
- `cta_btn1_texto`: texto, max 60.
- `cta_btn1_link`: texto/link, max 255.
- `cta_btn2_texto`: texto, max 60, opcional.
- `cta_btn2_link`: texto/link, max 255.

Uso no site:

- Header/mobile/floating CTAs usam telefone e WhatsApp.
- Footer e pagina Contato usam endereco, telefone, e-mail e redes.
- Formulario usa `email_leads` ou fallback `email`.
- CTAs finais usam configuracao global quando a pagina nao define conteudo proprio.

Cache:

- Configuracoes sao cacheadas por 3600 segundos.
- Ao salvar, o cache `site_config` e limpo.

### Modulo: Paginas do Site / Conteudos Institucionais

Objetivo: armazenar textos de paginas publicas em `pagina_conteudos`.

Estrutura:

- `pagina`: identificador unico: `home`, `quem-somos`, `setores`, `obras`, `como-atuamos`, `contato`.
- `campos`: JSON com chaves de conteudo.

Regras:

- O recurso generico usa editor KeyValue para campos.
- Home e Como Atuamos possuem paginas administrativas customizadas para parte dos campos.
- Quem Somos, Obras, Setores e Contato dependem majoritariamente do editor generico KeyValue ou de seeds.
- Textos rich text devem preservar HTML nos campos existentes.

Principais grupos de campos:

- Hero: `hero_label`, `hero_headline`, `hero_subheadline`, `hero_imagem`.
- Secoes: labels, titulos, textos e botoes especificos.
- CTA: `cta_titulo`, `cta_texto`, `cta_btn1_texto`, `cta_btn1_link`, `cta_btn2_texto`, `cta_btn2_link`.
- SEO: `seo_title`, `seo_description`.
- Obras detalhe: labels de breadcrumb, detalhes, galeria, relacionadas e CTA de detalhe.
- Contato: labels, placeholders, textos de erro e sucesso.

## 6. Estrutura de Dados

### Entidades e relacionamentos

- `Setor` possui muitas `Obra`.
- `Obra` pertence a `Setor`.
- `Obra` possui muitas `ObraImagem`.
- `ObraImagem` pertence a `Obra` e e excluida em cascata quando a obra e excluida.
- `Diferencial`, `Valor`, `EtapaProcesso`, `GestaoCard`, `Banner`, `Configuracao`, `PaginaConteudo` e `Lead` sao entidades independentes.

### Ordenacao

Campos `ordem` controlam exibicao em:

- Banners
- Setores
- Obras
- Diferenciais
- Valores
- Etapas do Processo
- Cards de Gestao
- Imagens da galeria de Obras

### Status e publicacao

Campos booleanos `ativo` controlam visibilidade publica em:

- Banners
- Setores
- Obras
- Diferenciais
- Valores
- Etapas do Processo
- Cards de Gestao

Obras tambem possuem:

- `destaque`: determina exibicao na Home.
- `status`: estado operacional da obra, concluida ou em andamento.

### Uploads

Estrutura esperada:

- `storage/app/public/banners`
- `storage/app/public/banners-temp`
- `storage/app/public/setores`
- `storage/app/public/setores-temp`
- `storage/app/public/obras`
- `storage/app/public/obras/galerias`
- `storage/app/public/seo`
- `storage/app/public/paginas`

O site acessa uploads por `/storage/{caminho}`.

## 7. Experiencia do Usuario

### Fluxo do visitante

Fluxo principal:

1. Entra pela Home.
2. Entende rapidamente posicionamento no hero.
3. Explora setores ou obras em destaque.
4. Valida diferenciais e metodo.
5. Acessa portfolio ou contato.
6. Envia briefing pelo formulario.

Fluxo por setor:

1. Entra em Setores.
2. Navega por ancoras.
3. Clica em "Ver obras de..." para abrir Obras filtradas.
4. Abre detalhe de obra.
5. Finaliza no CTA de contato.

Fluxo por obra:

1. Abre listagem de Obras.
2. Filtra por setor ou busca por termo.
3. Abre detalhe.
4. Analisa dados, descricao, escopo e galeria.
5. Vai para contato pelo CTA.

### Fluxo do administrador

Fluxo editorial comum:

1. Acessa `/painel`.
2. Atualiza configuracoes globais.
3. Gerencia banners da Home.
4. Cadastra setores.
5. Cadastra obras e galerias.
6. Ajusta diferenciais, valores, etapas e cards de gestao.
7. Edita textos de paginas via paginas customizadas ou KeyValue.
8. Acompanha leads e muda status comercial.

### Experiencia mobile

- Header vira menu lateral.
- CTA de telefone/WhatsApp fica fixo no rodape.
- Cards empilham em uma coluna.
- Setores ganham navegacao horizontal por chips.
- Etapas e valores usam accordions.
- Botao de submit ocupa largura total quando necessario.
- Touch targets tem minimo 44px.

### Microinteracoes

- Header transparente/solido conforme scroll.
- Header oculta ao rolar para baixo e reaparece ao rolar para cima.
- Hover em cards altera borda, cor do titulo e escala da imagem.
- Links com seta aumentam gap no hover.
- AOS faz entradas `fade-up`, `fade-left`, `fade-right`.
- Swiper usa fade no hero e carrossel horizontal em obras.
- Lightbox amplia imagens da galeria.
- Toasts entram lateralmente.
- Filtros de obras atualizam contador e grid sem recarregar.

## 8. Identidade Visual

### Paleta de cores

- Vermelho principal: `#D71920`
- Vermelho escuro: `#A31218`
- Vermelho suave: `#FDECEC`
- Grafite: `#1F2937`
- Grafite medio: `#2B2B2E`
- Texto secundario: `#6B7280`
- Borda: `#E5E7EB`
- Fundo leve: `#F7F8FA`
- Escuro premium: `#18191C`
- WhatsApp: `#25D366`

### Tipografia

- Corpo: Inter.
- Titulos: Manrope.
- Fallback: sans serif do sistema.
- Labels: uppercase, tamanho pequeno, tracking amplo, peso semibold, normalmente vermelho.
- H1: Manrope bold, grande, branco em heroes.
- H2: Manrope bold, grafite ou branco conforme fundo.

### Layout e grid

- Container centralizado com padding responsivo.
- Secoes amplas: geralmente `py-20` mobile e `py-28` desktop.
- Heroes com alturas entre 50vh e 100vh.
- Grids responsivos 1/2/3/4 colunas.
- Cards com borda `borda`, fundo branco ou `fundo-leve`, radius normalmente entre 8px e 12px.

### Botoes

- Primario: fundo vermelho, texto branco, hover vermelho escuro.
- Secundario em fundo escuro: borda branca translucida, hover com fundo branco translucido.
- Links textuais: vermelho, semibold, seta opcional.
- CTA mobile: botoes grandes, metade telefone e metade WhatsApp.

### Iconografia

- SVGs locais em `public/icons`.
- Heroicons no painel.
- Icones inline para telefone, e-mail, endereco, setas, busca, fechar, check e outros detalhes.
- Phosphor Icons sao referenciados conceitualmente no CMS, mas no site os icones usados nos cards sao carregados como SVG local quando existem.

### Imagens

- Heroes usam imagem de fundo com overlay grafite.
- Setores usam imagem quadrada.
- Obras usam imagens 4:3 nos cards.
- Detalhe de obra usa hero amplo e galeria 4:3.
- Quando nao ha imagem, o sistema usa placeholders ou fundo escuro geometrico.

## 9. SEO

### Estrutura SEO geral

Layout global inclui:

- `<title>` por pagina.
- Meta description.
- Meta robots, default `index, follow`.
- Canonical para URL atual.
- Open Graph title, description, image, type, URL, locale e site name.
- Twitter card `summary_large_image`.

### Open Graph

- Default de OG image aponta para `images/og-default.jpg`, mas este arquivo deve ser verificado porque nao apareceu no inventario inicial.
- Obras podem sobrescrever com `seo_image` ou `imagem_principal`.

### Dados estruturados

- Home: `Organization` e `WebPage`.
- Quem Somos: `WebPage` e `BreadcrumbList`.
- Setores: `WebPage`.
- Obras listagem: `WebPage`, `BreadcrumbList`, `ItemList`.
- Obra detalhe: `WebPage`, `BreadcrumbList`, `ImageGallery` quando houver imagens.
- Como Atuamos: `WebPage` e `BreadcrumbList`.
- Contato: `WebPage`, `LocalBusiness` e `BreadcrumbList`.

### Robots e sitemap

- `public/robots.txt` permite todos os agentes e nao bloqueia rotas.
- Nao foi encontrado sitemap no projeto. Se a reconstrucao exigir paridade, manter ausencia ou documentar criacao separadamente como melhoria, nao como comportamento atual.

### Slugs

- Setores: slug unico usado em ancoras e filtros.
- Obras: slug unico usado em URL amigavel.
- Slugs sao gerados automaticamente no admin a partir do titulo/nome, mas podem ser editados.

## 10. Performance

### Estrategias atuais

- Assets frontend compilados com Vite.
- Imagens com `loading="lazy"` na maioria das imagens abaixo do hero.
- Fontes Google carregadas com `preconnect` e `preload` com fallback `noscript`.
- Configuracoes globais cacheadas por 1 hora.
- Pagina Como Atuamos cacheia o registro de conteudo por 1 hora.
- Uploads possuem validacao de tamanho.
- Algumas imagens sao previstas para conversao WebP pelo `ImagemService`.

### Dependencias frontend

- Alpine.js: menus, accordions, filtros, formulario e toasts.
- Swiper: hero da Home e carrossel de obras.
- GLightbox: galeria de obra.
- AOS: animacoes de entrada.
- IMask: mascara de telefone.
- Tailwind CSS: layout e design.

### Pontos de atencao de performance

- Footer consulta setores diretamente na view; em escala, deveria ser cacheado na reconstrucao, mas o comportamento atual e consulta dinamica.
- A listagem de Obras envia `obrasJson` com todas as obras ativas da consulta para filtro client-side; em portfolio grande isso pode crescer.
- Algumas imagens de upload nao passam necessariamente pelo servico de otimizacao, dependendo do fluxo Filament usado.
- Scripts de bibliotecas vendor sao carregados globalmente em todas as paginas, mesmo quando nem todas usam todas as bibliotecas.

## 11. Analise Critica

### O que e excelente

- Arquitetura editorial clara, com separacao entre entidades estruturadas e textos de pagina.
- CMS cobre praticamente todo conteudo comercial relevante.
- Experiencia publica e consistente, institucional e objetiva.
- Boa modelagem para Obras, Setores, galeria, diferenciais, valores e leads.
- Fluxo de contato robusto com validacao, honeypot, rate limit, persistencia e e-mail.
- SEO bem distribuido por pagina e obra.
- Boa responsividade com comportamentos especificos para mobile.

### O que deve ser preservado

- Estrutura de paginas e ordem das secoes.
- Distincao entre conteudo institucional em JSON e entidades estruturadas.
- Relacionamento Obra-Setor e galeria de Obra.
- Filtro de Obras por setor e busca local.
- CTA mobile fixo para telefone/WhatsApp.
- Header fixo com comportamento por scroll.
- Identidade vermelho/grafite, tipografia Inter/Manrope e estilo institucional tecnico.
- CMS de leads com status comercial.
- Fallbacks de imagem e texto.

### O que pode ser simplificado

- Consolidar a edicao de todas as paginas institucionais em telas customizadas em vez de KeyValue generico.
- Evitar duplicidade de campos antigos e novos em `PaginaConteudo.como-atuamos` observada nos seeds.
- Padronizar labels de Home: os seeds usam `diferenciais_*`, enquanto a view e o admin customizado usam `confiar_*` em alguns pontos.
- Centralizar CTAs finais em um componente reutilizavel com mesmas regras.
- Centralizar heroes institucionais em um componente unico.

### O que deve ser melhorado

- Corrigir mojibake/encoding em diversos textos de seed, labels e comentarios. O conteudo pretendido e portugues, mas ha caracteres corrompidos em varios arquivos.
- Verificar existencia real de `public/images/og-default.jpg`, usado como fallback de Open Graph.
- Integrar `ga_id` no layout, pois atualmente o campo existe no CMS mas nao ha renderizacao identificada.
- Criar sitemap, caso SEO organico seja prioridade.
- Garantir processamento consistente de imagens para WebP nos uploads de banners e setores.
- Melhorar cache para listas globais como setores do footer.
- Revisar `FILESYSTEM_DISK`: o `.env` local usa `local`, mas uploads publicos usam explicitamente disco `public` em varios pontos.

### O que nao faz sentido levar para o novo projeto

- Dependencia de editor KeyValue como principal forma de editar paginas importantes, se houver tempo para telas editoriais melhores.
- Campos duplicados ou historicos que nao sao mais consumidos pela view atual.
- Comentarios e labels com encoding quebrado.
- Carregamento global de bibliotecas que so sao usadas em paginas especificas, se a nova arquitetura permitir carregamento por rota.

### Gargalos tecnicos

- Conteudos JSON em `pagina_conteudos` nao possuem schema forte; isso facilita divergencia entre admin, seeds e views.
- Alguns modulos tem validacao de tamanho no CMS diferente do tamanho da tabela.
- Uploads podem ficar em pastas temporarias se o processamento customizado nao for acionado.
- Consultas dentro de views dificultam testes e cache.
- Filtro client-side de obras pode ficar pesado com grande volume de registros.

### Gargalos de UX

- KeyValue no CMS e arriscado para administradores nao tecnicos.
- Alguns textos obrigatorios para SEO dependem de preenchimento manual.
- Formulario apos sucesso substitui o formulario; para enviar outro contato, seria necessario recarregar ou adaptar o estado.
- A busca em Obras so age apos 2 caracteres, mas isso nao e comunicado visualmente.

### Gargalos visuais

- Placeholders de imagem sao funcionais, mas podem enfraquecer percepcao premium se muitos registros nao tiverem imagem.
- Cards com titulos truncados na Home preservam layout, mas podem cortar nomes longos de setores.
- O uso consistente de vermelho e grafite e forte; deve-se preservar contraste, mas cuidar para nao deixar todas as secoes muito semelhantes.

## 12. Checklist de Reconstrucao Funcional

Para reconstruir com fidelidade, manter obrigatoriamente:

- Todas as rotas publicas listadas.
- Admin em area autenticada com grupos equivalentes.
- Entidades: Banner, Setor, Obra, ObraImagem, Diferencial, Valor, EtapaProcesso, GestaoCard, Lead, Configuracao, PaginaConteudo, User.
- Campos, validacoes e relacionamentos documentados.
- Ordenacao por `ordem`.
- Status `ativo` para publicacao.
- Destaque de obras na Home.
- Slugs unicos para obras e setores.
- Galeria com alt e legenda.
- Conteudos institucionais editaveis por pagina.
- Configuracoes globais chave-valor.
- Formulario de contato com CSRF, honeypot, rate limit, validacao, lead persistido e e-mail.
- SEO por pagina e por obra.
- Header, footer, CTAs flutuantes, toasts e breadcrumb.
- Comportamentos mobile especificos.
- Paleta, tipografia, grids, espacamentos, cards, botoes e estilo de heroes.

