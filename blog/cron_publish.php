<?php
/**
 * TCAI Corp — Motor 100% Autônomo de Publicação Diária de Conteúdo SEO (Topo e Meio de Funil)
 *
 * Como configurar no Cron Job da Hostinger (1x por dia):
 *   php /home/u596682454/domains/tcaicorp.online/public_html/blog/cron_publish.php
 *
 * Ou via requisição HTTP autenticada com o token definido no arquivo .env:
 *   https://www.tcaicorp.online/blog/cron_publish.php?token=SEU_BLOG_CRON_SECRET
 */

declare(strict_types=1);

$blogDir = __DIR__;
$rootDir = dirname(__DIR__);

// 1. Carregador simples e seguro de variáveis de ambiente (.env)
function tcai_load_env(string $envPath): array
{
    $vars = [];
    if (!is_file($envPath)) {
        return $vars;
    }
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return $vars;
    }
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $val] = explode('=', $line, 2);
        $vars[trim($key)] = trim(trim($val), "\"'");
    }
    return $vars;
}

$env = array_merge(
    tcai_load_env($rootDir . '/.env'),
    tcai_load_env($blogDir . '/.env')
);

$geminiApiKey = $env['GEMINI_API_KEY'] ?? getenv('GEMINI_API_KEY') ?: '';
$cronSecret   = $env['BLOG_CRON_SECRET'] ?? getenv('BLOG_CRON_SECRET') ?: '';

// 2. Verificação estrita de segurança: apenas CLI (Cron da Hostinger) ou token válido
$isCli = (PHP_SAPI === 'cli');
if (!$isCli) {
    $providedToken = $_GET['token'] ?? $_SERVER['HTTP_X_CRON_TOKEN'] ?? '';
    if ($cronSecret === '' || !hash_equals($cronSecret, (string) $providedToken)) {
        http_response_code(403);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status'  => 'error',
            'message' => 'Acesso negado (403 Forbidden). Este endpoint é exclusivo para o Cron Job diário autenticado.'
        ], JSON_UNESCAPED_UNICODE);
        exit(1);
    }
}

// 3. Escrita atômica com flock (Zero-DB)
function tcai_atomic_write(string $path, string $content): bool
{
    $tmp = $path . '.tmp.' . getmypid();
    if (file_put_contents($tmp, $content, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, $path);
}

$postsFile = $blogDir . '/posts.json';
$queueFile = $blogDir . '/topics_queue.json';

$posts = is_file($postsFile) ? json_decode((string) file_get_contents($postsFile), true) : [];
$queue = is_file($queueFile) ? json_decode((string) file_get_contents($queueFile), true) : [];

if (!is_array($posts)) {
    $posts = [];
}
if (!is_array($queue)) {
    $queue = [];
}

// Modo dry-run para verificação de saúde nos testes
$dryRun = ($isCli && in_array('--dry-run', $argv ?? [], true)) || (isset($_GET['dry_run']) && $_GET['dry_run'] === '1');

// 4. Selecionar o próximo tópico inédito da fila
$selectedIndex = null;
$selectedTopic = null;
$existingSlugs = array_column($posts, 'slug');

foreach ($queue as $idx => $item) {
    if (empty($item['published']) && !in_array($item['slug'], $existingSlugs, true)) {
        $selectedIndex = $idx;
        $selectedTopic = $item;
        break;
    }
}

// Caso todas as pautas da fila já tenham sido publicadas, cria uma nova pauta cíclica datada
if ($selectedTopic === null) {
    $dateSuffix = date('Y-m-d');
    $selectedTopic = [
        'slug'            => 'panorama-executiva-ia-e-eficiencia-b2b-' . $dateSuffix,
        'title'           => 'Panorama Executivo (' . date('d/m/Y') . '): Como empresas B2B estão protegendo margens com Inteligência Artificial prática',
        'excerpt'         => 'Análise atualizada sobre redução de custos operacionais, previsão antecipada de receitas e blindagem fiscal sem jargões técnicos.',
        'category'        => 'IA Corporativa & Agentes Autônomos',
        'category_slug'   => 'ia-agentes',
        'funnel_stage'    => 'Topo de Funil',
        'funnel_slug'     => 'topo',
        'read_time'       => '5 min de leitura',
        'related_product' => 'Portfólio TCAI Corp',
        'related_url'     => 'https://www.tcaicorp.online/#projetos',
        'tldr'            => 'A adoção executiva de Inteligência Artificial deixou de ser experimental: o foco de investidores e diretores agora está em soluções que reduzem despesas operacionais (OPEX), protegem créditos tributários e antecipam a demanda comercial.',
        'keywords'        => ['inteligência artificial b2b', 'eficiência operacional', 'retorno sobre investimento ia', 'tcai corp'],
        'published'       => false
    ];
}

// 5. Geração do corpo do artigo: Gemini API (se configurada) + Fallback Editorial Estruturado
function tcai_generate_article_body(array $topic, string $apiKey): string
{
    if ($apiKey !== '' && function_exists('curl_init')) {
        $prompt = "Você é um conselheiro executivo B2B da TCAI Corp escrevendo para investidores, CEOs, diretores financeiros e gestores (evite jargões técnicos sem explicação).\n"
            . "Escreva o conteúdo interno em HTML semântico (apenas tags <p>, <h2 class=\"text-2xl font-black text-slate-900 pt-4\">, <ul class=\"list-disc pl-6 space-y-2 text-base\">, <li>, <strong>) para o artigo:\n"
            . "Título: {$topic['title']}\n"
            . "Categoria: {$topic['category']} ({$topic['funnel_stage']})\n"
            . "Produto relacionado da TCAI Corp: {$topic['related_product']} ({$topic['related_url']})\n"
            . "Estruture em 3 seções claras focadas em dor de negócio, retorno financeiro (ROI) e passos práticos.";

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . urlencode($apiKey);
        $payload = json_encode([
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ],
            'generationConfig' => [
                'temperature'     => 0.5,
                'maxOutputTokens' => 1800
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 25
        ]);
        $resp = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code === 200 && is_string($resp)) {
            $json = json_decode($resp, true);
            $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $text = trim(preg_replace('/^```html|```$/m', '', (string) $text));
            if (strlen($text) > 300) {
                return $text;
            }
        }
    }

    // Fallback Editorial Estruturado (garante que o Cron nunca falhe mesmo sem API key)
    $title   = htmlspecialchars($topic['title'], ENT_QUOTES, 'UTF-8');
    $product = htmlspecialchars($topic['related_product'], ENT_QUOTES, 'UTF-8');
    $url     = htmlspecialchars($topic['related_url'], ENT_QUOTES, 'UTF-8');
    $cat     = htmlspecialchars($topic['category'], ENT_QUOTES, 'UTF-8');

    return <<<HTML
            <p>
                No cenário competitivo atual de <strong>{$cat}</strong>, diretores, gestores e investidores enfrentam um desafio comum: como transformar dados operacionais dispersos em decisões que protejam o caixa e aumentem a margem de lucro sem adicionar complexidade para a equipe.
            </p>

            <h2 class="text-2xl font-black text-slate-900 pt-4">1. O custo oculto da tomada de decisão manual</h2>
            <p>
                Quando processos críticos dependem exclusivamente de planilhas manuais, intuição ou conferência por amostragem, a empresa fica exposta a desperdícios silenciosos — seja comprando estoque na hora errada, perdendo créditos fiscais legítimos ou deixando veículos e equipes ociosos.
            </p>
            <ul class="list-disc pl-6 space-y-2 text-base">
                <li><strong>Falta de Previsibilidade:</strong> Dificuldade para antecipar picos de demanda ou gargalos operacionais com semanas de antecedência.</li>
                <li><strong>Erosão de Margem:</strong> Custos extras com retrabalho, devoluções, horas extras desnecessárias ou impostos pagos a maior.</li>
                <li><strong>Lentidão na Resposta Comercial:</strong> Tempo excessivo gasto em tarefas burocráticas em vez de atender o cliente final.</li>
            </ul>

            <h2 class="text-2xl font-black text-slate-900 pt-4">2. Como a Inteligência Artificial aplicada a negócios resolve essa dor</h2>
            <p>
                Diferente de projetos teóricos de tecnologia, a abordagem da <strong>TCAI Corp</strong> por meio da solução <a href="{$url}" class="text-primary-600 font-bold underline">{$product}</a> foca diretamente no indicador financeiro da operação:
            </p>
            <ol class="list-decimal pl-6 space-y-2 text-base">
                <li><strong>Tradução de Dados em Ação Prática:</strong> O sistema analisa milhares de variáveis nos bastidores, mas entrega ao gestor uma recomendação simples e direta.</li>
                <li><strong>Validação Comprovada na Prática:</strong> Todas as recomendações são testadas contra o histórico real da operação antes de entrarem em produção.</li>
                <li><strong>Retorno sobre Investimento (ROI) Rápido:</strong> Implementação como serviço (SaaS B2B ou pagamento por uso) que se paga pela própria economia gerada.</li>
            </ol>

            <h2 class="text-2xl font-black text-slate-900 pt-4">3. Próximos passos para decisores</h2>
            <p>
                Empresas que saem na frente na adoção de inteligência operacional criam uma vantagem difícil de ser copiada pelos concorrentes: custos menores, atendimento mais veloz e balanço financeiro previsível.
            </p>
HTML;
}

if ($dryRun) {
    $result = [
        'status'     => 'dry_run_ok',
        'next_topic' => $selectedTopic['slug'],
        'title'      => $selectedTopic['title']
    ];
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
    exit(0);
}

$today       = date('Y-m-d');
$bodyContent = tcai_generate_article_body($selectedTopic, $geminiApiKey);

$slug        = $selectedTopic['slug'];
$title       = htmlspecialchars($selectedTopic['title'], ENT_QUOTES, 'UTF-8');
$excerpt     = htmlspecialchars($selectedTopic['excerpt'], ENT_QUOTES, 'UTF-8');
$category    = htmlspecialchars($selectedTopic['category'], ENT_QUOTES, 'UTF-8');
$funnelStage = htmlspecialchars($selectedTopic['funnel_stage'], ENT_QUOTES, 'UTF-8');
$readTime    = htmlspecialchars($selectedTopic['read_time'], ENT_QUOTES, 'UTF-8');
$tldr        = htmlspecialchars($selectedTopic['tldr'], ENT_QUOTES, 'UTF-8');
$product     = htmlspecialchars($selectedTopic['related_product'], ENT_QUOTES, 'UTF-8');
$productUrl  = htmlspecialchars($selectedTopic['related_url'], ENT_QUOTES, 'UTF-8');

$articleHtml = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title} | TCAI Corp</title>
    <meta name="description" content="{$excerpt}">
    <link rel="canonical" href="https://www.tcaicorp.online/blog/{$slug}.html">

    <meta property="og:type" content="article">
    <meta property="og:url" content="https://www.tcaicorp.online/blog/{$slug}.html">
    <meta property="og:title" content="{$title}">
    <meta property="og:description" content="{$excerpt}">
    <meta property="og:image" content="https://www.tcaicorp.online/logo-tc.jpg">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "BlogPosting",
          "headline": "{$title}",
          "description": "{$excerpt}",
          "datePublished": "{$today}",
          "dateModified": "{$today}",
          "author": { "@type": "Organization", "name": "TCAI Corp", "url": "https://www.tcaicorp.online/" },
          "publisher": {
            "@type": "Organization",
            "name": "TCAI Corp",
            "logo": { "@type": "ImageObject", "url": "https://www.tcaicorp.online/logo-tc-transparente.png" }
          },
          "mainEntityOfPage": "https://www.tcaicorp.online/blog/{$slug}.html"
        }
      ]
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: { 50: '#eff6ff', 100: '#dbeafe', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af' } },
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'], display: ['Outfit', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-[#fcfdfe] text-slate-800 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-20 items-center">
            <a href="../index.html" class="flex items-center gap-3">
                <img src="../logo-tc-vibrante.png" alt="TCAI Corp" class="h-11 w-auto">
            </a>
            <div class="flex items-center gap-3 text-xs sm:text-sm font-bold">
                <a href="index.html" class="text-slate-600 hover:text-primary-600 px-3 py-2 rounded-lg"><i class="fa-solid fa-arrow-left mr-1"></i> Todos os Artigos</a>
                <a href="../index.html#contato" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl shadow-sm">Falar com Especialista</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="flex flex-wrap items-center gap-2 text-xs font-bold mb-4">
            <span class="px-3 py-1 rounded-full bg-blue-100 text-primary-700 uppercase">{$funnelStage}</span>
            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700">{$category}</span>
            <span class="text-slate-400 font-medium ml-auto">{$readTime}</span>
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-6">
            {$title}
        </h1>

        <div class="bg-blue-50/80 border-l-4 border-primary-600 p-6 rounded-r-2xl mb-10">
            <h2 class="text-xs font-extrabold uppercase tracking-wider text-primary-800 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-briefcase"></i> Resumo Executivo (Para Investidores e Decisores B2B)
            </h2>
            <p class="text-sm sm:text-base text-slate-700 leading-relaxed">
                {$tldr}
            </p>
        </div>

        <div class="prose prose-slate max-w-none space-y-6 text-slate-700 text-base sm:text-lg leading-relaxed">
{$bodyContent}
        </div>

        <div class="mt-12 p-8 rounded-3xl bg-gradient-to-br from-slate-900 to-blue-950 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-cyan-300 block mb-2">Solução Relacionada • {$product}</span>
                <h3 class="text-2xl font-black mb-2">Quer aplicar essa eficiência na sua empresa?</h3>
                <p class="text-sm text-slate-300 max-w-xl">
                    Conheça a solução {$product} da TCAI Corp ou fale diretamente com nossos especialistas em Inteligência Artificial B2B.
                </p>
            </div>
            <div class="flex flex-wrap gap-3 flex-shrink-0">
                <a href="{$productUrl}" class="bg-primary-600 hover:bg-primary-500 text-white px-6 py-3.5 rounded-xl font-bold text-sm shadow-md transition-all">
                    Conhecer {$product} <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white py-10 border-t border-slate-800 mt-16 text-center text-xs text-slate-400">
        <p>© 2026 TCAI Corp • <a href="index.html" class="text-primary-400 hover:underline">Voltar para Blog & Insights</a> • <a href="../index.html" class="text-primary-400 hover:underline">Portal Institucional</a></p>
    </footer>
</body>
</html>
HTML;

// 6. Salvar HTML do novo artigo e atualizar posts.json e topics_queue.json
$articlePath = $blogDir . '/' . $slug . '.html';
tcai_atomic_write($articlePath, $articleHtml);

$newPostEntry = [
    'slug'            => $slug,
    'title'           => $selectedTopic['title'],
    'excerpt'         => $selectedTopic['excerpt'],
    'category'        => $selectedTopic['category'],
    'category_slug'   => $selectedTopic['category_slug'],
    'funnel_stage'    => $selectedTopic['funnel_stage'],
    'funnel_slug'     => $selectedTopic['funnel_slug'],
    'published_at'    => $today,
    'read_time'       => $selectedTopic['read_time'],
    'related_product' => $selectedTopic['related_product'],
    'related_url'     => $selectedTopic['related_url'],
    'keywords'        => $selectedTopic['keywords'] ?? []
];

array_unshift($posts, $newPostEntry);
tcai_atomic_write($postsFile, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

if ($selectedIndex !== null && isset($queue[$selectedIndex])) {
    $queue[$selectedIndex]['published']    = true;
    $queue[$selectedIndex]['published_at'] = $today;
    tcai_atomic_write($queueFile, json_encode($queue, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// 7. Atualizar automaticamente o sitemap.xml na raiz com todas as URLs do blog
$sitemapPath = $rootDir . '/sitemap.xml';
if (is_file($sitemapPath)) {
    $sitemapXml = (string) file_get_contents($sitemapPath);
    $newUrlLoc  = "https://www.tcaicorp.online/blog/{$slug}.html";
    if (!str_contains($sitemapXml, $newUrlLoc)) {
        $entryXml = "  <url>\n"
            . "    <loc>{$newUrlLoc}</loc>\n"
            . "    <lastmod>{$today}</lastmod>\n"
            . "    <changefreq>monthly</changefreq>\n"
            . "    <priority>0.8</priority>\n"
            . "  </url>\n</urlset>";
        $sitemapXml = str_replace('</urlset>', $entryXml, $sitemapXml);
        tcai_atomic_write($sitemapPath, $sitemapXml);
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'status'       => 'published',
    'slug'         => $slug,
    'url'          => "https://www.tcaicorp.online/blog/{$slug}.html",
    'published_at' => $today
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;

