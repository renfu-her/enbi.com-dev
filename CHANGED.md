# CHANGED

## 2026-11-09 12:27:31 CST (Asia/Taipei)

Follow-up from front/admin/libs PHP 8.5 inventory agents.

- `storelist.php`: short tags → `<?php`; guard empty area; redirect target `stores.php`.
- `admin1561318/include/menu.php`: short tags → `<?php if`; isset on `$_GET['ct']` / session.
- `admin1561318/common.func.php` (+ copy): DSN `charset=utf8` instead of deprecated `PDO::MYSQL_ATTR_INIT_COMMAND`; safer HTTPS/host isset.
- Upload `*_ok.php` (banner/unboxing add+edit): refuse `imagesx(false)` after failed GD decode; null-safe upload filename.
- `libs/func.php` `safe()`: recursive for nested arrays / null.
- Admin login path: isset/`empty` for `AdminLogin`, `logout`, switch `ct`.
- `send_contact.php`, `unboxing.php`, list pages: null/undefined guards.

## 2026-11-09 12:25:08 CST (Asia/Taipei)

PHP 7.1 → 8.4/8.5 compatibility bootstrap (poteto figure-it-out Phase C units A–C).

- `config.php`: quote `defined('ROOT'|'libs'|'icld')`; guard `$_GET['debug']` with `isset`.
- `libs/MyDB.php`: `__construct`; mysqli link args for escape/insert_id/close; replace removed `mysqli_field_name` with `mysqli_fetch_field_direct`; drop `get_magic_quotes_gpc`.
- `libs/SimpleSQL.php`, `libs/page.php`, `libs/pageAD.php`, `libs/excel_reader2.php`: PHP4-style constructors → `__construct` (required on PHP 8.5).
- `libs/excel_reader2.php`: `split()` → `explode()`; remove illegal `=& new`.
- `libs/func.php`: always-escape `safe()`; no-op `strip_magic_slashes`; fix `send_mail` optional-before-required params.
- `admin1561318/cke.php`: remove `get_magic_quotes_gpc`.
- `libs/Mobile_Detect.php`: explicit `?array` nullable constructor param.
- Added `scripts/php85-compat-scan.php` and `scripts/find-old-ctors.py` as rerunnable levers.

Verified on PHP 8.5.12 CLI: bootstrap no longer fatals on constants/ctors; remaining `config.php` include failure is remote DB network timeout (environment), not language.
