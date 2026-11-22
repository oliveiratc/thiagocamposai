# Design Técnico: Redesign Enterprise Clean e Nova Identidade TC AI CORP

## 1. Visão Geral da Arquitetura
O portal mantém sua arquitetura **estática de zero-build** (**HTML5 + Tailwind CSS CDN + JavaScript vanilla**), garantindo carregamento imediato, SEO completo e compatibilidade direta com a hospedagem compartilhada na Hostinger.

## 2. Pipeline de Geração dos Ativos de Marca
A partir da imagem fonte enviada pelo usuário (`media_1795309786064_89ce5dc5.jpg`, formato JPEG com fundo branco), será executado um script Python local (ambiente virtual isolado com `Pillow` e `numpy`, sem `pip install` global) para gerar os ativos finais na raiz do projeto:

1. **`logo-tcai-corp.png` (uso em fundos claros e Schema.org):**
   - Remoção limpa do fundo branco com preservação de anti-aliasing (estimativa de canal alfa baseada na luminância/distância do branco nas bordas para evitar halos serrilhados).
   - Recorte automático da margem excedente com respiro proporcional mínimo (padding de segurança).
   - Redimensionamento nítido para alta densidade Retina (largura ~600px, PNG otimizado).
2. **`logo-tcai-corp-dark.png` (uso no rodapé Deep Navy `#061529`):**
   - Mantém o monograma e tipografia **TC AI CORP** com alto contraste em fundo escuro: o azul marinho profundo da letra **AI** e do arco do **C** é elevado para azul aço luminoso (`#60a5fa` / `#93c5fd`), e o grafite metálico de **T** e **CORP** é elevado para prata claro (`#e2e8f0` / `#f8fafc`), garantindo contraste WCAG AA sobre `#061529`.
3. **Favicons (`favicon-16x16.png`, `favicon-32x32.png`, `favicon.ico`, `apple-touch-icon.png`):**
   - Extração centralizada do **monograma TC** (parte esquerda do logotipo) em canvas quadrado (1:1) com fundo branco arredondado/limpo no `apple-touch-icon.png` (180x180) e transparente/nítido nos favicons 16x16, 32x32 e `.ico` multi-resolução.
4. **`og-tcai-corp.jpg` (1200x630):**
   - Cartão OpenGraph/Twitter corporativo em fundo branco/precision grid com o logotipo **TC AI CORP** centralizado e linha institucional sutil em Deep Navy.

## 3. Design System — Enterprise Clean / Precision Grid
### Paleta de Cores (Tailwind `extend.colors`)
- **Navy / Brand (`navy` / `primary`):**
  - `950`: `#041122` (rodapé e detalhes profundos)
  - `900`: `#072f5f` (cor primária extraída do logo — CTAs principais, títulos de destaque)
  - `800`: `#0b4a8b` (hover de botões primários, links ativos)
  - `700`: `#145da0`
  - `600`: `#1d6fc2` (indicadores interativos/badges)
  - `50` / `100`: `#f0f6fc` / `#dcebfa` (superfícies suaves e pills)
- **Steel / Slate (`slate`):** `#475569` / `#64748b` (textos secundários e linhas metálicas), `#e2e8f0` (bordas estruturais de 1px do Precision Grid).
- **Superfícies:** `#ffffff` (base principal) e `#f8fafc` (faixas alternadas com micro-grid CSS sutil `background-size: 32px 32px`).

### Tipografia
- **Display / Títulos:** `Outfit` (pesos 600–800, tracking apertado `-0.02em`).
- **Corpo / UI:** `Plus Jakarta Sans` (pesos 400–700).

## 4. Arquitetura de Seções (`index.html`)
1. **Nav Sticky (`h-20`):**
   - Esquerda: `logo-tcai-corp.png` (link para topo).
   - Centro: links enxutos (`Produtos`, `Serviços`, `Sobre`, `Contato`).
   - Direita: seletor bilíngue `PT | EN` + botão CTA primário **"Falar com a TCAI Corp"** (`#contato`).
   - Mobile: seletor `PT | EN` + menu hambúrguer acessível com o CTA incluído.
2. **Hero Assimétrico (`<header id="conteudo-principal">`):**
   - Grid 12 colunas (`lg:col-span-7` texto + `lg:col-span-5` painel arquitetural).
   - Esquerda: badge institucional **TCAI Corp**, `<h1>` único de alto impacto, subtítulo enxuto, **2 CTAs** (*"Falar com a TCAI Corp"* em Deep Navy + *"Explorar Produtos"* em outline) e 3 indicadores rápidos de confiança.
   - Direita: **Painel Visual do Ecossistema TCAI** (componente limpo em Precision Grid mostrando as 3 camadas: Infraestrutura HTTP 402/MCP do Grid402, Plataformas SaaS B2B e Serviços Enterprise/CoE, sem tilt exagerado nem laser scanner).
3. **Faixa de Métricas (`#metricas`):**
   - Grid horizontal compacto de 4 colunas (`+15 Anos`, `+100 Soluções`, `R$10M+ Economia`, `100% Em Produção`) com animação de contagem via `IntersectionObserver`.
4. **Vitrine de Produtos — Bento Grid (`#projetos`):**
   - Grid de 12 colunas (`grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-6`):
     - **Card Destaque — Grid402 (`lg:col-span-12` ou `lg:col-span-8` + card lateral de resumo técnico):** destaque visual em Precision Navy com `logo-grid402-horizontal.png`, resumo claro do protocolo HTTP 402 / USDC Base / MCP, métricas (`< 1 ms`, `Zero-DB`) e 3 links diretos (`https://grid402.online`, `https://grid402.online/agents`, `https://grid402.online/openapi.json`).
     - **Demais 5 Produtos (`Peça Match AI`, `RankPro SEO`, `VaiLotar`, `AuditIA`, `Firmeza`):** organizados em Bento Grid limpo (`lg:col-span-4` na 1ª linha com 3 cards + `lg:col-span-6` na 2ª linha com 2 cards — ou 3 + 2 equilibrados sem espaços vazios!). Cada card exibe: thumbnail limpa com badge do logo do produto, tag de categoria, título curto, resumo de 2 linhas, métrica principal em destaque e ações: botão **"Ver detalhes"** (abre modal) + link direto de acesso (ou "Solicitar Demo" no caso da AuditIA).
5. **Modal Acessível de Detalhes do Produto (`#product-modal`):**
   - Um único `<div id="product-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">` populado dinamicamente a partir de um catálogo estruturado `PRODUCTS_DATA` com textos completos em `pt` e `en`.
   - Exibe: imagem/banner, logo e badges, título, descrição completa, grade de métricas, lista de diferenciais, **box de aviso clínico** (renderizado especificamente para o **Firmeza**), e botões de ação oficial.
   - Acessibilidade: armazena o elemento disparador para restaurar o foco ao fechar, bloqueia scroll do `body`, fecha via botão `X`, clique no backdrop ou tecla `Escape`, e atualiza automaticamente se o idioma mudar.
6. **Sobre & Serviços Enterprise (`#sobre` e `#expertises`):**
   - Bloco institucional **Sobre a TCAI Corp** limpo (corrigindo as 4 tags de fechamento duplicadas existentes hoje) com princípio corporativo.
   - Bento Grid de **Pilares & Serviços Enterprise**: os 3 pilares estratégicos (IA & Agentes Autônomos, Produtos B2B Escaláveis, Automação Inteligente) + 2 cards de ofertas corporativas dedicadas (**Centros de Excelência em RPA** e **Governança BPM & ECM TOTVS Fluig**) reescritos 100% em voz corporativa ("Nossa equipe", "A TCAI Corp"), removendo qualquer menção a cargos pessoais (CoE Leader, Tech Lead, Analista Funcional) ou nomes de empregadores anteriores como currículo.
7. **Contato Simplificado (`#contato`) e Rodapé (`<footer>`):**
   - Card de conversão limpo e direto: título objetivo, CTA principal **WhatsApp Corporativo** (`+55 (11) 95832-5848`), **E-mail Institucional** (`contato@tcaicorp.online`) com cópia em 1 clique + `mailto:`, e **LinkedIn Corporativo**.
   - Rodapé em Deep Navy (`#041122`) com `logo-tcai-corp-dark.png`, 4 colunas (Identidade, Produtos, Institucional & Agêntico, Canais), direitos autorais e avisos legais/LGPD.

## 5. Consistência em Páginas Legais e Preservação Técnica
- **`privacidade.html` e `termos.html`:** recebem o novo logo (`logo-tcai-corp.png` no header, `logo-tcai-corp-dark.png` no footer), novos favicons e paleta Deep Navy consistente.
- **Recursos preservados em `index.html`:**
  - Script de redirecionamento de `thiagocampos.ai` -> `https://www.tcaicorp.online`
  - Schema.org `@graph` (`Organization`, `WebSite`, `AboutPage`, `ContactPage`, `Service`, `Product`, `FAQPage`) atualizado para `logo-tcai-corp.png` e `og-tcai-corp.jpg`
  - Links agênticos (`llms.txt`, `llms-full.txt`, `.well-known/mcp/server-card.json`) e atributos `data-agent-*`
  - Registro WebMCP (`get_tcai_corp_info`, `contact_tcai_corp`)
  - Banner LGPD e botão voltar ao topo

## 6. Estratégia de Validação e Deploy
- **Validação automatizada (script Node/Python):** verificar integridade do HTML (tags balanceadas, único `<h1>`, ausência de referências a logos antigos, ausência de cargos pessoais em RPA/TOTVS, completude das chaves `data-i18n` em PT e EN, existência de todos os arquivos `src`/`href` locais).
- **Inspeção visual / funcional:** testar localmente o site (desktop e mobile, troca PT/EN, abertura e fechamento do modal de cada produto, cópia de e-mail, zero erros de console).
- **Deploy Hostinger:** utilizar ferramentas MCP da Hostinger (`hostinger-hosting`) para publicar os arquivos atualizados em `tcaicorp.online` e validar status HTTP 200 na URL de produção e nos novos arquivos de imagem.
