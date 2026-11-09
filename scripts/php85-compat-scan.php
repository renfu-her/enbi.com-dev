<?php
/**
 * Scan PHP sources for common 7.1 -> 8.4/8.5 breakages.
 * Usage: php scripts/php85-compat-scan.php [root]
 */
$root = isset($argv[1]) ? $argv[1] : dirname(__DIR__);
$root = realpath($root);
if ($root === false) {
    fwrite(STDERR, "bad root\n");
    exit(1);
}

$skipDirs = array('.git', 'node_modules', 'vendor', 'tiny_mce', 'scripts');

$patterns = array(
    'each()' => '/(?<!->|::|\\.|\\$)\\beach\\s*\\(/',
    'create_function' => '/\\bcreate_function\\s*\\(/',
    'mysql_' => '/\\bmysql_[a-zA-Z_]+\\s*\\(/',
    'ereg' => '/\\bereg(i|_replace|_replace_i)?\\s*\\(/',
    'split()' => '/(?<![\\w$->])\\bsplit\\s*\\(/',
    'mcrypt_' => '/\\bmcrypt_[a-zA-Z_]+\\s*\\(/',
    'curly_offset' => '/\\$[a-zA-Z_][a-zA-Z0-9_]*\\s*\\{/',
    'FILTER_SANITIZE_STRING' => '/\\bFILTER_SANITIZE_STRING\\b/',
    'utf8_encode' => '/\\butf8_encode\\s*\\(/',
    'utf8_decode' => '/\\butf8_decode\\s*\\(/',
    'strftime' => '/\\bstrftime\\s*\\(/',
    'gmstrftime' => '/\\bgmstrftime\\s*\\(/',
    'money_format' => '/\\bmoney_format\\s*\\(/',
    'get_magic_quotes' => '/\\bget_magic_quotes_(gpc|runtime)\\s*\\(/',
    '__autoload' => '/\\bfunction\\s+__autoload\\s*\\(/',
    'assert_string' => '/\\bassert\\s*\\(\\s*[\'"]/',
);

$hits = array();
$counts = array();
foreach (array_keys($patterns) as $name) {
    $counts[$name] = 0;
}
$fileCount = 0;

$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);

foreach ($it as $file) {
    if (!$file->isFile()) {
        continue;
    }
    $path = $file->getPathname();
    $rel = str_replace('\\', '/', substr($path, strlen($root) + 1));
    $skip = false;
    foreach ($skipDirs as $d) {
        if ($rel === $d || strpos($rel, $d . '/') === 0) {
            $skip = true;
            break;
        }
    }
    if ($skip) {
        continue;
    }
    if (substr($rel, -4) !== '.php') {
        continue;
    }
    $fileCount++;
    $content = file_get_contents($path);
    if ($content === false) {
        continue;
    }
    $lines = explode("\n", $content);
    foreach ($patterns as $name => $re) {
        foreach ($lines as $i => $line) {
            if (!preg_match($re, $line)) {
                continue;
            }
            $trim = ltrim($line);
            if (strpos($trim, '//') === 0 || strpos($trim, '*') === 0 || strpos($trim, '#') === 0) {
                continue;
            }
            // Ignore jQuery .each( and JS-looking lines in PHP templates
            if ($name === 'each()' && preg_match('/\\$\\([\'"].*?[\'"]\\)\\.each\\s*\\(/', $line)) {
                continue;
            }
            if ($name === 'each()' && preg_match('/\\$\\([\'"]li[\'"]\\)\\.each/', $line)) {
                continue;
            }
            $counts[$name]++;
            $hits[] = array(
                'rule' => $name,
                'file' => $rel,
                'line' => $i + 1,
                'text' => rtrim($line),
            );
        }
    }
}

$nonzero = array();
foreach ($counts as $k => $v) {
    if ($v > 0) {
        $nonzero[$k] = $v;
    }
}

$summary = array(
    'root' => $root,
    'php_cli' => PHP_VERSION,
    'files_scanned' => $fileCount,
    'total_hits' => count($hits),
    'counts' => $nonzero,
);

echo json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
echo "---\n";
foreach ($hits as $h) {
    echo $h['rule'] . "\t" . $h['file'] . ':' . $h['line'] . "\t" . $h['text'] . "\n";
}
