# scripts

Updated: 2026-11-09 15:31:02 CST (Asia/Taipei)

PHP 8.4/8.5 upgrade helpers for the enbi classic PHP site.

- `php85-compat-scan.php`: scan for removed APIs and curly-brace offsets. Run `php scripts/php85-compat-scan.php`.
- `find-old-ctors.py`: list PHP4-style constructors still named like the class. Run `python scripts/find-old-ctors.py`.
- `db-smoke.php`: verify MyDB against local `config.php`. Run `php scripts/db-smoke.php`.
- `page-smoke.php`: render key front/admin pages and fail on Fatal/TypeError. Run `php scripts/page-smoke.php`.
- `patch-config-php84.php`: quote `defined('ROOT'|'libs'|'icld')` in local `config.php` before switching the host to PHP 8.4. Run `php scripts/patch-config-php84.php`.
