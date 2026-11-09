# CHANGED

## 2026-11-09 15:31:02 CST (Asia/Taipei)

Production PHP 8.4 500 root cause: restored `config.php` still used unquoted `defined(ROOT|libs|icld)`, which is Error on PHP 8+.

- Add `scripts/patch-config-php84.php` to quote those constants and guard `$_GET['debug']` without changing DB/mail secrets.

## 2026-11-09 14:40:50 CST (Asia/Taipei)

Live DB smoke after local MySQL came up.

- `admin1561318/common.func.php`: PDO credentials follow `config.php` `$conn_*` or gitignored `db.local.php` (removed hardcoded remote secrets from the tracked file).
- Front pages that need PDO (`index`, `unboxing`, `unboxing-content`, `test`) load `config.php` before `common.func.php`.
- `include/nav.php`: init menu active classes; `storelist.php` and admin index undefined-key guards.
- Added `scripts/db-smoke.php` and `scripts/page-smoke.php`; `admin1561318/db.local.example.php`.
- Enabled local PHP 8.5 `pdo_mysql` extension for CLI smoke.

Verified: `SMOKE_DB=PASS`, `SMOKE_PAGES=PASS` (index/news/products/stores/unboxing/admin login shell).

## 2026-11-09 14:14:22 CST (Asia/Taipei)

Stop tracking local secrets in git.

- Add `config.php` to `.gitignore` and remove it from the index (`git rm --cached`).
- Add `config.example.php` as the shareable template (no real credentials).
- Local `config.php` stays on disk for runtime; it is not pushed.

## 2026-11-09 12:31:46 CST (Asia/Taipei)

Continue PHP 8.5 hardening (isset sweep + MyDB resilience).

- `libs/MyDB.php`: tolerate connect failure; guard `NumRows`/`Fetch*`/`DataSeek` when query is not `mysqli_result`.
- Front pages: `empty()` / isset for `$ary_get` keys (`search`, `news-content`, `products`, `products-content`, `unboxing-content`); init banner HTML vars in `index.php`.
- `config.php`: ensure `$ary_get` / `$ary_post` are arrays.
- `admin1561318/proc.php` and `delete_proc.php`: default missing `proc`/`ct`/`pk` before switch.

Verified: `include config.php` on PHP 8.5.12 returns `CONFIG_OK` with unreachable DB (empty result sets, no fatal).

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
