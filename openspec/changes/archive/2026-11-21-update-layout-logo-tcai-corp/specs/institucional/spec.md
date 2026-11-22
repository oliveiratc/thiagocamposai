# Delta Spec: institucional

## ADDED Requirements

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

## MODIFIED Requirements

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
