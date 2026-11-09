# Rebranding Institucional TCAI Corp e Migracao para www.tcaicorp.online

## Por que
O site atualmente publicado opera como um portfolio profissional e executivo sob o dominio `thiagocampos.ai`. Com o lancamento e a maturidade de multiplos produtos digitais B2B (Peca Match AI, RankPro SEO, VaiLotar e o ecossistema Grid402), e necessario posicionar a organizacao como uma empresa de tecnologia, produtos e infraestrutura corporativa: a **TCAI Corp**. O PRD aprovado em `openspec/prds/rebranding-tcai-corp.md` orienta esta transformacao.

## O que muda
- **Identidade e Layout Institucional:** O site passa a ter narrativa e tom 100% corporativo ("Nos"), com a marca "TCAI Corp — Solucoes Corporativas em Inteligencia Artificial e Produtos Digitais B2B", mantendo o logotipo TC e a paleta de cores original.
- **Novos Canais Oficiais:** Atualizacao de todos os pontos de contato para o site `www.tcaicorp.online`, e-mail `contato@tcaicorp.online`, telefone e WhatsApp `(11) 95832-5848`.
- **Inclusao do Grid402:** Adicao do produto `www.grid402.online` na vitrine de solucoes da empresa (hub de microsservicos e dados abertos para agentes autonomos sob HTTP 402 com liquidacao USDC na rede Base).
- **Hospedagem Hostinger:** Provisionamento e publicacao do website `tcaicorp.online` no servidor CloudLinux da Hostinger.
- **Redirecionamento do Dominio Legado:** Implementacao de redirecionamento automatico e transparente de `thiagocampos.ai` para `https://www.tcaicorp.online`.
- **Metadados e IA:** Atualizacao de Schema.org para `Organization`, OpenGraph, Twitter Cards, `sitemap.xml`, `robots.txt`, `llms.txt`, `llms-full.txt`, `termos.html` e `privacidade.html`.

## Impacto
- Specs afetadas: `institucional`
- Codigo afetado:
  - `index.html` (layout principal, hero, secoes, metricas, contato, Schema.org)
  - `privacidade.html` e `termos.html` (dados corporativos da TCAI Corp)
  - `sitemap.xml`, `robots.txt`, `llms.txt`, `llms-full.txt` (URLs e dados institucionais)
  - Repositorio GitHub Pages (index de redirecionamento para thiagocampos.ai)
  - Hostinger Hosting (criacao e publicacao do site tcaicorp.online)

