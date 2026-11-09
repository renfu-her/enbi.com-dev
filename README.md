# enbi

Updated: 2026-11-09 14:40:50 CST (Asia/Taipei)

Classic PHP storefront and admin (`admin1561318`) targeting PHP 8.4 / 8.5 (formerly 7.1).

Copy `config.example.php` to `config.php` and fill local DB/mail settings. `config.php` is gitignored and must not be committed. Admin-only PDO pages can use `admin1561318/db.local.php` (also gitignored).

Smoke: `php scripts/db-smoke.php` then `php scripts/page-smoke.php`.
