## ADDED Requirements

### Requirement: Posicionamento Institucional Corporativo
O website MUST apresentar a TCAI Corp como empresa de tecnologia e produtos digitais B2B, com comunicacao e narrativa inteiramente em primeira pessoa do plural ("Nos" / "Nossa Empresa"), sem foco em biografia pessoal.

#### Scenario: Visualizacao da proposta de valor institucional no Hero
- GIVEN que o usuario acessa a pagina inicial do website
- WHEN o Hero for renderizado
- THEN o titulo principal MUST destacar solucoes corporativas de inteligencia artificial e produtos digitais de alta eficiencia
- AND o badge institucional MUST exibir a assinatura da TCAI Corp
- AND o logotipo TC MUST estar preservado com link para a pagina inicial institucional

#### Scenario: Navegacao institucional no cabecalho
- GIVEN que o usuario visualiza o menu superior
- WHEN consultar os itens de navegacao
- THEN os links MUST direcionar para as secoes corporativas ("Sobre a TCAI Corp", "Impacto e Metricas", "Solucoes e Produtos", "Contato Institucional")
- AND o botao principal de chamada MUST convidar para "Falar com a TCAI Corp"

### Requirement: Vitrine de Produtos e Inclusao do Grid402
O website MUST exibir a grade de produtos digitais e plataformas B2B desenvolvidas pela TCAI Corp, incluindo com destaque o Grid402 (www.grid402.online).

#### Scenario: Exibicao do produto Grid402 na grade de solucoes
- GIVEN que o visitante navega ate a secao de produtos e solucoes
- WHEN o catalogo de produtos for exibido
- THEN o Grid402 MUST constar como produto em destaque
- AND a descricao MUST informar tratar-se de hub de microsservicos e dados abertos para agentes autonomos de IA sob protocolo HTTP 402 com liquidacao em USDC na rede Base
- AND MUST conter botao com link externo direcionando para `https://grid402.online`
- AND os demais produtos consolidados (Peca Match AI, RankPro SEO, VaiLotar, AuditIA e automacoes RPA) MUST permanecer no portfólio

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
