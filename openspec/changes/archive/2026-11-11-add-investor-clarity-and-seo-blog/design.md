# Design Técnico: Dupla Camada Executiva/Técnica e Motor Autônomo de Blog SEO

## 1. Arquitetura de Dupla Camada nos Cases (`index.html`)
Para conciliar a leitura de **Investidores/Decisores B2B** com a avaliação de **CTOs/Desenvolvedores**, cada card de projeto na seção `#projetos` seguirá a estrutura em duas camadas:

1. **Camada Visível (Padrão — Visão Executiva e de Investimento):**
   - **Badges Superiores:** Categoria de mercado + **Badge de Modelo de Negócio** (ex.: `Modelo: SaaS B2B Recorrente`, `Monetização: Pay-per-Use em Dólar`).
   - **Título e Narrativa:** Focados no problema econômico real, na solução em linguagem clara e no impacto no balanço financeiro.
   - **Indicadores Executivos (2 Cards):** Métricas traduzidas para valor de negócio (ex.: no VaiLotar, em vez de `"Acurácia F1 em Backtest"`, exibe `"92,4% de Assertividade Comprovada — Validado com dados históricos reais para antecipar lotação com segurança"`).
2. **Camada Expansível (`<details class="group ...">` — Ficha Técnica para TI e Devs):**
   - Botão `<summary>`: `"Ver Ficha Técnica e Arquitetura (Para TI / Devs)"`.
   - Conteúdo interno estruturado em grade técnica contendo: Motor/Algoritmo (`LightGBM`, `Consenso Dual-IA`, `Embeddings Semânticos`), Métricas de Engenharia (`F1-Score: 92.4% em Backtest`, `Latência < 1ms`, `Zero-DB`), Protocolos e Integrações (`HTTP 402`, `MCP SEP-1649`, `OpenAPI 3.1`, `A2A Agent Card`).
   - Totalmente integrado ao dicionário bilíngue (`data-i18n` / `data-i18n-html` em `PT` e `EN`).

## 2. Arquitetura Zero-DB do Blog (`/blog/`)
Seguindo o padrão de altíssima velocidade e segurança do projeto (sem dependência de banco de dados SQL):
- **`blog/posts.json`**: Catálogo indexado com metadados de todos os artigos publicados (`slug`, `title`, `excerpt`, `category`, `category_slug`, `funnel_stage`, `published_at`, `read_time`, `related_product`, `related_url`, `keywords`).
- **`blog/topics_queue.json`**: Fila estruturada de pautas de **Topo de Funil** (conscientização de dor e tendências) e **Meio de Funil** (comparação, metodologia e ROI) distribuídas entre as 5 verticais da TCAI Corp.
- **`blog/index.html`**: Central de Insights com renderização imediata dos cards de artigos, busca instantânea e filtros interativos por **Estágio do Funil** (`Todos`, `Topo de Funil`, `Meio de Funil`) e por **Vertical de Negócio**.
- **`blog/<slug>.html`**: Páginas estáticas individuais pré-renderizadas para indexação imediata pelo Googlebot e agentes de IA, contendo:
  - `Schema.org/BlogPosting` e `BreadcrumbList` em JSON-LD;
  - Box de **"Resumo Executivo (TL;DR para Decisores e Investidores)"** no topo do artigo;
  - Conteúdo escaneável com subtítulos H2/H3, tabelas comparativas e exemplos práticos sem jargões obscuros;
  - Box de CTA contextual conectando a dor explicada no artigo ao produto correspondente da TCAI Corp (`VaiLotar`, `Auditia`, `Peça Match AI`, `RankPro SEO` ou `Grid402`).

## 3. Motor Autônomo de Publicação Diária (`blog/cron_publish.php`)
Para atender à recomendação de **atualização diária constante** na Hostinger sem exigir trabalho manual:
- **Gatilho de Execução:**
  - Pode ser executado via **Cron Job nativo da Hostinger** (`php /home/.../public_html/blog/cron_publish.php`) uma vez por dia, ou via requisição HTTPS autenticada (`GET /blog/cron_publish.php?token=<BLOG_CRON_SECRET>`).
- **Fluxo de Geração em 4 Etapas:**
  1. **Seleção de Pauta:** Lê `blog/topics_queue.json` e seleciona a próxima pauta inédita (ou gera uma nova variação temática de topo/meio de funil caso a fila chegue ao fim).
  2. **Redação Inteligente (Gemini API + Fallback Estruturado):**
     - Se `GEMINI_API_KEY` estiver configurada no `.env`, realiza chamada à API `gemini-2.5-flash` com prompt engenheirado para redigir um artigo B2B profundo, didático, sem jargões inexplicados, estruturado em HTML semântico com Resumo Executivo e FAQ.
     - Se `GEMINI_API_KEY` não estiver presente ou a API externa oscilar, utiliza o gerador editorial estruturado embutido nas pautas de `topics_queue.json` para garantir que a publicação diária **nunca falhe**.
  3. **Persistência Atômica (Zero-DB):**
     - Renderiza o template mestre do artigo e salva em `blog/<slug>.html` com trava concorrente (`flock`).
     - Insere o novo artigo no topo de `blog/posts.json`.
  4. **Sincronização de SEO e Agentes:**
     - Atualiza automaticamente o `sitemap.xml` na raiz do site incluindo a nova URL `<loc>https://www.tcaicorp.online/blog/<slug>.html</loc>` com `<lastmod>` da data atual.
     - Atualiza a listagem de artigos em `llms.txt` para descoberta por IAs.

