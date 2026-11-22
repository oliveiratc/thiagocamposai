# institucional Specification

## Purpose
TBD - created by archiving change rebranding-tcai-corp. Update Purpose after archive.

## Requirements

### Requirement: Posicionamento Institucional Corporativo
O website MUST apresentar a TCAI Corp como empresa de tecnologia e produtos digitais B2B com estetica Enterprise Clean, comunicacao inteiramente em primeira pessoa do plural ("Nos" / "Nossa Empresa"), sem foco em biografia pessoal ou cargos individuais de curriculo.

#### Scenario: Visualizacao da proposta de valor institucional no Hero
- GIVEN que o usuario acessa a pagina inicial do website
- WHEN o Hero for renderizado
- THEN o layout MUST apresentar composicao assimetrica com proposta de valor institucional e 2 botoes CTA ("Falar com a TCAI Corp" e "Explorar Produtos") a esquerda
- AND a direita MUST exibir painel visual arquitetural do ecossistema TCAI (Grid402, Plataformas B2B e Agentes de IA)
- AND o titulo principal `<h1>` MUST destacar solucoes corporativas de inteligencia artificial e produtos digitais B2B
- AND o badge institucional MUST exibir a assinatura da TCAI Corp
- AND o novo logotipo oficial TC AI CORP (`logo-tcai-corp.png`) MUST estar exibido no cabecalho com link para o topo institucional

#### Scenario: Navegacao institucional no cabecalho
- GIVEN que o usuario visualiza o menu superior em desktop ou mobile
- WHEN consultar os itens de navegacao
- THEN os links MUST direcionar para as secoes corporativas ("Produtos", "Servicos", "Sobre", "Contato")
- AND o cabecalho MUST disponibilizar seletor bilingue PT/EN e botao principal de chamada convidando para "Falar com a TCAI Corp"

#### Scenario: Apresentacao institucional de Servicos Enterprise sem formato de curriculo
- GIVEN que o visitante navega ate as secoes Sobre e Servicos Enterprise
- WHEN visualizar as ofertas de Centros de Excelencia RPA e Governanca BPM / TOTVS Fluig
- THEN a redacao MUST descrever capacidades corporativas da TCAI Corp em primeira pessoa do plural
- AND MUST NOT exibir titulos de cargos individuais ou formato de historico de curriculo pessoal

### Requirement: Vitrine de Produtos e Inclusao do Grid402
O website MUST exibir a vitrine de produtos digitais e plataformas B2B desenvolvidas pela TCAI Corp em formato **Bento Grid** compacto, destacando o **Grid402** em card largo e oferecendo modal acessivel de detalhes tecnicos para os demais produtos.

#### Scenario: Exibicao do produto Grid402 na grade de solucoes
- GIVEN que o visitante navega ate a secao de produtos (`#projetos`)
- WHEN o Bento Grid for renderizado
- THEN o Grid402 MUST constar como card destaque principal de largura expandida
- AND a descricao MUST informar tratar-se de hub de microsservicos e dados abertos para agentes autonomos de IA sob protocolo HTTP 402 com liquidacao em USDC na rede Base
- AND MUST conter links externos direcionando para `https://grid402.online`, `https://grid402.online/agents` e `https://grid402.online/openapi.json`
- AND os 5 demais produtos (Peca Match AI, RankPro SEO, VaiLotar, AuditIA e Firmeza) MUST ser exibidos em cards compactos com metrica principal, resumo e botao "Ver detalhes"

#### Scenario: Abertura e fechamento acessivel do modal de detalhes de produto
- GIVEN que o visitante visualiza qualquer um dos 5 cards de produtos no Bento Grid
- WHEN clicar no botao "Ver detalhes" do produto desejado
- THEN um modal acessivel (`role="dialog"`, `aria-modal="true"`) MUST abrir exibindo imagem, descricao completa, metricas, diferenciais e link oficial do produto (ou CTA de apresentacao para AuditIA)
- AND no caso do produto Firmeza, o modal MUST preservar visivelmente o aviso de transparencia clinica
- AND o modal MUST poder ser fechado pelo botao de fechar, clique fora do conteudo ou tecla `ESC`, restaurando o foco ao botao de origem

### Requirement: Canais de Contato Corporativo
O website MUST centralizar e disponibilizar os dados e canais de contato institucionais oficiais da TCAI Corp.

#### Scenario: Acesso aos dados de contato oficiais
- GIVEN que o visitante acessa a secao de contato ou o rodape
- WHEN visualizar as opcoes de contato
- THEN o e-mail institucional MUST ser `contato@tcaicorp.online` com link `mailto:`
- AND o telefone e WhatsApp MUST ser `+55 (11) 95832-5848` com link direto para a API do WhatsApp
- AND o link oficial do website MUST apontar para `https://www.tcaicorp.online`
- AND os links de perfis em redes corporativas MUST permanecer disponiveis

### Requirement: Metadados Estruturados e Descoberta Agentica
O website MUST prover dados semanticos Schema.org de organizacao corporativa e arquivos para descoberta por agentes de IA e motores de busca.

#### Scenario: Leitura de dados semanticos Schema.org
- GIVEN que um motor de busca ou agente de IA analisa o documento HTML
- WHEN inspecionar a tag `script[type="application/ld+json"]`
- THEN o tipo principal MUST ser `@type: Organization`
- AND o nome MUST ser "TCAI Corp"
- AND a URL oficial MUST ser "https://www.tcaicorp.online"
- AND o e-mail e telefone corporativos MUST constar na definicao da organizacao

#### Scenario: Disponibilidade de arquivos agenticos
- GIVEN que um agente autonomo de IA busca por informacoes da empresa
- WHEN requisitar `llms.txt`, `llms-full.txt`, `sitemap.xml` ou `robots.txt`
- THEN esses arquivos MUST conter o contexto institucional da TCAI Corp e suas URLs atualizadas para o novo dominio

### Requirement: Hospedagem e Publicacao na Hostinger
O website institucional MUST ser provisionado e publicado sob o dominio `www.tcaicorp.online` na infraestrutura de hospedagem da Hostinger.

#### Scenario: Publicacao do website tcaicorp.online
- GIVEN que os arquivos do novo site corporativo estao preparados
- WHEN o website for criado e publicado na hospedagem Hostinger
- THEN a raiz do dominio `tcaicorp.online` e `www.tcaicorp.online` MUST servir a versao institucional com status 200

### Requirement: Redirecionamento Automatico do Dominio Legado
O dominio legado `thiagocampos.ai` MUST redirecionar automaticamente os visitantes para `https://www.tcaicorp.online`.

#### Scenario: Acesso ao endereco anterior
- GIVEN que um usuario ou rastreador acessa `https://thiagocampos.ai`
- WHEN a requisicao for processada
- THEN o usuario MUST ser redirecionado imediatamente para `https://www.tcaicorp.online`
- AND o documento MUST possuir a tag `canonical` apontando para `https://www.tcaicorp.online`

### Requirement: Identidade Visual Enterprise Clean e Ativos do Novo Logotipo
O website MUST adotar integralmente o novo logotipo oficial **TC AI CORP** e a paleta corporativa **Enterprise Clean / Precision Grid** derivada da nova marca (Deep Navy `#072f5f`/`#0b4a8b` e Grafite Metálico `#475569` sobre superfícies claras `#ffffff`/`#f8fafc`).

#### Scenario: Geracao e aplicacao dos novos ativos de marca
- GIVEN o arquivo original do logotipo oficial TC AI CORP fornecido pelo usuario
- WHEN os ativos de marca forem gerados e aplicados ao projeto
- THEN devem existir na raiz do projeto `logo-tcai-corp.png` (fundo transparente), `logo-tcai-corp-dark.png` (alto contraste para fundo escuro), `og-tcai-corp.jpg`, `favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png` e `apple-touch-icon.png`
- AND `index.html`, `privacidade.html` e `termos.html` MUST referenciar exclusivamente os novos ativos de logotipo e favicon
- AND nenhuma pagina ativa MUST manter referencias aos arquivos legados (`logo-tc-vibrante.png`, `logo-tc-darkbg.png`, `logo-tc-transparente.png`, `logo-tc.jpg`)
- AND as tags `og:image`, `twitter:image` e propriedades `logo`/`image` no Schema.org MUST apontar para os novos ativos em `https://www.tcaicorp.online/`

#### Scenario: Aplicacao da paleta Enterprise Clean nas paginas institucionais e legais
- GIVEN que o visitante acessa `index.html`, `privacidade.html` ou `termos.html`
- WHEN a pagina for renderizada
- THEN o esquema de cores primarias MUST utilizar Deep Navy (`#072f5f` / `#0b4a8b`) e Grafite Metálico (`#475569`) com contraste minimo WCAG AA
- AND o rodape escuro MUST exibir `logo-tcai-corp-dark.png` com legibilidade clara sobre o fundo Deep Navy

### Requirement: Suporte Bilingue Completo e Integridade Estrutural e Agentica
O website MUST preservar suporte bilingue completo (PT/EN) em toda a interface redesenhada, manter HTML semanticamente valido e preservar todos os recursos de descoberta agentica e privacidade.

#### Scenario: Alternancia de idioma em secoes e modais de produtos
- GIVEN que o visitante acessa a pagina inicial em Portugues (PT)
- WHEN acionar o seletor de idioma para Ingles (EN) e abrir o modal de detalhes de qualquer produto
- THEN todos os textos de navegacao, Hero, metricas, Bento Grid, servicos enterprise, contato, rodape e conteudo interno do modal MUST ser exibidos em Ingles sem chaves faltantes
- AND a preferencia de idioma MUST persistir no `localStorage` com fallback seguro para `pt`

#### Scenario: Integridade de HTML, acessibilidade e preservacao agentica
- GIVEN o documento `index.html` redesenhado
- WHEN o HTML e scripts forem validados
- THEN o documento MUST possuir exatamente um elemento `<h1>`, nenhuma tag de fechamento duplicada ou malformada e nenhum erro de execucao em console
- AND o script de redirecionamento de `thiagocampos.ai`, o banner LGPD, os atributos `data-agent-*`, o registro WebMCP (`get_tcai_corp_info`, `contact_tcai_corp`) e os links para `llms.txt` e `.well-known/mcp/server-card.json` MUST permanecer ativos

### Requirement: Publicacao do Redesign em Producao na Hostinger
Os arquivos atualizados do redesign e os novos ativos de marca MUST ser empacotados de forma incremental e segura para publicacao na hospedagem Hostinger sob `www.tcaicorp.online`, preservando integralmente o diretorio `blog/` e configuracoes sensiveis existentes no servidor.

#### Scenario: Empacotamento incremental seguro preservando o blog em producao
- GIVEN que os novos ativos de logotipo e paginas HTML redesenhadas foram validados localmente
- AND existe um diretorio `blog/` com automacoes ativas no servidor de producao
- WHEN o pacote incremental de deploy for gerado
- THEN o arquivo ZIP MUST conter exclusivamente os 10 arquivos novos ou atualizados (`index.html`, `privacidade.html`, `termos.html`, `logo-tcai-corp.png`, `logo-tcai-corp-dark.png`, `og-tcai-corp.jpg`, `favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png`)
- AND o menu de navegacao e rodape MUST preservar o link direto para `blog/`

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
