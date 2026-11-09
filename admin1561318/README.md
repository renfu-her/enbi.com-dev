# admin1561318

Updated: 2026-11-09 14:40:50 CST (Asia/Taipei)

Back-office PHP for enbi. Short tags removed from `include/menu.php`. Upload handlers guard failed GD decodes. PDO uses DSN charset (no `MYSQL_ATTR_INIT_COMMAND`).

PDO credentials: reuse front `config.php` `$conn_*` when loaded first, otherwise copy `db.local.example.php` to gitignored `db.local.php`.
