#!/usr/bin/env python3
import os
import re

root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
skip_prefixes = (
    ".git",
    "tiny_mce",
    "PHP_Mailer",
    "libs/PHPExcel",
    "libs/google-api",
    "libs/PHPMailer",
    "libs/jsonwrapper",
    "admin1561318/js",
    "scripts",
)

pat_class = re.compile(r"class\s+([A-Za-z_][A-Za-z0-9_]*)")
pat_fn = re.compile(r"function\s+([A-Za-z_][A-Za-z0-9_]*)\s*\(")
magic = {
    "__construct",
    "__destruct",
    "__get",
    "__set",
    "__call",
    "__toString",
    "__isset",
    "__unset",
    "__wakeup",
    "__sleep",
    "__clone",
    "__invoke",
}

hits = []
for dp, dns, fns in os.walk(root):
    rel_dir = os.path.relpath(dp, root).replace("\\", "/")
    if rel_dir == ".":
        rel_dir = ""
    if any(
        rel_dir == p or rel_dir.startswith(p + "/")
        for p in skip_prefixes
    ):
        dns[:] = []
        continue
    for fn in fns:
        if not fn.endswith(".php"):
            continue
        path = os.path.join(dp, fn)
        rel = os.path.relpath(path, root).replace("\\", "/")
        try:
            text = open(path, encoding="utf-8", errors="ignore").read()
        except OSError:
            continue
        classes = set(pat_class.findall(text))
        if not classes:
            continue
        for i, line in enumerate(text.splitlines(), 1):
            m = pat_fn.search(line)
            if not m:
                continue
            name = m.group(1)
            if name in classes and name not in magic:
                hits.append((rel, i, name, line.strip()[:140]))

print("OLD_CTOR_COUNT", len(hits))
for rel, i, name, line in hits:
    print(f"{rel}:{i}\t{name}\t{line}")
