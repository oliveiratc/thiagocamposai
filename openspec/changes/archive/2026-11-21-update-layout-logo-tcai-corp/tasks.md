# Tasks: Redesign Enterprise Clean e Nova Identidade TC AI CORP

## 1. Geracao de Ativos de Marca (Novo Logotipo TC AI CORP)
- [x] 1.1 Criar ambiente virtual Python isolado (se nao existir) com `Pillow` e `numpy` para processamento limpo do logotipo anexado (`media_1795309786064_89ce5dc5.jpg`).
- [x] 1.2 Gerar `logo-tcai-corp.png` (recorte com fundo transparente e anti-aliasing limpo), `logo-tcai-corp-dark.png` (variante alto contraste para fundo Deep Navy), `og-tcai-corp.jpg` (1200x630), `favicon-16x16.png`, `favicon-32x32.png`, `favicon.ico` e `apple-touch-icon.png` na raiz do projeto.
- [x] 1.3 Inspecionar visualmente os ativos gerados (`logo-tcai-corp.png`, `logo-tcai-corp-dark.png`, `og-tcai-corp.jpg` e `apple-touch-icon.png`) para confirmar recorte limpo, proporcao e contraste.

## 2. Redesign da Pagina Principal (`index.html`)
- [x] 2.1 Atualizar metadados `<head>`, favicons, `og:image`, `twitter:image`, Schema.org (`logo`/`image`) e paleta Tailwind para **Enterprise Clean / Precision Grid** (Deep Navy `#072f5f`/`#0b4a8b` + Grafite Metálico `#475569`), preservando redirecionamento de `thiagocampos.ai` e tags agenticas.
- [x] 2.2 Implementar novo cabecalho sticky com `logo-tcai-corp.png`, menu corporativo enxuto, seletor bilingue `PT | EN`, botao CTA **"Falar com a TCAI Corp"** e menu mobile acessivel.
- [x] 2.3 Implementar **Hero assimetrico** (proposta de valor + 2 CTAs a esquerda; painel visual arquitetural do ecossistema TCAI/Grid402 a direita) e faixa horizontal compacta de metricas com contadores animados.
- [x] 2.4 Implementar **Vitrine de Produtos em Bento Grid** (`#projetos`): card destaque largo para o **Grid402** (com links `grid402.online`, `/agents`, `/openapi.json`) e 5 cards compactos (**Peca Match AI**, **RankPro SEO**, **VaiLotar**, **AuditIA**, **Firmeza**) com botao **"Ver detalhes"**.
- [x] 2.5 Implementar **Modal acessivel de detalhes do produto** (`role="dialog"`, `aria-modal="true"`, suporte a `ESC`, backdrop e restauracao de foco) alimentado por catalogo estruturado PT/EN, preservando metricas, diferenciais, links externos e aviso clinico do **Firmeza**.
- [x] 2.6 Reestruturar secoes **Sobre a TCAI Corp** e **Servicos Enterprise** (3 pilares + **Centros de Excelencia RPA** e **Governanca BPM / TOTVS Fluig** com voz 100% institucional, sem cargos pessoais de curriculo), corrigindo o fechamento duplicado de tags HTML apos `#sobre`.
- [x] 2.7 Implementar bloco de **Contato Simplificado** (WhatsApp `+55 (11) 95832-5848`, copia em 1 clique + `mailto:contato@tcaicorp.online`, LinkedIn) e **Rodape Deep Navy** com `logo-tcai-corp-dark.png`, links institucionais, legais e agenticos.
- [x] 2.8 Atualizar dicionario bilingue completo (`PT` e `EN`, incluindo todos os novos elementos e dados do modal), preservar WebMCP, banner LGPD e botao voltar ao topo.

## 3. Atualizacao das Paginas Legais (`privacidade.html` e `termos.html`)
- [x] 3.1 Atualizar `privacidade.html` com `logo-tcai-corp.png`, `logo-tcai-corp-dark.png`, novos favicons e paleta Deep Navy consistente com o redesign.
- [x] 3.2 Atualizar `termos.html` com `logo-tcai-corp.png`, `logo-tcai-corp-dark.png`, novos favicons e paleta Deep Navy consistente com o redesign.

## 4. Testes, Verificacao e Deploy na Hostinger
- [x] 4.1 Executar suite automatizada de validacao cobrindo todos os cenarios da spec (existencia de ativos, zero referencias a logos antigos, HTML balanceado, unico `<h1>`, zero cargos pessoais em RPA/TOTVS, completude de chaves i18n PT/EN, presenca de WebMCP/Schema.org/LGPD/redirect).
- [x] 4.2 Validar visual e funcionalmente o site em servidor local (desktop e mobile, troca PT/EN, abertura/fechamento do modal de cada produto inclusive aviso do Firmeza, copia de e-mail e zero erros no console).
- [x] 4.3 Adicionar link `blog/` no novo layout e gerar pacote ZIP incremental seguro com apenas os 10 arquivos atualizados em `backups/` para upload via hPanel sem sobrescrever `blog/` ou `.env`.
