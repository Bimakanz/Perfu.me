from pathlib import Path

replacements = {
    'â”€': '─',
    'â”€â”€': '──',
    'â€¢': '•',
    'â€“': '—',
    'â€º': '›',
    'Â·': '·',
    'âˆ’': '−',
    'â˜…': '★',
    'âœ¨': '✨',
    'âœ“': '✓',
    'âœï¸': '✏️',
}

files = [
    'resources/views/admin/index.blade.php',
    'resources/views/katalog.blade.php',
    'resources/views/product-detail.blade.php',
    'css/main.css',
    'public/css/css/main.css',
    'public/css/css/hero.css',
    'public/css/css/navbar.css',
]

for rel in files:
    path = Path(rel)
    if not path.exists():
        print(f'MISSING: {rel}')
        continue
    text = path.read_text(encoding='utf-8')
    new_text = text
    for bad, good in replacements.items():
        new_text = new_text.replace(bad, good)
    if new_text != text:
        path.write_text(new_text, encoding='utf-8')
        print(f'Updated: {rel}')
    else:
        print(f'No changes: {rel}')
