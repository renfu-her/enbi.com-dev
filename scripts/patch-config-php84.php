<?php
/**
 * Patch local config.php for PHP 8.4 without touching DB/mail secrets.
 * Usage: php scripts/patch-config-php84.php
 */
$path = dirname(__DIR__) . '/config.php';
if (!is_file($path)) {
    fwrite(STDERR, "Missing config.php\n");
    exit(1);
}

$src = file_get_contents($path);
if ($src === false) {
    fwrite(STDERR, "Cannot read config.php\n");
    exit(1);
}

$bak = $path . '.bak-php84-' . date('YmdHis');
if (!copy($path, $bak)) {
    fwrite(STDERR, "Cannot write backup\n");
    exit(1);
}

$out = $src;
$out = preg_replace('/defined\s*\(\s*ROOT\s*\)/', "defined('ROOT')", $out);
$out = preg_replace('/defined\s*\(\s*libs\s*\)/', "defined('libs')", $out);
$out = preg_replace('/defined\s*\(\s*icld\s*\)/', "defined('icld')", $out);

// Old: if($_GET['debug'] == 'cldd')
$out = preg_replace(
    "/if\s*\(\s*\$_GET\s*\[\s*['\"]debug['\"]\s*\]\s*==\s*['\"]cldd['\"]\s*\)/",
    "if (isset(\$_GET['debug']) && \$_GET['debug'] == 'cldd')",
    $out
);

if ($out === $src) {
    echo "No changes needed (already patched?) backup={$bak}\n";
    exit(0);
}

if (file_put_contents($path, $out) === false) {
    fwrite(STDERR, "Cannot write config.php\n");
    exit(1);
}

echo "Patched config.php\n";
echo "Backup: {$bak}\n";
echo "Check: php -r \"\\\$ok=true; try { include 'config.php'; } catch (Throwable \\\$e) { \\\$ok=false; echo \\\$e->getMessage(), PHP_EOL; } echo \\\$ok ? 'LOAD_OK' : 'LOAD_FAIL', PHP_EOL;\"\n";
