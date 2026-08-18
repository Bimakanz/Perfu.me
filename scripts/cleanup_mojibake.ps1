$replacements = @{
    'â”€' = '─'
    'â€¢' = '•'
    'â€“' = '—'
    'â€º' = '›'
    'Â·' = '·'
    'âˆ’' = '−'
    'â˜…' = '★'
    'âœ¨' = '✨'
    'âœ“' = '✓'
    'âœï¸' = '✏️'
}
$files = @(
    'resources/views/admin/index.blade.php'
    'resources/views/katalog.blade.php'
    'resources/views/product-detail.blade.php'
    'css/main.css'
    'public/css/css/main.css'
    'public/css/css/hero.css'
    'public/css/css/navbar.css'
    'public/css/main.css'
)

foreach ($f in $files) {
    if (-not (Test-Path $f)) {
        Write-Host "NOTFOUND: $f"
        continue
    }
    $text = Get-Content -Path $f -Raw -Encoding UTF8
    $new = $text
    foreach ($key in $replacements.Keys) {
        $new = $new -replace [regex]::Escape($key), $replacements[$key]
    }
    if ($new -ne $text) {
        Set-Content -Path $f -Value $new -Encoding UTF8
        Write-Host "UPDATED: $f"
    } else {
        Write-Host "NOCHANGE: $f"
    }
}