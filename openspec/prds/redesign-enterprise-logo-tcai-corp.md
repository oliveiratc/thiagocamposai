# PRD: Redesign Enterprise Clean e Nova Identidade Visual TC AI CORP

**Status:** Aprovado
**Data:** 2026-11-21
**Autor:** Thiago Campos + Antigravity

## 1. Contexto e problema
Após o rebranding inicial para **TCAI Corp** (`www.tcaicorp.online`), o portal ainda utiliza o logotipo antigo (`logo-tc-vibrante.png` / `logo-tc-darkbg.png`) e herda a estrutura visual do antigo portfólio pessoal:
- **Rolagem vertical excessiva:** 8 blocos extensos empilhados verticalmente com efeitos repetitivos (tilt 3D e scanner em todos os cards), dificultando a leitura executiva rápida.
- **Ruído de posicionamento pessoal:** os blocos de RPA CoE e TOTVS Fluig ainda exibem histórico com cargos individuais (Boa Vista, Wipro, Indra), enfraquecendo a percepção enterprise da empresa.
- **Fricção na conversão comercial:** nem o cabeçalho fixo nem o Hero possuem botões claros de chamada para ação (CTA).
- **Inconsistência estrutural:** há fechamentos duplicados de tags HTML após a seção `#sobre` e falta alinhamento de paleta/ativos com o novo logotipo oficial **TC AI CORP** (monograma TC entrelaçado + "AI CORP" em azul marinho profundo e grafite metálico).

É necessário substituir integralmente os ativos de marca pelo novo logotipo e redesenhar o layout para uma estética **Enterprise Clean / Precision Grid** moderna, compacta e orientada à conversão B2B.

## 2. Objetivos
- **Atualizar 100% da identidade de marca:** gerar e aplicar versões otimizadas do novo logotipo **TC AI CORP** (fundo transparente para superfícies claras, versão adaptada para superfícies escuras, favicons multiplataforma e imagem OpenGraph/Twitter) em todas as páginas (`index.html`, `privacidade.html`, `termos.html`) e no JSON-LD Schema.org.
- **Modernizar o layout para Enterprise Clean / Precision Grid:** adotar paleta derivada do novo logotipo (**Deep Navy `#072f5f`/`#0b4a8b`** e **Grafite/Aço `#475569`** sobre superfícies claras `#ffffff`/`#f8fafc`), com grid limpo e hierarquia tipográfica executiva.
- **Reduzir a rolagem e organizar o catálogo em Bento Grid:** destacar o **Grid402** em card largo (2 colunas) e organizar os outros 5 produtos (**Peça Match AI**, **RankPro SEO**, **VaiLotar**, **AuditIA**, **Firmeza**) em cards compactos com modal acessível *"Ver detalhes"* preservando todas as métricas, diferenciais e avisos (incluindo o aviso clínico do Firmeza).
- **Consolidar voz 100% institucional em Serviços Enterprise:** separar produtos digitais de serviços de consultoria corporativa (**Centros de Excelência RPA** e **Governança BPM / TOTVS Fluig**), removendo referências a cargos individuais.
- **Aumentar clareza de conversão:** incluir CTA primário **"Falar com a TCAI Corp"** no cabeçalho fixo, 2 CTAs no Hero assimétrico e bloco de contato comercial simplificado.
- **Publicar em produção:** realizar deploy dos arquivos atualizados em `www.tcaicorp.online` na Hostinger com verificação de disponibilidade.

## 3. Não objetivos (fora do escopo)
- Não haverá migração de stack para frameworks com build (React/Next.js/Vite) nem introdução de banco de dados/backend; o portal permanecerá estático em HTML5 + Tailwind CSS + JavaScript vanilla.
- Não haverá criação de formulário backend com envio SMTP (o contato continua via canais diretos: WhatsApp corporativo, e-mail com cópia em 1 clique / `mailto:` e LinkedIn).
- Não haverá alteração de domínio, canais oficiais (`contato@tcaicorp.online`, `+55 (11) 95832-5848`) nem do redirecionamento legado de `thiagocampos.ai`.
- Não haverá remoção de nenhum dos 6 produtos digitais do portfólio atual.

## 4. Público-alvo e personas
- **Decisores Corporativos B2B (CTOs, Diretores de Operações/TI, Fundadores):** avaliam rapidamente a credibilidade enterprise da TCAI Corp, seus pilares e canais comerciais para contratar projetos de IA, automação ou SaaS.
- **Desenvolvedores e Integradores de Agentes de IA:** acessam o portal buscando detalhes técnicos e entrada rápida para o ecossistema **Grid402** (HTTP 402, MCP, OpenAPI).
- **Agentes Autônomos de IA e Rastreadores:** consomem dados estruturados Schema.org, atributos `data-agent-*`, WebMCP e arquivos `llms.txt` / `llms-full.txt`.

## 5. Histórias de usuário
- **Como decisor corporativo**, quero visualizar a proposta de valor, o novo posicionamento da TCAI Corp e um botão de contato logo acima da dobra, para iniciar uma conversa comercial sem precisar rolar a página inteira.
- **Como visitante B2B**, quero percorrer rapidamente os produtos em um Bento Grid limpo e abrir um modal de detalhes apenas nos produtos do meu interesse, para comparar métricas e acessar cada plataforma sem fadiga de rolagem.
- **Como integrador de IA**, quero ver o Grid402 em destaque principal com links diretos para o hub, Central de Agentes e especificação OpenAPI, para avaliar a integração técnica imediatamente.
- **Como visitante internacional**, quero alternar o site inteiro entre Português (PT) e Inglês (EN), incluindo os modais de detalhes dos produtos, sem perder contexto.

## 6. Requisitos funcionais
| ID | Requisito | Prioridade |
|---|---|---|
| RF01 | Processar o logotipo oficial **TC AI CORP** anexado gerando: versão horizontal recortada com fundo transparente (`logo-tcai-corp.png`), versão adaptada para fundo escuro (`logo-tcai-corp-dark.png`), favicons (`favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png`) e imagem OpenGraph (`og-tcai-corp.jpg`). | Must |
| RF02 | Substituir todas as referências ao logotipo antigo em `index.html`, `privacidade.html`, `termos.html` e metadados (`og:image`, `twitter:image`, Schema.org `logo`/`image`) pelos novos ativos, sem nenhuma referência quebrada. | Must |
| RF03 | Atualizar a paleta de cores e o design system para **Enterprise Clean / Precision Grid** derivado do novo logo (Deep Navy `#072f5f` / `#0b4a8b`, Grafite Metálico `#475569`, superfícies `#ffffff` e `#f8fafc`), aplicando identidade consistente em `index.html`, `privacidade.html` e `termos.html`. | Must |
| RF04 | Implementar cabeçalho fixo com novo logo, menu corporativo enxuto, seletor de idioma **PT \| EN** e botão CTA **"Falar com a TCAI Corp"**, além de menu mobile acessível. | Must |
| RF05 | Implementar **Hero assimétrico** contendo proposta de valor institucional e 2 CTAs (*"Falar com a TCAI Corp"* e *"Explorar Produtos"*) à esquerda, e painel visual arquitetural do ecossistema TCAI (Grid402, Plataformas B2B e Agentes IA) à direita, seguido de faixa compacta de métricas. | Must |
| RF06 | Implementar **Vitrine de Produtos em Bento Grid** com **Grid402** em card destaque largo (2 colunas) contendo métricas e links (`grid402.online`, `/agents`, `/openapi.json`), e os 5 produtos (**Peça Match AI**, **RankPro SEO**, **VaiLotar**, **AuditIA**, **Firmeza**) em cards compactos com métrica principal, resumo, link externo (ou solicitação de demo para AuditIA) e botão **"Ver detalhes"**. | Must |
| RF07 | Implementar **Modal acessível de detalhes do produto** acionado pelos cards do Bento Grid, exibindo imagem/preview, descrição completa, métricas, diferenciais, aviso clínico no caso do Firmeza e links oficiais, com suporte a fechamento por botão, clique no backdrop, tecla `ESC` e retorno de foco. | Must |
| RF08 | Separar **Sobre a TCAI Corp & Serviços Enterprise**, incorporando os 3 pilares e as ofertas de **Centros de Excelência RPA** e **Governança BPM / TOTVS Fluig** com redação 100% institucional (sem cargos pessoais ou formato de currículo) e saneando o HTML duplicado existente após `#sobre`. | Must |
| RF09 | Implementar seção de **Contato Simplificado** (WhatsApp `+55 (11) 95832-5848`, e-mail `contato@tcaicorp.online` com cópia em 1 clique + `mailto:` e LinkedIn corporativo) e **Rodapé corporativo em Deep Navy** com o novo logo adaptado, links institucionais, legais e agênticos (`llms.txt`, MCP Server Card). | Must |
| RF10 | Preservar 100% do suporte bilíngue (**PT \| EN**) em todos os novos textos, botões e conteúdo dos modais, além de manter **Schema.org Organization**, **WebMCP**, atributos `data-agent-*`, **banner LGPD** e script de redirecionamento de `thiagocampos.ai`. | Must |
| RF11 | Realizar deploy dos arquivos atualizados na hospedagem **Hostinger** (`www.tcaicorp.online`) e validar o carregamento em produção (HTTP 200 e ativos de imagem acessíveis). | Must |

## 7. Requisitos não funcionais
- **Performance:** manter carregamento rápido em HTML estático, imagens com dimensões explícitas e `loading="lazy"` abaixo da dobra, eliminando animações CSS/JS custosas (tilt 3D em massa e laser scanner em todos os cards).
- **Acessibilidade (WCAG AA):** contraste mínimo 4.5:1 em textos e botões (especialmente Deep Navy sobre branco e branco/cinza claro sobre Deep Navy no rodapé), único `<h1>`, hierarquia semântica correta (`h1` -> `h2` -> `h3`), foco visível por teclado e modal com `role="dialog"`, `aria-modal="true"` e fechamento via `ESC`.
- **Responsividade:** layout fluido sem overflow horizontal em mobile (375px), tablet (768px) e desktop (1280px+).
- **SEO & Descoberta Agêntica:** manter canonical, OpenGraph, Twitter Cards, Schema.org `@graph`, `robots.txt`, `sitemap.xml`, `llms.txt`, `llms-full.txt` e WebMCP sem regressões.
- **Segurança & Privacidade:** zero segredos no repositório; links externos com `rel="noopener noreferrer"`; manutenção do banner LGPD sem cookies invasivos de terceiros.

## 8. Fluxos e UX
- **Fluxo principal (Conversão Executiva):** Visitante acessa `www.tcaicorp.online` -> visualiza novo logo, Hero assimétrico e CTAs acima da dobra -> clica em *"Falar com a TCAI Corp"* (leva à seção de contato ou WhatsApp) ou rola para explorar métricas, Bento Grid de produtos e serviços enterprise -> aciona contato via WhatsApp ou copia `contato@tcaicorp.online` com feedback visual.
- **Fluxo de exploração de produto (Bento Grid -> Modal):** Visitante lê card resumido no Bento Grid -> clica em *"Ver detalhes"* -> modal abre com ficha técnica completa no idioma ativo (PT ou EN) -> clica no CTA do produto ou fecha via `ESC`/botão/backdrop.
- **Fluxo bilíngue:** Visitante clica em **EN** ou **PT** no cabeçalho -> todos os rótulos, seções, serviços, rodapé e dados internos do modal atualizam imediatamente e a preferência persiste em `localStorage`.
- **Estados de erro / fallback:** Caso `navigator.clipboard` falhe ao copiar e-mail, o botão realiza fallback automático para `mailto:contato@tcaicorp.online`. Caso `localStorage` esteja indisponível, o site inicializa em `pt` sem quebrar scripts.

## 9. Métricas de sucesso
- **0** referências remanescentes aos arquivos antigos de logo (`logo-tc-vibrante.png`, `logo-tc-darkbg.png`, `logo-tc-transparente.png`, `logo-tc.jpg`) nos HTMLs ativos.
- **0** menções a cargos individuais de currículo nos blocos de serviços (RPA CoE e TOTVS BPM).
- **100%** dos 6 produtos digitais acessíveis no Bento Grid com modal funcional em PT e EN.
- **0** erros de HTML malformado (fechamento duplicado após `#sobre` removido) e **0** erros no console do navegador.
- **HTTP 200** em `https://www.tcaicorp.online/` e nos novos ativos de logo/favicon após deploy na Hostinger.

## 10. Riscos, dependências e premissas
- **Risco — Recorte de fundo branco do logotipo JPG:** como o anexo está em `.jpg` com compressão, o recorte do fundo branco precisa evitar halos brancos (anti-aliasing limpo) e gerar uma variante com alto contraste para o rodapé escuro. *Mitigação:* processamento via Python (Pillow/NumPy) com alpha matting cuidadoso na remoção do branco e inspeção visual das imagens geradas antes da aplicação.
- **Dependência — MCP Hostinger:** o deploy final depende de autenticação ativa no MCP `hostinger-hosting`. *Mitigação:* verificar a disponibilidade das ferramentas MCP no momento do deploy e, em caso de bloqueio, reportar claramente o passo necessário.
- **Premissa:** os domínios externos dos produtos (`grid402.online`, `pecamatchai.com.br`, `rankproseo.com.br`, `vailotar.com.br`, `firmeza-parkinson.web.app`) e os canais de contato continuam os mesmos já configurados.

## 11. Questões em aberto
- Nenhuma questão em aberto após o alinhamento de Grill-me.
