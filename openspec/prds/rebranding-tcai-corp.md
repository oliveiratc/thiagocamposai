# PRD: Rebranding Institucional TCAI Corp e Migração de Domínio

**Status:** Aprovado
**Data:** 2026-11-09
**Autor:** Thiago Campos + Antigravity

## 1. Contexto e problema
Atualmente, o site opera como um portfólio pessoal e executivo sob o domínio `thiagocampos.ai`. Com o crescimento dos produtos digitais B2B (como Peça Match AI, RankPro SEO, VaiLotar e o novo ecossistema Grid402), torna-se indispensável posicionar a marca no mercado corporativo como uma empresa de tecnologia, desenvolvimento de produtos de IA e infraestrutura B2B: a **TCAI Corp**.
É necessário atualizar o layout para refletir uma identidade 100% corporativa ("Nós"), configurar o novo domínio `www.tcaicorp.online` na Hostinger, manter o redirecionamento automático do domínio anterior, atualizar canais de atendimento e incluir o projeto `www.grid402.online` no portfólio de soluções.

## 2. Objetivos
- **Reposicionamento de Marca:** Transformar a narrativa visual e textual de portfólio pessoal para site institucional corporativo da TCAI Corp.
- **Migração de Domínio e Hospedagem:** Publicar o novo site corporativo em `www.tcaicorp.online` hospedado na infraestrutura Hostinger e manter o domínio `thiagocampos.ai` com redirecionamento automático.
- **Canais Corporativos:** Atualizar e padronizar os canais de contato: e-mail institucional `contato@tcaicorp.online`, WhatsApp/Telefone `(11) 95832-5848` e website `www.tcaicorp.online`.
- **Expansão de Produtos e Cases:** Destacar o `www.grid402.online` como solução de ponta (hub de microsserviços e dados abertos para agentes de IA sob protocolo HTTP 402) ao lado dos produtos consolidados.
- **SEO e Navegação Agêntica:** Atualizar Schema.org (Organization), OpenGraph, sitemap.xml, robots.txt, llms.txt e llms-full.txt.

## 3. Não objetivos (fora do escopo)
- Não será alterada a paleta de cores nem o logotipo principal (mantidos o Sapphire Blue, tons escuros e logo TC).
- Não será descontinuado nenhum produto consolidado existente (Peça Match AI, RankPro SEO, VaiLotar, AuditIA permanecem no catálogo).
- Não haverá criação de backend de banco de dados para o site institucional (permanecerá estático de alta performance em HTML5/Tailwind).

## 4. Público-alvo e personas
- **Empresas e Clientes B2B:** Decisores, diretores de TI/Operações e fundadores em busca de soluções corporativas de IA, agentes autônomos e automação de processos em escala.
- **Desenvolvedores e Ecossistema de IA:** Criadores de agentes autônomos e integradores buscando microsserviços e dados abertos (Grid402).
- **Parceiros e Investidores:** Interessados no portfólio de venture studio e produtos escaláveis da TCAI Corp.

## 5. Histórias de usuário
- **Como visitante corporativo**, quero entender com clareza quais soluções e produtos a TCAI Corp oferece, para avaliar contratações ou parcerias tecnológicas.
- **Como integrador de IA**, quero conhecer os detalhes e acessar o link direto para o Grid402, para integrar microsserviços sob HTTP 402 em meus agentes.
- **Como cliente potencial**, quero encontrar facilmente os canais de contato da empresa (WhatsApp comercial, e-mail institucional) para solicitar uma proposta.
- **Como usuário que acessa o link antigo**, quero ser redirecionado de forma transparente e imediata para o novo domínio corporativo `www.tcaicorp.online`.

## 6. Requisitos funcionais
| ID | Requisito | Prioridade |
|---|---|---|
| RF01 | Atualizar o Hero, menu e seções para narrativa 100% institucional ("TCAI Corp — Soluções Corporativas em Inteligência Artificial e Produtos Digitais B2B"). | Must |
| RF02 | Preservar a identidade visual (logo TC, paleta Sapphire Blue `#2563eb`, background dark `#090d16` e gradientes). | Must |
| RF03 | Atualizar os dados de contato no cabeçalho, rodapé e seções de contato (`contato@tcaicorp.online`, `(11) 95832-5848`, links do WhatsApp e redes). | Must |
| RF04 | Integrar o case e produto `www.grid402.online` à grade de soluções, com descrição da infraestrutura HTTP 402, métricas e link direto. | Must |
| RF05 | Atualizar dados estruturados Schema.org de `Person` para `Organization` e `WebSite`, com metadados da TCAI Corp. | Must |
| RF06 | Criar o website `tcaicorp.online` na Hostinger e realizar o deploy dos arquivos da nova versão corporativa. | Must |
| RF07 | Implementar o mecanismo de redirecionamento automático (Meta Refresh + JS + Canonical) no domínio antigo `thiagocampos.ai`. | Must |
| RF08 | Atualizar páginas secundárias (`privacidade.html`, `termos.html`) e arquivos agênticos (`llms.txt`, `llms-full.txt`, `sitemap.xml`, `robots.txt`). | Should |

## 7. Requisitos não funcionais
- **Performance:** Tempo de carregamento de página ultra-rápido (Core Web Vitals LCP < 1.5s), aproveitando assets estáticos sem dependência de build pesado.
- **Acessibilidade:** Conformidade WCAG AA com contraste adequado, semântica HTML e suporte a navegação por teclado e leitores de tela.
- **Responsividade:** Layout perfeitamente adaptado para desktop, tablets e smartphones (Tailwind CSS).
- **SEO e Rastreabilidade:** Metatags completas (title, description, canonical, OpenGraph, Twitter Cards, Schema.org Organization).

## 8. Fluxos e UX
- **Fluxo 1 (Novo Acesso Institucional):** Usuário acessa `www.tcaicorp.online` -> Visualiza proposta de valor corporativa no Hero -> Explora métricas e atuação -> Analisa os produtos (Grid402, Peça Match AI, etc.) -> Aciona contato via WhatsApp institucional ou e-mail.
- **Fluxo 2 (Redirecionamento do Legado):** Usuário acessa `thiagocampos.ai` -> Recebe instrução visual e script de redirecionamento 301/meta -> É direcionado imediatamente para `https://www.tcaicorp.online`.

## 9. Métricas de sucesso
- 100% das menções pessoais substituídas por posicionamento corporativo ("TCAI Corp").
- Novo website `www.tcaicorp.online` ativo com status 200 e certificado SSL na Hostinger.
- Redirecionamento funcional de `thiagocampos.ai` para `www.tcaicorp.online`.
- Presença destacada do `grid402.online` no catálogo com link ativo e funcionando.

## 10. Riscos, dependências e premissas
- **Dependência de DNS:** Propagação de DNS do domínio `tcaicorp.online` na Hostinger para ativação de SSL.
- **Preservação de tráfego:** O redirecionamento no domínio legado garante que backlinks e acessos prévios continuem sendo aproveitados pela nova marca.
- **Premissa:** As credenciais e MCP da Hostinger estão ativas e funcionais para criação e deploy do website.

## 11. Questões em aberto
- Nenhuma questão em aberto após a conclusão das rodadas de Grill-me.
