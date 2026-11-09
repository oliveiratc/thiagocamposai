# Design Tecnico: Rebranding Institucional TCAI Corp e Migracao Hostinger

## 1. Arquitetura da Solucao

A solucao adota uma arquitetura estatica de alta performance, sem dependencia de runtime de backend ou banco de dados no site institucional, garantindo tempo de resposta sub-segundo, seguranca elevada e custo operacional reduzido.

### Componentes Principais
1. **Frontend Corporativo (HTML5 + Tailwind CSS):**
   - Estrutura semantica com tags `header`, `nav`, `main`, `section`, `article` e `footer`.
   - Tailwind CSS via CDN com tokens de cores existentes (`primary-600: #2563eb`, `dark: #090d16`, `surface: #ffffff`).
   - Micro-animacoes e efeitos de scan de IA para manter o apelo moderno e tecnologico.
   - Design totalmente responsivo (mobile-first).

2. **Hospedagem Hostinger (tcaicorp.online):**
   - Criação do website adicional na conta Hostinger sob o domínio `tcaicorp.online`.
   - Deploy estático dos arquivos na pasta pública do servidor (`public_html`).
   - Ativação de SSL gratuito nativo da Hostinger (Let's Encrypt).

3. **Mecanismo de Redirecionamento do Legado (thiagocampos.ai):**
   - Redirecionamento em multiplas camadas no repositorio GitHub Pages atual:
     - Camada 1: `<meta http-equiv="refresh" content="0; url=https://www.tcaicorp.online/">`
     - Camada 2: Script JS imediato `window.location.replace("https://www.tcaicorp.online" + window.location.pathname);`
     - Camada 3: Tag `<link rel="canonical" href="https://www.tcaicorp.online/">` para manutencao de reputacao SEO
     - Camada 4: Link textual de fallback para navegadores sem execucao automatica.

4. **Metadados e Descoberta para LLMs e Motores de Busca:**
   - JSON-LD estruturado:
     - `@type: Organization`
     - `name: TCAI Corp`
     - `url: https://www.tcaicorp.online`
     - `logo: https://www.tcaicorp.online/logo-tc-transparente.png`
     - `contactPoint`: telefone `+55-11-95832-5848`, e-mail `contato@tcaicorp.online`, tipo `customer service`
   - Atualizacao completa de `llms.txt` e `llms-full.txt` apresentando os produtos e capacidades da TCAI Corp.

## 2. Modelagem do Produto Grid402 na Vitrine

O Grid402 sera integrado na secao de produtos e cases com as seguintes propriedades:
- **Titulo:** Grid402 — Hub de Microsservicos e Dados Abertos para Agentes de IA
- **Categoria:** Infraestrutura e Dados para IA Autonoma
- **Protocolo:** HTTP 402 com liquidacao em USDC na rede Base
- **Capacidades em Destaque:** Oraculos criptograficos, consultas cadastrais (CNPJ/CEP/Sanções), cotacoes em tempo real e SDKs em Python/TypeScript e servidor MCP.
- **Link Direto:** `https://grid402.online`
- **Badge:** "Tecnologia M2M e Agentes Autonomos"

## 3. Trade-offs e Decisoes Tecnicas
- **Hospedagem Estatica vs Dinamica:** Optou-se por manter o site institucional estatico na Hostinger por oferecer melhor tempo de carregamento (LCP < 1.0s), risco nulo de injecao de codigo e sem necessidade de manutencao de banco de dados.
- **Redirecionamento Hibrido no Legado:** A combinacao de Meta Refresh, Javascript e Canonical no GitHub Pages assegura que tanto usuarios quanto indexadores do Google e Bing transfiram autoridade imediatamente para o novo dominio sem falhas.

