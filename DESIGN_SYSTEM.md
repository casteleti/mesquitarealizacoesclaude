# DESIGN_SYSTEM.md - Mesquita Realizações

Sistema visual e de experiência para o site institucional e o painel administrativo da Mesquita Realizações.

Este documento sincroniza o design system com o produto descrito em `PROJECT_BRIEF.md`, respeitando as restrições técnicas de `AGENTS.md` e a arquitetura atual em PHP puro, MySQL, Apache e deploy via FTP.

## 1. Princípios Do Sistema

### Produto real

A Mesquita Realizações é apresentada como empresa de construção industrial e infraestrutura para obras de grande porte. O site deve ajudar decisores técnicos e comerciais a validar:

- Capacidade de execução.
- Experiência em setores industriais.
- Portfólio de obras.
- Método de trabalho.
- Organização, previsibilidade e controle.
- Canais de contato para geração de leads.

### Princípio de adaptação técnica

O `PROJECT_BRIEF.md` descreve uma origem com Laravel, Blade, Filament, Tailwind, Alpine, Swiper, GLightbox, AOS e IMask. Neste projeto, a implementação deve preservar o produto, os fluxos, as entidades e a experiência essencial, mas adaptada para:

- PHP 8.2 puro.
- MVC leve próprio.
- CSS custom.
- JavaScript vanilla.
- Sem Composer obrigatório em produção.
- Sem build obrigatório no servidor.
- Deploy por FTP.

### Direção visual definitiva

A direção visual oficial é institucional, técnica e premium, com contraste entre grafite e vermelho institucional. A versão verde/dourado anterior deve ser considerada provisória e não deve guiar a implementação final do produto.

## 2. Direção Visual

### Conceito visual geral

Engenharia, controle e execução. O visual deve sugerir planejamento, precisão, obra bem conduzida e estrutura industrial, sem parecer pesado, antigo ou genérico.

### Sensação desejada

- Solidez.
- Confiança técnica.
- Previsibilidade.
- Organização.
- Capacidade de execução.
- Modernidade institucional.
- Seriedade comercial.

### Posicionamento visual

O site público deve parecer uma presença institucional premium para empresas industriais, gestores de engenharia, suprimentos e diretoria técnica. O painel administrativo deve parecer uma ferramenta editorial confiável, simples e objetiva.

### Referências compatíveis

- Linear: clareza operacional e hierarquia.
- Stripe: polimento, confiança e precisão.
- Vercel: limpeza e performance percebida.
- Apple: respiro e disciplina visual.
- Sites industriais premium: contraste escuro, fotografia forte, detalhes vermelhos, grids objetivos.

### Evitar visualmente

- Aparência de startup SaaS.
- Paleta verde/dourado como identidade principal.
- Layout com cara de WordPress.
- Sliders excessivos ou automáticos em todo lugar.
- Decoração abstrata sem relação com engenharia.
- Hero genérico de banco de imagem.
- Cards coloridos demais.
- Sombras fortes.
- Gradientes chamativos.
- Animações longas.

## 3. Paleta

### Cores principais

- Vermelho institucional: `#D71920`
  - Uso: CTAs primários, labels, links importantes, estado ativo de navegação, linhas decorativas.
- Vermelho escuro: `#A31218`
  - Uso: hover de botões, estados ativos fortes, alertas destrutivos quando apropriado.
- Grafite premium: `#18191C`
  - Uso: heroes escuros, footer, seções de processo, CTA final.
- Grafite técnico: `#1F2937`
  - Uso: títulos, textos de alta hierarquia, fundos escuros alternativos.
- Fundo leve: `#F7F8FA`
  - Uso: seções alternadas, fundos de cards administrativos, áreas de listagem.
- Branco: `#FFFFFF`
  - Uso: cards, painéis, formulários.

### Cores secundárias

- Grafite médio: `#2B2B2E`
- Texto secundário: `#6B7280`
- Borda: `#E5E7EB`
- Vermelho suave: `#FDECEC`
- WhatsApp: `#25D366`
- Overlay escuro: `rgba(24,25,28,.72)`

### Estados

- Sucesso:
  - Fundo: `#E8F6EE`
  - Texto: `#185D37`
- Erro:
  - Fundo: `#FDECEC`
  - Texto: `#A31218`
- Aviso:
  - Fundo: `#FFF4D8`
  - Texto: `#7A5418`
- Informação:
  - Fundo: `#EAF1F7`
  - Texto: `#24506C`
- Novo lead:
  - Fundo: `#FDECEC`
  - Texto: `#A31218`
- Em contato:
  - Fundo: `#EAF1F7`
  - Texto: `#24506C`
- Convertido:
  - Fundo: `#E8F6EE`
  - Texto: `#185D37`

### Regras de uso de cor

- Vermelho é acento, não fundo dominante.
- Grafite escuro deve carregar heroes, CTA final, processo e footer.
- Branco e fundo leve mantêm leitura e respiro.
- Nunca usar apenas cor para comunicar estado; usar texto junto.
- Seções escuras precisam de texto branco com contraste alto.
- Cards em fundo escuro devem ter borda translúcida e não parecer caixas pesadas.

## 4. Tipografia

### Font stack

Sem dependência obrigatória de fonte externa:

```css
--font-body: Inter, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
--font-heading: Manrope, Inter, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
```

Se fontes externas forem usadas localmente no futuro, devem ser opcionais e servidas como arquivos estáticos por FTP.

### Escala tipográfica pública

- Hero H1 fullscreen: `clamp(2.5rem, 6vw, 5.25rem)`
- Hero H1 interno: `clamp(2.15rem, 4.5vw, 4rem)`
- Section H2: `clamp(1.75rem, 3vw, 2.75rem)`
- Subheading: `1.1rem` a `1.25rem`
- Card title: `1.05rem` a `1.25rem`
- Body: `1rem`
- Small: `0.875rem`
- Label/eyebrow: `0.72rem` a `0.78rem`

### Escala tipográfica admin

- Título da tela: `1.1rem` a `1.25rem`
- Título de seção: `1rem` a `1.1rem`
- Label: `0.875rem` a `0.925rem`
- Texto de ajuda: `0.85rem`
- Tabela/lista: `0.925rem` a `1rem`

### Pesos

- H1/H2: `700` a `800`.
- Labels e botões: `700` a `800`.
- Texto comum: `400` a `500`.
- Texto auxiliar: `400`.

### Regras de títulos

- Títulos públicos usam Manrope/system heading.
- H1 de hero deve ser forte e curto.
- H2 deve iniciar seções claras, não repetir o H1.
- Cards nunca devem usar tamanho de hero.
- Evitar letter-spacing negativo.

### Textos longos

- Largura máxima: `720px` a `780px`.
- Line-height: `1.6` a `1.75`.
- Rich text institucional deve ter parágrafos curtos.
- Textos técnicos podem usar listas, cards laterais e blocos destacados para facilitar scan.

## 5. Grid E Espaçamento

### Containers

- Container público padrão: `min(1180px, 100% - 32px)`.
- Container amplo para hero/carrossel: `min(1280px, 100% - 32px)`.
- Conteúdo textual: `720px` a `780px`.
- Admin: conteúdo máximo de formulário `1040px`.

### Spacing scale

Escala baseada em 4px:

- `4px`, `8px`, `12px`, `16px`, `20px`, `24px`, `32px`, `40px`, `48px`, `64px`, `80px`, `96px`.

### Ritmo vertical

- Home e páginas institucionais: seções entre `72px` e `112px` no desktop.
- Mobile: seções entre `48px` e `64px`.
- Heroes fullscreen: `70vh` a `100vh`, conforme página.
- Hero de obras: mínimo `50vh`.
- Conteúdo admin: mais denso, mas agrupado.

### Breakpoints

- Mobile pequeno: até `480px`.
- Mobile grande: `520px`.
- Tablet: `768px`.
- Desktop: `1024px`.
- Wide: `1280px`.

### Respiro visual

- Páginas públicas devem priorizar respiração e autoridade.
- Painel deve priorizar velocidade de edição e clareza.
- Grids de 4 colunas só devem ser usados quando os cards forem curtos.
- Não comprimir textos longos em cards estreitos.

## 6. Componentes Globais Públicos

### Header

Comportamento esperado:

- Fixo no topo.
- Altura aproximada: `72px` mobile, `80px` desktop.
- Em páginas com hero fullscreen, pode iniciar transparente.
- Ao rolar, vira branco com sombra/borda discreta.
- Pode ocultar ao rolar para baixo após `200px` e reaparecer ao rolar para cima, se implementado com JS leve.
- Link ativo recebe vermelho e underline animado.

Desktop:

- Logo à esquerda.
- Menu horizontal.
- CTA "Fale Conosco" à direita.
- Sem submenu.

Mobile:

- Botão hamburguer.
- Painel lateral direito com overlay escuro.
- Links grandes, touch target mínimo `44px`.
- CTA destacado dentro do painel.

### Footer

Fundo `#18191C`.

Colunas:

1. Institucional: logo branco, texto curto e redes sociais condicionais.
2. Navegação: Home, Quem Somos, Setores, Obras, Como Atuamos, Contato.
3. Setores: setores ativos ordenados.
4. Contato: endereço, telefone, e-mail.

Regras:

- Redes só aparecem quando configuradas.
- Setores linkam para `/setores#{slug}`.
- Copyright usa ano atual.

### CTA mobile fixo

Exibido somente no mobile quando telefone ou WhatsApp estiverem configurados.

- Botão "Ligar": `tel:{telefone_normalizado}`.
- Botão "WhatsApp": `https://wa.me/{whatsapp}`.
- Fixo no rodapé.
- Não deve cobrir campos de formulário; adicionar padding inferior no body quando ativo.

### WhatsApp flutuante

- Exibir quando WhatsApp existir.
- Aparecer após rolagem de `300px`.
- Desktop: canto inferior direito.
- Mobile: acima do CTA fixo.
- Tooltip no hover desktop.
- Cor oficial WhatsApp.

### Voltar ao topo

- Botão circular.
- Aparece após `500px` de rolagem.
- Scroll suave.
- Deve respeitar `prefers-reduced-motion`.

### Toast global

Tipos:

- `success`
- `error`
- `info`

Regras:

- Canto superior/direito no desktop.
- Rodapé/topo seguro no mobile.
- Texto curto.
- Não bloquear interação.

### Breadcrumb

Usado obrigatoriamente em:

- Detalhe de obra.
- Como Atuamos, se a página tiver estrutura profunda.
- Obras listagem quando SEO exigir `BreadcrumbList`.

Regras:

- Visual discreto.
- Separadores simples.
- Gerar JSON-LD `BreadcrumbList` quando presente.

## 7. Componentes De Página Pública

### Hero principal da Home

Produto esperado:

- Carrossel de banners ativos quando houver mais de um.
- Fallback para conteúdo da página Home quando não houver banner.
- Imagem 16:9 ou fundo grafite geométrico.
- Overlay grafite.
- Label vermelho, headline, subheadline.
- Até dois botões.

Regras visuais:

- Altura entre `80vh` e `100vh` no desktop.
- Texto alinhado com container.
- Botões só aparecem se texto e link existirem.
- Paginação/setas apenas se houver mais de um banner.
- Autoplay deve respeitar `prefers-reduced-motion`.

### Hero institucional

Usado em:

- Quem Somos.
- Setores.
- Obras.
- Como Atuamos.

Regras:

- Fundo com imagem opcional e overlay grafite.
- Fallback com padrão geométrico discreto.
- Label vermelho.
- H1 branco em fundo escuro.
- Subheadline clara, sem exceder largura confortável.

Alturas:

- Quem Somos: mínimo `70vh`.
- Setores: mínimo `60vh`.
- Obras: mínimo `50vh`.
- Como Atuamos: mínimo `60vh`.

### Cards de setor

Home:

- Ícone SVG local opcional.
- Título curto.
- Descrição curta.
- Link "Saiba mais".
- Grid: 1 coluna mobile, 2 tablet, 4 desktop.

Página Setores:

- Artigos detalhados com `id={slug}`.
- Imagem quadrada ou placeholder.
- Label "SETOR".
- Título, rich text e botão.
- Alternar imagem/texto no desktop.

### Cards de obra

Listagem e carrossel:

- Imagem principal; fallback para primeira imagem de galeria; fallback placeholder.
- Badge do setor.
- Título.
- Cliente.
- Localização.
- Link de detalhe.

Regras:

- Imagem `4/3`.
- Cards de obras precisam parecer técnicos e objetivos.
- Hover: borda vermelha discreta, imagem com escala sutil e título com vermelho.

### Cards de diferenciais

- Linha vermelha decorativa no topo ou lateral.
- Título curto.
- Texto de até 100 caracteres no card.
- Grid adaptável a 1, 2, 3 ou 4 colunas.
- Usados em Home e Quem Somos.

### Cards de valores

Desktop:

- Lista lateral de valores.
- Painel de detalhe.

Mobile:

- Accordion.
- Primeiro item aberto.

Campos visuais:

- Ícone opcional.
- Título.
- Resumo.
- Texto.
- Até três tópicos.

### Processo / etapas

Home:

- Usar três primeiras etapas.
- Fundo grafite.
- Número grande.
- Título e descrição.

Como Atuamos:

- Desktop: lista de etapas à esquerda e painel detalhado à direita.
- Mobile: accordion.
- Cada etapa pode exibir tópicos e resultado.

### Cards de gestão

- Ícone SVG local.
- Título.
- Texto curto.
- Grid de 2, 3 ou 4 colunas conforme quantidade.

### CTA final

Usado em páginas institucionais e detalhe de obra.

Regras:

- Fundo grafite premium.
- Título forte.
- Texto curto.
- Botão primário vermelho.
- Botão secundário opcional com contorno branco.
- Botões só aparecem quando texto e link existem.
- Fallback para CTA global quando a página não definir CTA próprio.

### Galeria de obra

- Grid 2 colunas mobile, 3 tablet, 4 desktop.
- Imagens `4/3`.
- Hover mostra legenda.
- Abrir lightbox apenas se aprovado/implementado com solução leve.
- Sem lightbox pesado obrigatório.
- `alt` e legenda são obrigatórios no CMS.

### Filtros de obras

Componentes:

- Campo de busca.
- Select de setor.
- Contador de obras.
- Botão "Limpar filtros".

Regras:

- Container branco com borda sobre fundo leve.
- Busca só filtra a partir de 2 caracteres.
- Comunicar essa regra com texto auxiliar.
- Estado vazio client-side deve ter botão para limpar filtros.
- Paginação fica oculta quando filtro client-side estiver ativo.

### Paginação

- Server-side.
- Botões "Anterior" e "Próxima".
- Estado desabilitado claro.
- Mobile: botões largos e separados.

## 8. Páginas Públicas E Ordem Visual

### Home

Ordem obrigatória:

1. Hero principal.
2. Setores de atuação.
3. Obras em destaque.
4. Diferenciais / Por que confiar.
5. Como Atuamos resumido.
6. CTA final.

Ritmo:

- Alternar fundo escuro, branco e fundo leve.
- Não repetir grids com mesma densidade sem seção de respiro.
- Obras em destaque podem usar carrossel leve somente se necessário.

### Quem Somos

Ordem obrigatória:

1. Hero.
2. Experiência.
3. Frase institucional.
4. Diferenciais.
5. Valores.
6. CTA final.

Regras:

- Experiência deve destacar número/resultado institucional.
- Frase institucional deve ser escura, editorial e memorável.
- Valores devem ser interativos sem ficarem complexos.

### Setores

Ordem obrigatória:

1. Hero.
2. Navegação interna.
3. Lista detalhada de setores.
4. CTA final.

Regras:

- Desktop: sidebar sticky de setores.
- Mobile: chips horizontais com scroll.
- Artigos com âncoras estáveis.
- Botão aponta para `/obras?setor={slug}`.

### Obras

Ordem obrigatória:

1. Hero.
2. Filtros + grid.
3. Paginação.
4. CTA final.

Regras:

- Grid em 9 por página.
- Estado vazio servidor e estado vazio de filtro precisam ser diferentes.
- Filtro por setor deve sincronizar query string.

### Detalhe de obra

Ordem obrigatória:

1. Hero da obra.
2. Breadcrumb.
3. Detalhes + descrição.
4. Galeria.
5. Obras relacionadas.
6. CTA final.

Regras:

- Hero usa imagem principal, primeira imagem de galeria ou fundo grafite.
- Card lateral sticky no desktop.
- Status operacional: Concluída / Em andamento.
- Escopo técnico em bloco separado.

### Como Atuamos

Ordem obrigatória:

1. Hero.
2. Método.
3. Processo interativo.
4. Gestão da execução.
5. Previsibilidade.
6. CTA final.

Regras:

- Processo deve ser o componente mais forte da página.
- Mobile usa accordion.
- Desktop usa lista + painel.

### Contato

Ordem obrigatória:

1. Introdução.
2. Formulário + canais.
3. Mapa, se configurado.

Regras:

- Formulário deve parecer comercial e seguro.
- Botão tem estado loading.
- Sucesso pode substituir o formulário por confirmação.
- Toast deve comunicar retorno.
- Mapa só aparece se configurado.

## 9. Painel Administrativo

### Navegação

Grupos esperados:

- Páginas do Site.
- Conteúdo.
- Comercial.
- Sistema.

Adaptação para PHP atual:

- Páginas do Site: Home, Quem Somos, Setores, Obras, Como Atuamos, Contato.
- Conteúdo: Banners, Setores, Obras.
- Comercial: Contatos/Leads.
- Sistema: SEO, Configurações, Usuários.

### Dashboard

Widgets:

- Obras cadastradas/ativas.
- Setores ativos.
- Leads novos ou mensagens recentes.
- Total de leads/mensagens.

Regras:

- Cards pequenos.
- Números grandes.
- Atalhos para ações principais.
- Sem gráficos pesados.

### Módulo Banners

Campos visuais:

- Label.
- Headline.
- Subheadline.
- Imagem.
- Botão primário texto/link.
- Botão secundário texto/link.
- Publicado.
- Posição.

Agrupamento:

1. Conteúdo do banner.
2. Imagem.
3. Botões.
4. Publicação.
5. Avançado.

Listagem:

- Imagem.
- Headline.
- Label como descrição.
- Botão primário.
- Posição.
- Badge Publicado/Oculto.

### Módulo Setores

Campos visuais:

- Nome.
- URL amigável.
- Ícone.
- Título curto para Home.
- Descrição curta.
- Imagem.
- Título da página.
- Descrição.
- Botão.
- Publicado.
- Posição.

Agrupamento:

1. Identificação.
2. Card da Home.
3. Página Setores.
4. Imagem.
5. Publicação.
6. Avançado.

Listagem:

- Imagem.
- Ícone.
- Nome.
- Descrição curta.
- Contagem de obras.
- Posição.
- Publicado/Oculto.

### Módulo Obras

Campos visuais:

- Título.
- URL amigável.
- Cliente.
- Setor.
- Localização.
- Subtítulo.
- Período.
- Status operacional.
- Descrição.
- Escopo.
- Imagem principal.
- Galeria.
- Destaque.
- Publicado.
- Posição.
- SEO.

Agrupamento:

1. Identificação.
2. Dados técnicos.
3. Conteúdo.
4. Imagem principal.
5. Galeria.
6. Publicação e destaque.
7. SEO.
8. Avançado.

Listagem:

- Foto.
- Título.
- Cliente.
- Setor.
- Status operacional.
- Destaque.
- Publicado/Oculto.
- Posição.

### Módulo Diferenciais

Campos:

- Título.
- Texto.
- Ícone.
- Exibir em.
- Publicado.
- Posição.

Regras visuais:

- "Exibir em" deve ser select simples: Home, Quem Somos, Ambas.
- Texto auxiliar deve explicar onde o card aparece.

### Módulo Valores

Campos:

- Título.
- Resumo.
- Texto.
- Ícone.
- Tópico 1.
- Tópico 2.
- Tópico 3.
- Publicado.
- Posição.

Regras:

- Tópicos devem ficar em seção "Pontos de apoio".

### Módulo Etapas do Processo

Campos:

- Número.
- Título.
- Descrição.
- Ícone.
- Bloco de tópicos.
- Resultado.
- Publicado.
- Posição.

Regras:

- Número deve ter preview visual.
- Resultado deve ficar agrupado em bloco próprio.

### Módulo Cards de Gestão

Campos:

- Ícone.
- Título.
- Texto.
- Publicado.
- Posição.

### Módulo Leads / Contato

Listagem:

- Nome.
- Empresa.
- E-mail.
- Tipo de projeto.
- Data.
- Status.

Detalhe:

- Dados do contato.
- Mensagem.
- Controle comercial.

Status:

- Novo.
- Visualizado.
- Em contato.
- Convertido.
- Descartado.

Regras:

- Dados enviados pelo visitante ficam somente leitura.
- Admin altera apenas status e observações, se existirem.
- Lead novo deve ter badge evidente.

### Configurações globais

Agrupamento:

1. Contato.
2. Redes sociais.
3. Mapa.
4. CTA global.
5. SEO/Analytics.
6. SMTP.

Regras:

- SMTP deve ficar em avançado.
- Analytics deve ficar em avançado.
- Senhas nunca aparecem preenchidas.
- WhatsApp deve ter instrução de formato.

### Páginas institucionais

Páginas:

- Home.
- Quem Somos.
- Setores.
- Obras.
- Como Atuamos.
- Contato.

Agrupamento padrão:

1. Hero.
2. Seções da página.
3. CTA final.
4. SEO.

Evitar editor KeyValue para cliente final quando possível. Se usado, deve ser temporário ou claramente agrupado.

## 10. Admin UX

### Linguagem amigável

Usar:

- URL amigável, não slug.
- Posição, não ordem.
- Publicado/Oculto, não ativo/inativo.
- Título para Google, não meta title.
- Descrição para Google, não meta description.
- Redes sociais, não Open Graph no label principal.
- Lead, contato ou oportunidade, não registro.

### Campos avançados

Recolher por padrão:

- URL amigável.
- Posição.
- Canonical.
- Robots.
- Schema.
- Open Graph.
- SMTP.
- Analytics.
- Configurações raras.

Não recolher:

- Título.
- Conteúdo.
- Imagem principal.
- Status de publicação.
- Setor de uma obra.
- Dados essenciais de contato.

### Hierarquia de ações

- Uma ação primária por tela.
- Salvar sempre destacado.
- Excluir visualmente separado.
- Voltar secundário.
- Visualizar no site quando existir URL pública.

### Estados vazios admin

Cada listagem deve ter empty state específico:

- Banners: "Nenhum banner cadastrado ainda."
- Setores: "Nenhum setor cadastrado ainda."
- Obras: "Nenhuma obra cadastrada ainda."
- Leads: "Nenhum contato recebido ainda."
- Diferenciais: "Nenhum diferencial cadastrado ainda."
- Valores: "Nenhum valor cadastrado ainda."

### Estados de erro

- Erros de validação próximos ao campo.
- Erros gerais em alert no topo.
- Mensagem sempre acionável: "Revise os dados e tente novamente."
- Nunca exibir stack trace.

### Mobile admin

- Menu lateral como overlay.
- Listagens viram cards.
- Botões principais em largura total.
- Formulários em uma coluna.
- Ações destrutivas no fim do card.
- Touch target mínimo `44px`.

## 11. Formulários

### Estrutura geral

Todo formulário segue:

1. Conteúdo principal.
2. Dados complementares.
3. Imagens.
4. Publicação.
5. Avançado.
6. SEO.

### Inputs

- Labels acima.
- Texto auxiliar abaixo quando necessário.
- Placeholder não substitui label.
- Campos obrigatórios devem ser claros.

### Upload preview

- Preview sempre que houver imagem.
- Informar proporção ideal:
  - Banner: 16:9, ideal 1920x1080.
  - Setor: 1:1, ideal 550x550.
  - Obra card: 4:3.
  - SEO image: 1200x630.
- Alt text próximo à imagem.

### Formulário de contato público

Campos:

- Nome.
- Empresa.
- E-mail.
- Telefone.
- Tipo de projeto.
- Local.
- Mensagem.

Estados:

- Idle.
- Loading.
- Success.
- Error.
- Honeypot invisível.

Regras:

- Mensagem com contador até 2000 caracteres quando implementado.
- Botão desabilitado durante envio.
- Sucesso deve ser claro e comercialmente confiável.

## 12. Tabelas E Listagens

### Desktop

- Headers pequenos, uppercase, cor secundária.
- Linhas com altura confortável.
- Status como badge.
- Ações à direita.
- Imagens pequenas com proporção fixa.

### Mobile

- Tabela vira card.
- Cada campo usa label contextual.
- Ações ficam no fim.
- Não usar scroll horizontal como solução principal.

### Filtros

- Filtros ficam acima da listagem.
- Usar uma linha no desktop.
- Empilhar no mobile.
- Botão "Limpar filtros" só aparece quando houver filtro ativo.

## 13. Estados Visuais

### Empty states públicos

- Obras sem cadastro: mensagem institucional e CTA para contato.
- Setores sem cadastro: mensagem simples, sem quebrar layout.
- Filtro sem resultado: explicar que nenhum item combina com a busca e oferecer limpar filtros.

### Loading

- Preferir estados de botão e layout estável.
- Skeletons só quando houver interação client-side relevante.
- Em server-rendered, não criar loading artificial.

### Erro

- Público: mensagem calma, sem detalhes técnicos.
- Admin: mensagem objetiva e acionável.

## 14. Performance Visual

### CLS prevention

- Definir `width` e `height` em imagens.
- Usar `aspect-ratio` em wrappers.
- Reservar espaço de banners, cards e galerias.
- Evitar inserir barras/flashes acima do conteúdo sem espaço previsto.

### Imagens

- Hero: priorizar imagem principal.
- Abaixo da dobra: `loading="lazy"` e `decoding="async"`.
- Uploads devem ser reprocessados e preferencialmente WebP.
- Placeholders devem ser grafite geométrico ou bloco neutro, nunca ícone genérico grande.

### Grids

- Grid deve adaptar número de colunas à quantidade e ao conteúdo.
- Não forçar 4 colunas com textos longos.
- Cards de obras e setores precisam manter altura visual estável.

### Bibliotecas

Neste projeto PHP/FTP:

- JS vanilla por padrão.
- Alpine apenas se uma interação local justificar.
- Swiper apenas para hero/carrossel de obras se aprovado.
- Lightbox somente se galeria de obras exigir e a biblioteca for leve.
- AOS não é obrigatório; preferir transições CSS simples.
- IMask só se máscara de telefone for implementada e realmente necessária.

### Animações

- Duração: `150ms` a `240ms`.
- Respeitar `prefers-reduced-motion`.
- Não usar animações contínuas.
- Não usar parallax.
- Hover sutil em cards, links e botões.

## 15. SEO Visual E Admin SEO

### Campos SEO no admin

Recolhidos por padrão:

- Título para Google.
- Descrição para Google.
- Link canônico.
- Título para redes sociais.
- Descrição para redes sociais.
- Imagem para redes sociais.
- Tipo de schema.
- Indexação.

### Regras

- SEO deve ser compreensível por cliente não técnico.
- Exibir instruções curtas.
- Não obrigar preenchimento quando houver fallback.
- Imagem OG deve comunicar proporção ideal 1200x630.

### Breadcrumb e dados estruturados

- Breadcrumb visual discreto quando usado.
- JSON-LD gerado pelo template/controlador, não editado manualmente pelo cliente.

## 16. Acabamento Premium

### Como parecer premium

- Fotografia real e bem cortada.
- Contraste forte em heroes.
- Vermelho usado com precisão.
- Texto curto e assertivo.
- Grids com respiro.
- Cards objetivos.
- Painel com linguagem humana.

### Como evitar aparência de template

- Evitar sequência de seções idênticas.
- Usar ordem de páginas do brief.
- Variar ritmo entre texto, cards, processo, CTA e galeria.
- Evitar imagens genéricas.

### Como evitar aparência de WordPress

- Não usar sliders em excesso.
- Não usar blocos decorativos genéricos.
- Não usar ícones grandes sem função.
- Não empilhar cards com sombras pesadas.

### Como evitar aparência SaaS genérica

- Preservar atmosfera industrial.
- Usar grafite e vermelho, não paletas de app.
- Evitar dashboards decorativos no site público.
- Priorizar obras, setores, método e contato.

## 17. Regras De Evolução

- Todo componente novo deve mapear uma entidade ou fluxo do `PROJECT_BRIEF.md`.
- Toda página deve seguir a ordem de seções documentada no brief.
- Toda tela admin deve respeitar agrupamento por conteúdo, imagem, publicação, avançado e SEO.
- Todo campo técnico deve ter label amigável.
- Toda listagem deve ter empty state.
- Todo status deve usar badge textual.
- Todo upload deve ter preview e orientação de proporção.
- Toda interação JS deve ser justificável e leve.
- Nenhuma evolução visual pode exigir terminal ou build no servidor.
- O design system deve ser revisado quando novas entidades forem implementadas no CMS.

## 18. Lacunas Entre Brief E Implementação Atual

Estas lacunas devem orientar fases futuras, mas não devem ser resolvidas dentro deste documento:

- Admin atual usa `/admin`; brief descreve `/painel`.
- Projeto atual tem entidades básicas: banners, setores, obras, páginas, SEO, configurações, usuários e contato.
- Brief inclui entidades ainda não implementadas: diferenciais, valores, etapas do processo, cards de gestão, leads completos e galeria administrativa robusta.
- Brief descreve vermelho/grafite; CSS atual ainda pode conter heranças visuais anteriores e deve ser alinhado em fase de implementação.
- Brief descreve filtros de obras, CTA mobile, WhatsApp flutuante, toast, breadcrumb e comportamentos de scroll que precisam ser avaliados conforme restrições de leveza.
- Brief descreve uploads `/storage`; projeto atual usa `/uploads`, conforme `AGENTS.md` e hospedagem FTP.
- Brief descreve Filament/Tailwind; projeto atual deve manter PHP puro e CSS custom.

O objetivo do design system é preservar o produto real do brief sem importar dependências incompatíveis com a hospedagem e com a regra de deploy por FTP.
