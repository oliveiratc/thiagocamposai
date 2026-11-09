# Instrucoes para Redirecionamento do Dominio Legado (thiagocampos.ai)

Para garantir que qualquer pessoa ou robô que acesse `thiagocampos.ai` seja permanentemente redirecionado para `https://www.tcaicorp.online`, foram configuradas duas abordagens:

## 1. Redirecionamento Automatico pelo Repositorio Atual
O script de redirecionamento foi incorporado diretamente no `<head>` das páginas (`index.html`, `privacidade.html`, `termos.html`). Se a requisição chegar através do hostname `thiagocampos.ai`, o navegador redireciona instantaneamente para `https://www.tcaicorp.online` preservando a rota e parâmetros.

## 2. Redirecionamento no Registrador DNS ou Cloudflare (Recomendado para HTTP 301 Permanente)
Se o domínio `thiagocampos.ai` for gerenciado na Cloudflare ou em registrador com suporte a URL Forwarding:
1. Acesse a zona DNS de `thiagocampos.ai`.
2. Em **Page Rules** ou **Redirect Rules**, crie uma regra:
   - Origem: `*thiagocampos.ai/*`
   - Tipo de Redirecionamento: `301 - Permanent Redirect`
   - Destino: `https://www.tcaicorp.online/$2`
Isso garante transferência total de autoridade SEO de ponta a ponta.

