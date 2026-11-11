<?php
/**
 * Script de Verificação Automatizada — Comunicação Executiva (Dupla Camada) e Blog Diário SEO
 * Valida todos os cenários da spec OpenSpec `add-investor-clarity-and-seo-blog`.
 */

declare(strict_types=1);

$rootDir = dirname(__DIR__);
$errors = [];
$passed = 0;

function assertCheck(bool $condition, string $label, array &$errors, int &$passed): void {
    if ($condition) {
        $passed++;
        echo "[PASS] {$label}\n";
    } else {
        $errors[] = $label;
        echo "[FAIL] {$label}\n";
    }
}

echo "=== Verificando Camada Executiva e Ficha Técnica em index.html ===\n";
$indexHtml = file_get_contents($rootDir . '/index.html');
assertCheck($indexHtml !== false, 'Leitura de index.html', $errors, $passed);

// Remove blocos <details> de ficha técnica e o bloco <script> de traduções para inspecionar a camada primária visível do HTML
$htmlWithoutScript = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $indexHtml);
$primaryVisibleHtml = preg_replace('/<details\b[^>]*>.*?<\/details>/is', '', $htmlWithoutScript);

assertCheck(
    stripos($primaryVisibleHtml, 'Acurácia F1 em Backtest') === false,
    'Camada primária visível de index.html NÃO exibe "Acurácia F1 em Backtest"',
    $errors,
    $passed
);
assertCheck(
    stripos($primaryVisibleHtml, 'Assertividade Comprovada na Prática') !== false,
    'Camada primária visível de index.html exibe "Assertividade Comprovada na Prática"',
    $errors,
    $passed
);
assertCheck(
    substr_count($indexHtml, 'data-i18n="tech_drawer_btn"') >= 6,
    'Todos os cases em index.html possuem gaveta expansível de Ficha Técnica (<details>)',
    $errors,
    $passed
);
assertCheck(
    stripos($indexHtml, 'F1-Score de 92.4% em backtest') !== false || stripos($indexHtml, 'F1-Score de 92.4%') !== false,
    'Métrica técnica F1-Score de 92.4% preservada dentro da Ficha Técnica para TI/Devs',
    $errors,
    $passed
);
assertCheck(
    stripos($indexHtml, 'id="blog-insights"') !== false,
    'Seção #blog-insights presente na página inicial index.html',
    $errors,
    $passed
);

echo "\n=== Verificando Portal /blog/ e Catálogo posts.json ===\n";
$blogIndex = file_get_contents($rootDir . '/blog/index.html');
assertCheck($blogIndex !== false, 'Existência de blog/index.html', $errors, $passed);
assertCheck(stripos($blogIndex, '"@type": "Blog"') !== false, 'Schema.org Blog em blog/index.html', $errors, $passed);

$postsJsonRaw = file_get_contents($rootDir . '/blog/posts.json');
$postsData = json_decode((string)$postsJsonRaw, true);
$postsList = isset($postsData['posts']) ? $postsData['posts'] : (is_array($postsData) ? $postsData : []);
assertCheck(count($postsList) >= 6, 'blog/posts.json válido com pelo menos 6 artigos iniciais', $errors, $passed);

foreach ($postsList as $post) {
    $filePath = $rootDir . '/blog/' . $post['slug'] . '.html';
    $exists = file_exists($filePath);
    assertCheck($exists, "Artigo físico existe: blog/{$post['slug']}.html", $errors, $passed);
    if ($exists) {
        $artHtml = (string)file_get_contents($filePath);
        assertCheck(
            stripos($artHtml, '"@type": "BlogPosting"') !== false,
            "Schema.org BlogPosting presente em {$post['slug']}.html",
            $errors,
            $passed
        );
        assertCheck(
            stripos($artHtml, '#contato') !== false || stripos($artHtml, '#projetos') !== false || stripos($artHtml, 'vailotar.com.br') !== false || stripos($artHtml, 'pecamatchai.com.br') !== false || stripos($artHtml, 'rankproseo.com.br') !== false || stripos($artHtml, 'grid402.online') !== false,
            "Card de CTA para solução TCAI Corp presente em {$post['slug']}.html",
            $errors,
            $passed
        );
    }
}

echo "\n=== Verificando Sitemap, llms.txt, .env.example e Publicador Autônomo ===\n";
$sitemap = (string)file_get_contents($rootDir . '/sitemap.xml');
assertCheck(stripos($sitemap, 'https://www.tcaicorp.online/blog/') !== false, 'sitemap.xml inclui /blog/', $errors, $passed);
assertCheck(
    stripos($sitemap, 'o-que-e-backtest-e-precisao-preditiva-em-ia-para-negocios.html') !== false,
    'sitemap.xml inclui os artigos do blog',
    $errors,
    $passed
);

$llmsTxt = (string)file_get_contents($rootDir . '/llms.txt');
assertCheck(stripos($llmsTxt, 'https://www.tcaicorp.online/blog/') !== false, 'llms.txt referencia o Blog & Insights', $errors, $passed);

assertCheck(file_exists($rootDir . '/.env.example'), '.env.example existe na raiz', $errors, $passed);
assertCheck(file_exists($rootDir . '/blog/topics_queue.json'), 'blog/topics_queue.json existe', $errors, $passed);
assertCheck(file_exists($rootDir . '/blog/cron_publish.php'), 'blog/cron_publish.php existe', $errors, $passed);

echo "\nResumo: {$passed} verificações aprovadas, " . count($errors) . " falhas.\n";
exit(count($errors) === 0 ? 0 : 1);
