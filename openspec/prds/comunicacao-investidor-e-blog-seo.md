# PRD: Comunicação Executiva em Dupla Camada (Investidor + TI) e Blog Autônomo de SEO (Topo/Meio de Funil)

**Status:** Aprovado
**Data:** 2026-11-11
**Autor:** Thiago Campos + Antigravity

## 1. Contexto e problema
Após análise do portal institucional `www.tcaicorp.online` por um potencial investidor, foram identificados dois pontos críticos de melhoria:
1. **Barreira de linguagem técnica na camada principal de leitura:** A página inicial apresenta métricas e descrições com jargões profundos de engenharia e ciência de dados (como `"Acurácia F1 em Backtest"`, `"LightGBM"`, `"Protocolo HTTP 402"`, `"Zero-DB"`, `"SEP-1649"`, `"Consenso Dual-IA"`). Embora isso gere alta credibilidade junto a desenvolvedores e líderes de TI, afasta ou confunde investidores, executivos C-Level e compradores B2B do mercado tradicional (hotelaria, contabilidade, autopeças, marketing), que buscam clareza imediata sobre dor resolvida, modelo de receita e retorno financeiro (ROI).
2. **Ausência de aquisição orgânica de Topo e Meio de Funil (SEO):** O site institucional atual captura apenas buscas institucionais ou de fundo de funil. Falta uma estrutura de Blog / Central de Insights atualizada diariamente com conteúdos educativos e comparativos (topo e meio de funil) que atraiam decisores pesquisando suas dores de negócio no Google e desmistifiquem conceitos técnicos em linguagem executiva.

## 2. Objetivos
- **Comunicação Híbrida em Dupla Camada na Home (`index.html`):** Reescrever 100% da primeira camada de leitura dos cases e métricas para linguagem executiva de negócios, ROI e tese de investimento (PT e EN), movendo as especificações de engenharia (`F1-Score em Backtest`, `LightGBM`, `HTTP 402`, `Zero-DB`, `SEP-1649`, `Dual-IA`) para uma gaveta expansível interativa (`"Ver Ficha Técnica e Arquitetura — Para TI e Devs"`) dentro de cada projeto.
- **Tese de Negócio e Monetização Explícita para Investidores:** Adicionar badges e indicadores claros do modelo de negócio de cada solução na vitrine (ex: *SaaS B2B Recorrente*, *Infraestrutura Pay-per-Use em Dólar (USDC)*, *Redução Direta de OPEX*).
- **Lançamento do Blog / Central de Insights B2B (`/blog/`):** Criar uma seção de destaque na Home e um portal dedicado de conteúdos com 5 categorias conectadas aos produtos da TCAI Corp e **6 artigos-pilar iniciais já publicados** (incluindo o artigo que explica *Previsão de Demanda, Backtest e Precisão Preditiva* em linguagem de negócios).
- **Motor 100% Autônomo de Publicação Diária na Hostinger (`blog/cron_publish.php`):** Implementar um publicador automatizado em PHP na Hostinger (acionável via Cron Job diário) que consome a API do Google Gemini (com fila editorial estruturada de topo e meio de funil e fallback resiliente), gera o HTML estático otimizado para SEO (`Schema.org/BlogPosting`), atualiza o catálogo (`blog/posts.json`), o `sitemap.xml` e o `llms.txt` sem necessidade de intervenção manual.

## 3. Não objetivos (fora do escopo)
- Não serão feitas alterações na interface ou código do portal `grid402.online` (que permanece estritamente voltado para desenvolvedores e agentes M2M).
- Não será utilizado banco de dados relacional (MySQL/PostgreSQL) nem CMS pesado como WordPress para o blog; toda a arquitetura continuará Zero-DB (arquivos estáticos HTML5 + JSON com escrita atômica em PHP), preservando performance máxima (LCP < 1.5s).
- Não serão removidas as informações técnicas do site: elas serão organizadas na camada expansível `"Ficha Técnica e Arquitetura"` para continuar atendendo CTOs, engenheiros e agentes de IA.

## 4. Público-alvo e personas
- **Investidores e Parceiros Estratégicos:** Avaliam tese de mercado, escalabilidade, tração, modelo de receita (SaaS, transacional em dólar) e confiabilidade dos produtos sem precisar dominar jargões de Machine Learning.
- **Decisores e Compradores B2B (C-Level, Diretores de Operações, Contadores, Hoteleiros, Gestores de Frota):** Buscam resolver dores reais (caminhão parado, perda de crédito tributário IBS/CBS, ociosidade hoteleira, baixa geração de leads) através de conteúdos de topo/meio de funil no Blog e proposta de valor clara na Home.
- **Líderes de TI, CTOs e Desenvolvedores:** Continuam encontrando a profundidade arquitetural e os links técnicos (OpenAPI, MCP, SDKs, algoritmos e métricas de validação) ao expandir a gaveta técnica de cada case.

## 5. Histórias de usuário
- **Como potencial investidor**, quero entender imediatamente qual problema cada produto resolve, como ele ganha dinheiro e o que significam suas métricas de sucesso em termos comerciais (sem precisar saber o que é "Acurácia F1 em Backtest"), para avaliar o potencial de retorno da TCAI Corp.
- **Como CTO ou desenvolvedor**, quero poder clicar em `"Ver Ficha Técnica e Arquitetura"` dentro de qualquer case para inspecionar os modelos de IA, protocolos (`HTTP 402`, `MCP`), stack e métricas estatísticas (`F1-Score`, `LightGBM`, `Zero-DB`).
- **Como potencial cliente B2B pesquisando no Google**, quero encontrar artigos claros e educativos no Blog da TCAI Corp sobre o meu problema operacional (topo e meio de funil) e ser conduzido naturalmente para conhecer a solução correspondente da TCAI Corp.
- **Como fundador da TCAI Corp**, quero que o Blog publique novos artigos otimizados para SEO diariamente de forma 100% autônoma no servidor da Hostinger, mantendo o `sitemap.xml` e a indexação sempre atualizados.

## 6. Requisitos funcionais
| ID | Requisito | Prioridade (Must/Should/Could) |
|---|---|---|
| RF01 | Reformular os textos principais e cards de métricas de todos os cases na Home (`index.html`) — em PT e EN — substituindo jargões técnicos por benefícios executivos e impacto financeiro claro (ex: substituir `"Acurácia F1 em Backtest"` por `"Assertividade Comprovada na Prática"` com explicação acessível). | Must |
| RF02 | Adicionar tags explícitas de **Modelo de Negócio / Monetização** em cada case (ex: `Modelo: SaaS B2B Recorrente`, `Modelo: Pay-per-Use em Dólar`, `Impacto: Redução de OPEX`) para leitura rápida de investidores. | Must |
| RF03 | Implementar em cada case do `index.html` o componente interativo expansível (`<details>` ou acordeão acessível) `"Ver Ficha Técnica e Arquitetura (Para TI / Devs)"`, preservando ali todas as especificações técnicas (`LightGBM`, `F1-Score 92.4% em Backtest`, `Protocolo HTTP 402`, `Zero-DB`, `SEP-1649`, `Consenso Dual-IA`, etc.). | Must |
| RF04 | Adicionar no `index.html` (e na navegação principal/rodapé) uma seção de destaque **"Blog e Insights Executivos"** exibindo os artigos mais recentes com link para a central `/blog/`. | Must |
| RF05 | Criar a página principal do Blog (`/blog/index.html`) com filtro dinâmico por estágio de funil (`Todos`, `Topo de Funil: Tendências e Problemas`, `Meio de Funil: Guias e Metodologia`) e pelas 5 categorias de negócio conectadas ao portfólio. | Must |
| RF06 | Publicar 6 artigos-pilar iniciais completos em `/blog/<slug>.html` (com HTML semântico, `Schema.org/BlogPosting`, `BreadcrumbList`, tempo de leitura, resumo executivo e CTA para o produto correspondente), incluindo obrigatoriamente o artigo que desmistifica *Previsão de Demanda, Backtest e F1-Score* para executivos e investidores. | Must |
| RF07 | Desenvolver o motor autônomo `blog/cron_publish.php` para execução diária na Hostinger, capaz de gerar novos artigos de topo e meio de funil via API do Google Gemini (ou consumir pautas estruturadas do banco editorial `blog/topics_queue.json`), criar o arquivo HTML do post, atualizar `blog/posts.json`, `sitemap.xml` e `llms.txt`. | Must |
| RF08 | Proteger o endpoint/script `blog/cron_publish.php` para execução via CLI (Cron da Hostinger) ou via chave secreta configurada em `.env` (`BLOG_CRON_SECRET`), impedindo acionamento não autorizado. | Must |

## 7. Requisitos não funcionais
- **Performance:** Páginas do blog e home 100% estáticas no momento da leitura pelo visitante (o PHP roda apenas no Cron para gerar os HTMLs estáticos), garantindo carregamento instantâneo (LCP < 1.5s).
- **SEO e Indexação:** Todos os artigos devem conter metatags `canonical`, `OpenGraph`, `Twitter Card`, `Schema.org/BlogPosting`, `FAQPage` (quando aplicável) e inclusão automática no `sitemap.xml`.
- **Acessibilidade:** Gavetas de `"Ficha Técnica"` e filtros do blog acessíveis via teclado (`aria-expanded`, `<details>/<summary>`) e contraste em conformidade com WCAG 2.1 AA.
- **Segurança:** Nenhuma chave de API (`GEMINI_API_KEY`, `BLOG_CRON_SECRET`) exposta no código-fonte ou no frontend; leitura exclusiva via `.env` no servidor e `.env` listado no `.gitignore`.

## 8. Fluxos e UX
- **Fluxo 1 (Investidor / Executivo na Home):** Acessa `www.tcaicorp.online` -> Lê proposta de valor e métricas de negócio sem esbarrar em jargões obscuros -> Identifica o modelo de receita de cada produto -> Lê a seção de Insights Executivos ou entra em contato.
- **Fluxo 2 (CTO / Desenvolvedor na Home):** Acessa a seção de projetos -> Clica em `"Ver Ficha Técnica e Arquitetura (Para TI / Devs)"` no card do projeto -> Visualiza arquitetura, algoritmos (`LightGBM`, `F1-Score`), protocolos (`HTTP 402`, `MCP`) e links de documentação técnica.
- **Fluxo 3 (Visitante via Google / SEO Topo e Meio de Funil):** Pesquisa uma dor de negócio no Google -> Cai em um artigo de `/blog/<slug>.html` -> Lê um conteúdo executivo claro e didático -> Clica no CTA contextual do produto da TCAI Corp (VaiLotar, Auditia, Peça Match AI, RankPro ou Grid402).
- **Fluxo 4 (Atualização Diária Autônoma):** O Cron Job diário da Hostinger executa `php blog/cron_publish.php` -> O script seleciona o próximo tópico de topo/meio de funil -> Gera o artigo via Gemini API (ou motor estruturado) -> Salva `/blog/<novo-artigo>.html` -> Atualiza `blog/posts.json` e `sitemap.xml`.

## 9. Métricas de sucesso
- 0 jargões estatísticos/algorítmicos sem explicação na camada primária dos cards da Home (100% movidos ou traduzidos + alocados na gaveta `"Ficha Técnica"`).
- 100% dos 6 casos da Home contendo indicador claro de Modelo de Negócio/Impacto e gaveta expansível de Ficha Técnica funcional em PT e EN.
- Portal `/blog/` ativo com 6 artigos iniciais publicados, indexados no `sitemap.xml` e validados com `Schema.org/BlogPosting`.
- Script `blog/cron_publish.php` testado e funcional para geração diária automatizada de novos artigos.

## 10. Riscos, dependências e premissas
- **Disponibilidade da API Gemini no Cron:** Caso a variável `GEMINI_API_KEY` ainda não esteja preenchida no `.env` da Hostinger ou ocorra oscilação de rede no momento do Cron, o `cron_publish.php` deve possuir um banco local de pautas e templates executivos ricos para nunca falhar nem gerar páginas vazias.
- **Manutenção do Bilinguismo na Home:** Todas as melhorias de texto e gavetas técnicas no `index.html` devem manter compatibilidade total com o seletor de idiomas `PT | EN` existente.

## 11. Questões em aberto
- Nenhuma questão pendente. Decisões 100% alinhadas na etapa de Grill-me.

