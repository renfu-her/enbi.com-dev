# libs

Updated: 2026-11-09 12:31:46 CST (Asia/Taipei)

Shared PHP helpers for the storefront.

PHP 8.5 notes: `MyDB`, `SimpleSQL`, `SplitPage`, and `excel_reader2` use `__construct`. Mail uses `PHPMailerV2`. Prefer not loading legacy `class.phpmailer.php` / `PHPMailer/` on the hot path.
