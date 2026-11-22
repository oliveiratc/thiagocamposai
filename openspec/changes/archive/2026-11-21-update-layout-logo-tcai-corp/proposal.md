# Redesign Enterprise Clean e Nova Identidade Visual TC AI CORP

## Por quê
O portal institucional da **TCAI Corp** (`www.tcaicorp.online`) ainda exibe o logotipo antigo e mantém a estrutura visual herdada do antigo portfólio pessoal: 8 blocos verticais extensos empilhados, referências a cargos individuais nos cases de RPA e TOTVS, ausência de CTAs claros no cabeçalho e no Hero, além de fechamento duplicado de tags HTML após a seção `#sobre`.

Conforme especificado no PRD [redesign-enterprise-logo-tcai-corp.md](../../prds/redesign-enterprise-logo-tcai-corp.md), é necessário substituir integralmente os ativos de marca pelo novo logotipo oficial **TC AI CORP** e redesenhar o site sob a direção **Enterprise Clean / Precision Grid**, reduzindo a fadiga de rolagem, consolidando a voz corporativa B2B e simplificando a conversão comercial.

## O que muda
- **Novos ativos de marca:** geração de logotipo horizontal recortado com fundo transparente (`logo-tcai-corp.png`), variante para fundo escuro (`logo-tcai-corp-dark.png`), favicons (`favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png`) e imagem OpenGraph (`og-tcai-corp.jpg`), substituindo 100% das referências antigas em `index.html`, `privacidade.html`, `termos.html` e Schema.org.
- **Paleta e estética Enterprise Clean / Precision Grid:** atualização do sistema visual para **Deep Navy (`#072f5f` / `#0b4a8b`)** e **Grafite/Aço Metálico (`#475569`)** sobre superfícies claras (`#ffffff` / `#f8fafc`) com linhas estruturais sutis.
- **Cabeçalho e Hero orientados à conversão:** botão CTA **"Falar com a TCAI Corp"** no cabeçalho fixo e **Hero assimétrico** (proposta de valor + 2 CTAs à esquerda; painel visual do ecossistema TCAI/Grid402 à direita), seguido de faixa compacta de métricas.
- **Bento Grid de Produtos + Modal de Detalhes:** destaque largo (2 colunas) para o **Grid402** e cards enxutos para **Peça Match AI**, **RankPro SEO**, **VaiLotar**, **AuditIA** e **Firmeza** com modal acessível *"Ver detalhes"* preservando métricas, diferenciais e o aviso clínico do Firmeza.
- **Separação de Serviços Enterprise:** reescrita 100% institucional de **Centros de Excelência RPA** e **Governança BPM / TOTVS Fluig** junto aos pilares/sobre, removendo formato de currículo e cargos pessoais.
- **Contato simplificado, preservação técnica e deploy:** contato comercial direto, rodapé Deep Navy com novo logo, preservação de **PT | EN** (inclusive nos modais), Schema.org, WebMCP, banner LGPD, redirecionamento de `thiagocampos.ai`, correção do HTML duplicado após `#sobre` e deploy final na **Hostinger**.

## Impacto
- **Specs afetadas:** `institucional`
- **Código e ativos afetados:**
  - Novos ativos de imagem na raiz: `logo-tcai-corp.png`, `logo-tcai-corp-dark.png`, `og-tcai-corp.jpg`, `favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png`
  - Páginas HTML: `index.html`, `privacidade.html`, `termos.html`
  - Infraestrutura: deploy em produção no website `tcaicorp.online` na Hostinger
