## 1. Dupla Camada (Executiva/Investidor + Ficha Técnica TI) no `index.html`
- [x] 1.1 Reformular os textos principais, subtítulos Visuais e cards de indicadores dos 6 cases no `index.html` (Grid402, Peça Match AI, RankPro SEO, Firmeza, Auditia e VaiLotar) para linguagem executiva de negócios e ROI (removendo `"Acurácia F1 em Backtest"`, `"LightGBM"`, `"SEP-1649"`, `"Zero-DB"` da camada primária).
- [x] 1.2 Adicionar badges explícitos de **Modelo de Negócio / Monetização** em cada um dos 6 cases no `index.html` (ex.: *Modelo: SaaS B2B Recorrente*, *Monetização: Pay-per-Use em Dólar*, *Impacto: Redução Direta de OPEX*).
- [x] 1.3 Criar o acordeão interativo `"Ver Ficha Técnica e Arquitetura (Para TI / Devs)"` (`<details>/<summary>`) dentro de cada um dos 6 cases, alocando ali todas as métricas estatísticas, algoritmos e protocolos de engenharia.
- [x] 1.4 Atualizar todo o dicionário bilíngue (`translations.pt` e `translations.en`) no `index.html` para refletir a nova camada executiva, os badges de modelo de negócio, as fichas técnicas e os links para o Blog.

## 2. Seção de Insights na Home e Portal `/blog/`
- [x] 2.1 Adicionar o item `"Blog & Insights"` no menu de navegação principal (desktop e mobile) e no rodapé de `index.html`, `about.html` e `contact.html`.
- [x] 2.2 Criar a seção `"Insights Executivos & Inteligência de Mercado"` na Home (`index.html` antes da seção de contato) exibindo os artigos em destaque de Topo e Meio de Funil com link para `/blog/`.
- [x] 2.3 Criar a página principal `/blog/index.html` com design alinhado à identidade TCAI Corp, busca em tempo real, filtro por Estágio de Funil (*Topo de Funil* e *Meio de Funil*) e pelas 5 categorias de negócio, consumindo `blog/posts.json` e exibindo os cards pré-renderizados para SEO.

## 3. Artigos-Pilar Iniciais (Topo e Meio de Funil)
- [x] 3.1 Criar o catálogo `blog/posts.json` e publicar os 6 artigos-pilar iniciais em `/blog/<slug>.html` com `Schema.org/BlogPosting`, `BreadcrumbList`, Resumo Executivo (TL;DR) e CTA para os produtos:
  1. `o-que-e-backtest-e-precisao-preditiva-em-ia-para-negocios.html` (Meio de Funil — VaiLotar / IA Preditiva: explica o que é Backtest e F1-Score em linguagem de negócios para investidores e gestores).
  2. `como-prever-demanda-hoteleira-e-turistica-com-antecedencia.html` (Topo de Funil — VaiLotar: como hotéis, parques e restaurantes evitam prejuízo de estoque e equipe ociosa).
  3. `reforma-tributaria-ibs-cbs-como-evitar-perda-de-creditos-fiscais.html` (Topo de Funil — Auditia: riscos ocultos na transição tributária e auditoria preventiva automática).
  4. `como-reduzir-devolucao-e-erro-na-compra-de-autopecas-pesadas.html` (Topo de Funil — Peça Match AI: impacto financeiro de caminhão parado e busca inteligente).
  5. `seo-com-ia-generativa-como-transformar-buscas-em-receita-b2b.html` (Meio de Funil — RankPro SEO: estratégia de topo e meio de funil para autoridade orgânica).
  6. `economia-de-agentes-de-ia-e-micropagamentos-m2m-nas-empresas.html` (Meio de Funil — Grid402: como funciona a monetização de dados para agentes autônomos sem jargões).

## 4. Motor 100% Autônomo de Publicação Diária (`blog/cron_publish.php`)
- [x] 4.1 Criar o banco de pautas estruturadas `blog/topics_queue.json` com dezenas de temas de Topo e Meio de Funil pré-mapeados para publicação diária contínua.
- [x] 4.2 Desenvolver o script `blog/cron_publish.php` (compatível com Cron Job da Hostinger e chamada via token seguro `BLOG_CRON_SECRET`), integrando geração via API do Google Gemini (`GEMINI_API_KEY`) com fallback estruturado local, escrita atômica do HTML do artigo e atualização automática de `blog/posts.json`, `sitemap.xml` e `llms.txt`.
- [x] 4.3 Criar o arquivo `.env.example` documentando `GEMINI_API_KEY` e `BLOG_CRON_SECRET` e garantir que `.env` esteja protegido no `.gitignore` e `.htaccess`.

## 5. Atualização de SEO, Sitemap, Testes e Verificação
- [x] 5.1 Atualizar `sitemap.xml`, `llms.txt` e `llms-full.txt` com a nova estrutura do Blog e os 6 artigos iniciais.
- [x] 5.2 Criar e executar o script de testes automatizados (`tests/verify_investor_and_blog.php` ou `.ps1`) validando todos os cenários da spec (ausência de jargão cru na camada executiva, presença das fichas técnicas expansíveis, renderização dos 6 artigos e funcionamento do `cron_publish.php`).
