## ADDED Requirements

### Requirement: Comunicacao Hibrida em Dupla Camada (Executiva e Tecnica) nos Cases
O website MUST apresentar todos os produtos e cases na camada principal de leitura em linguagem executiva focada em dor de negocio, modelo de monetizacao e retorno sobre investimento (ROI), mantendo as especificacoes profundas de engenharia recolhidas em um componente expansivel ("Ficha Tecnica e Arquitetura") dentro de cada case.

#### Scenario: Leitura executiva para investidores e decisores B2B
- GIVEN que um investidor ou executivo B2B navega pela secao de produtos e cases na pagina inicial
- WHEN visualizar a descricao principal e os indicadores de cada projeto
- THEN o texto principal MUST comunicar o problema economico resolvido e o impacto financeiro sem exigir conhecimento de jargoes estatisticos ou algoritmicos (substituindo termos como "Acuracia F1 em Backtest" na camada visivel por "Assertividade Comprovada na Pratica")
- AND cada case MUST exibir um badge explícito de modelo de negocio ou impacto financeiro (ex: "Modelo: SaaS B2B Recorrente", "Monetizacao: Pay-per-Use em Dolar", "Impacto: Reducao Direta de OPEX")

#### Scenario: Inspecao da Ficha Tecnica por CTOs e desenvolvedores
- GIVEN que um profissional de TI, CTO ou desenvolvedor deseja validar a arquitetura técnica de um produto
- WHEN clicar no botao expansivel "Ver Ficha Tecnica e Arquitetura (Para TI / Devs)" do respectivo case
- THEN o sistema MUST expandir o painel contendo os detalhes técnicos de engenharia (como `LightGBM`, `F1-Score: 92.4% em Backtest`, `Protocolo HTTP 402`, `Zero-DB`, `SEP-1649`, `Consenso Dual-IA` e links OpenAPI/MCP)
- AND o componente MUST funcionar corretamente em Portugues (`PT`) e Ingles (`EN`)

### Requirement: Portal de Blog e Insights B2B para SEO de Topo e Meio de Funil
O website MUST disponibilizar uma secao de destaque na pagina inicial e uma central dedicada em `/blog/` com artigos educativos e comparativos de Topo e Meio de Funil conectados as verticais de negocio da TCAI Corp.

#### Scenario: Navegacao e filtragem na Central do Blog
- GIVEN que um visitante acessa `https://www.tcaicorp.online/blog/` ou clica em "Blog e Insights" no menu principal
- WHEN a pagina do blog for carregada
- THEN o sistema MUST listar os artigos publicados com indicacao de estágio do funil ("Topo de Funil" ou "Meio de Funil"), categoria de negocio e tempo de leitura
- AND o usuario MUST poder filtrar os artigos por estágio do funil e pelas 5 categorias estrategicas (Previsao de Demanda e Turismo, Inteligencia Fiscal e Reforma Tributaria, Eficiencia em Frotas e Autopecas, SEO e Crescimento B2B, IA Corporativa e Agentes Autonomos)

#### Scenario: Leitura de artigo pilar desmistificando termos técnicos e gerando conversao
- GIVEN que um visitante ou investidor acessa um artigo do blog (incluindo o artigo sobre Previsao de Demanda, Backtest e Precisao Preditiva)
- WHEN a pagina do artigo for renderizada
- THEN o artigo MUST apresentar um "Resumo Executivo (Para Decisores e Investidores)" no topo, conteúdo estruturado em linguagem acessivel, dados estruturados `Schema.org/BlogPosting` e um Call-to-Action (CTA) direcionando para o produto correspondente da TCAI Corp

### Requirement: Motor Autonomo de Publicacao Diaria de Conteudo SEO na Hostinger
O sistema MUST conter um motor automatizado em PHP (`blog/cron_publish.php`) capaz de gerar e publicar diariamente novos artigos de Topo e Meio de Funil via Cron Job na Hostinger sem intervencao manual.

#### Scenario: Execucao diaria automatizada do publicador de artigos
- GIVEN que o Cron Job diario da Hostinger (ou chamada autenticada com `BLOG_CRON_SECRET`) aciona `blog/cron_publish.php`
- WHEN houver pautas pendentes ou geradas para publicacao
- THEN o script MUST gerar o arquivo HTML estatico do novo artigo em `/blog/<slug>.html` (utilizando a API do Google Gemini quando `GEMINI_API_KEY` estiver configurada ou o motor editorial estruturado de fallback)
- AND MUST atualizar automaticamente o catalogo `blog/posts.json`, o `sitemap.xml` e o manifesto `llms.txt`

#### Scenario: Protecao contra execucao publica nao autorizada
- GIVEN que uma requisicao HTTP externa tenta acessar `blog/cron_publish.php` via navegador sem o token secreto válido
- WHEN o script validar a autenticacao
- THEN o sistema MUST bloquear a execucao com codigo HTTP 403 Forbidden

