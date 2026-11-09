<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '0');

$_SERVER['HTTPS'] = 'on';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['QUERY_STRING'] = '';
$_GET = array();
$_POST = array();
$_REQUEST = array();
$_SESSION = array();

$root = dirname(__DIR__);
$pages = array(
    'index.php' => array(),
    'news.php' => array(),
    'products.php' => array(),
    'stores.php' => array(),
    'storelist.php' => array('a' => '1'),
    'search.php' => array('s' => 'a'),
    'story.php' => array(),
    'service.php' => array(),
    'unboxing.php' => array(),
);

function run_page($root, $page, $get)
{
    $cmd = array(
        PHP_BINARY,
        '-d', 'display_errors=1',
        '-d', 'error_reporting=E_ALL',
        '-r',
        '$code=file_get_contents($argv[1]);'
        . '$_SERVER["HTTPS"]="on";'
        . '$_SERVER["HTTP_HOST"]="localhost";'
        . '$_SERVER["SERVER_NAME"]="localhost";'
        . '$_SERVER["REQUEST_URI"]="/".$argv[2];'
        . '$_SERVER["REMOTE_ADDR"]="127.0.0.1";'
        . '$_SERVER["QUERY_STRING"]=$argv[3];'
        . 'parse_str($argv[3], $_GET);'
        . '$_REQUEST=$_GET; $_POST=array();'
        . 'chdir(dirname($argv[1]));'
        . 'ob_start();'
        . 'try { include $argv[1]; $out=ob_get_clean();'
        . 'file_put_contents("php://stdout", "STATUS=OK bytes=".strlen($out)."\\n");'
        . 'if (preg_match("/Fatal error|Parse error|Uncaught /", $out)) {'
        . '  file_put_contents("php://stderr", substr($out,0,500)."\\n"); exit(3); }'
        . '} catch (Throwable $e) {'
        . '  ob_end_clean();'
        . '  file_put_contents("php://stderr", $e->getMessage()." @ ".$e->getFile().":".$e->getLine()."\\n");'
        . '  exit(2); }',
        $root . DIRECTORY_SEPARATOR . $page,
        $page,
        http_build_query($get),
    );

    $descriptors = array(
        0 => array('pipe', 'r'),
        1 => array('pipe', 'w'),
        2 => array('pipe', 'w'),
    );
    $proc = proc_open($cmd, $descriptors, $pipes, $root);
    if (!is_resource($proc)) {
        return array(1, '', 'proc_open failed');
    }
    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $code = proc_close($proc);
    return array($code, trim($stdout), trim($stderr));
}

$failed = 0;
foreach ($pages as $page => $get) {
    list($code, $out, $err) = run_page($root, $page, $get);
    $ok = ($code === 0 && strpos($out, 'STATUS=OK') === 0);
    echo ($ok ? 'PASS' : 'FAIL') . "\t" . $page . "\t" . $out;
    if ($err !== '') {
        echo "\tERR=" . str_replace(array("\r", "\n"), ' ', substr($err, 0, 240));
    }
    echo "\n";
    if (!$ok) {
        $failed++;
    }
}

// content pages need ids from DB
require $root . '/config.php';
$news = $obj_news->fetchAll_join('*', ' order by pkey DESC limit 1');
$prod = $obj_products->fetchAll_join('*', ' order by pkey DESC limit 1');
if (!empty($news[0]['pkey'])) {
    list($code, $out, $err) = run_page($root, 'news-content.php', array('p' => $news[0]['pkey']));
    $ok = ($code === 0 && strpos($out, 'STATUS=OK') === 0);
    echo ($ok ? 'PASS' : 'FAIL') . "\tnews-content.php?p=" . $news[0]['pkey'] . "\t" . $out;
    if ($err !== '') {
        echo "\tERR=" . str_replace(array("\r", "\n"), ' ', substr($err, 0, 240));
    }
    echo "\n";
    if (!$ok) {
        $failed++;
    }
}
if (!empty($prod[0]['pkey'])) {
    list($code, $out, $err) = run_page($root, 'products-content.php', array('p' => $prod[0]['pkey']));
    $ok = ($code === 0 && strpos($out, 'STATUS=OK') === 0);
    echo ($ok ? 'PASS' : 'FAIL') . "\tproducts-content.php?p=" . $prod[0]['pkey'] . "\t" . $out;
    if ($err !== '') {
        echo "\tERR=" . str_replace(array("\r", "\n"), ' ', substr($err, 0, 240));
    }
    echo "\n";
    if (!$ok) {
        $failed++;
    }
}

// admin login page shell
list($code, $out, $err) = run_page($root, 'admin1561318/index.php', array());
$ok = ($code === 0 && strpos($out, 'STATUS=OK') === 0);
echo ($ok ? 'PASS' : 'FAIL') . "\tadmin1561318/index.php\t" . $out;
if ($err !== '') {
    echo "\tERR=" . str_replace(array("\r", "\n"), ' ', substr($err, 0, 240));
}
echo "\n";
if (!$ok) {
    $failed++;
}

echo $failed === 0 ? "SMOKE_PAGES=PASS\n" : "SMOKE_PAGES=FAIL count={$failed}\n";
exit($failed === 0 ? 0 : 1);
