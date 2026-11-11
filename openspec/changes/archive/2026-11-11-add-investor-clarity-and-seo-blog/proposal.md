# Comunicação Executiva em Dupla Camada (Investidor + TI) e Blog Autônomo de SEO (Topo/Meio de Funil)

## Por quê
A partir do feedback de um potencial investidor sobre o portal `www.tcaicorp.online` (documentado no PRD [`openspec/prds/comunicacao-investidor-e-blog-seo.md`](../../prds/comunicacao-investidor-e-blog-seo.md)), identificou-se que termos técnicos avançados na camada principal dos cases (como `"Acurácia F1 em Backtest"`, `"LightGBM"`, `"SEP-1649"`, `"Zero-DB"`, `"Consenso Dual-IA"`) dificultam a compreensão imediata de valor por investidores e decisores de negócios B2B. Além disso, o portal precisa de um motor contínuo de aquisição orgânica (SEO) com conteúdos diários de **Topo e Meio de Funil** para atrair clientes que pesquisam suas dores operacionais no Google.

## O que muda
- **Camada Executiva + Tags de Tese de Negócio na Home (`index.html`):**
  - Substituição dos jargões técnicos da visão primária dos 6 cases por linguagem focada em dor resolvida, previsibilidade operacional e retorno financeiro (ROI), tanto em Português quanto em Inglês (`PT | EN`).
  - Adição de badges de **Modelo de Negócio / Monetização** em cada case (ex.: *SaaS B2B Recorrente*, *Pay-per-Use em Dólar (USDC)*, *Redução Direta de OPEX*).
- **Gaveta Expansível `"Ver Ficha Técnica e Arquitetura (Para TI / Devs)"` (`index.html`):**
  - Inclusão de um acordeão interativo e acessível (`<details>/<summary>`) em cada um dos 6 cases contendo as especificações profundas de engenharia, algoritmos (`LightGBM`, `F1-Score 92.4% em Backtest`), protocolos (`HTTP 402`, `MCP`, `SEP-1649`, `OpenAPI 3.1`) e arquitetura (`Zero-DB`, `Consenso Dual-IA`).
- **Portal de Blog & Insights Executivos (`/blog/`):**
  - Nova seção na Home (`#blog`) destacando os últimos artigos executivos e link no menu/rodapé para `/blog/`.
  - Portal `/blog/index.html` com filtragem por etapa do funil (*Topo de Funil* e *Meio de Funil*) e pelas 5 categorias estratégicas conectadas aos produtos da TCAI Corp.
  - Publicação imediata de **6 artigos-pilar iniciais** em HTML5 estático com `Schema.org/BlogPosting`, `BreadcrumbList`, tempo de leitura e CTAs contextuais (incluindo o artigo que explica *Previsão de Demanda, Backtest e Precisão Preditiva* para executivos e investidores).
- **Motor 100% Autônomo de Publicação Diária na Hostinger (`blog/cron_publish.php`):**
  - Script PHP autônomo para rodar via Cron Job diário na Hostinger, consumindo a fila de pautas (`blog/topics_queue.json`) e a API do Google Gemini (com motor local resiliente de fallback), gerando novos artigos HTML estáticos e atualizando automaticamente `blog/posts.json`, `sitemap.xml` e `llms.txt`.

## Impacto
- **Specs afetadas:** `institucional`
- **Código afetado:**
  - `index.html` (reformulação de copy executiva PT/EN, badges de modelo de negócio, gavetas de ficha técnica e seção de vitrine do blog)
  - `blog/index.html` (portal de artigos com filtros de funil e categoria)
  - `blog/posts.json` e `blog/topics_queue.json` (catálogo de artigos publicados e fila de pautas de topo/meio de funil)
  - `blog/*.html` (6 artigos-pilar iniciais completos)
  - `blog/cron_publish.php` (motor autônomo de geração e publicação diária via Cron Job + Gemini API)
  - `sitemap.xml`, `llms.txt`, `llms-full.txt` e `.gitignore`

