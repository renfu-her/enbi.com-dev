<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$_SERVER['HTTPS'] = 'on';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['SERVER_NAME'] = 'localhost';

require dirname(__DIR__) . '/config.php';

$ref = new ReflectionClass('MyDB');
$prop = $ref->getProperty('mysqli');
$m = $prop->getValue($mydb);

if (!($m instanceof mysqli)) {
    fwrite(STDERR, "CONNECT=fail\n");
    exit(2);
}

echo "CONNECT=ok\n";
echo "host_info=" . $m->host_info . "\n";

$r = $m->query('SELECT DATABASE() AS db, USER() AS u');
$row = $r ? $r->fetch_assoc() : null;
echo 'db=' . ($row['db'] ?? '') . ' user=' . ($row['u'] ?? '') . "\n";

$r = $m->query('SHOW TABLES');
$tables = array();
while ($r && ($row = $r->fetch_array())) {
    $tables[] = $row[0];
}
echo 'tables=' . count($tables) . "\n";

$needed = array('c_banner', 'c_news', 'c_products', 'c_store', 'c_admin', 'c_category', 'c_contact');
foreach ($needed as $t) {
    if (!in_array($t, $tables, true)) {
        echo $t . "=MISSING\n";
        continue;
    }
    $q = $m->query('SELECT COUNT(*) AS c FROM `' . $t . '`');
    $c = ($q && ($row = $q->fetch_assoc())) ? $row['c'] : 'err';
    echo $t . '=' . $c . "\n";
}

$b = $obj_banner->fetchAll_join('*', ' order by sort DESC limit 3');
echo 'banner_fetch=' . (is_array($b) ? count($b) : 'bad') . "\n";

$p = $obj_products->fetchAll_join('*', ' order by createdate DESC limit 3');
echo 'products_fetch=' . (is_array($p) ? count($p) : 'bad') . "\n";

echo "SMOKE_DB=PASS\n";
