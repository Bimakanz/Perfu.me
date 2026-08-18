$map = @{
    'â€”' = '—'
    'â€“' = '–'
    'â€œ' = '“'
    'â€�' = '”'
    'â€™' = '’'
    'â€¢' = '•'
    'â€¦' = '…'
    'âœ¨' = '✨'
    'âœ“' = '✔'
    'â€º' = '›'
    'Â·' = '·'
    'âˆ’' = '−'
    'Ã©' = 'é'
    'Ã±' = 'ñ'
    'Ã§' = 'ç'
    'ðŸš«' = '🔒'
    'âœï¸' = '✏️'
    'ðŸ”’' = '❤'
}
$exts = @('*.css','*.js','*.php','*.blade.php')
$files = Get-ChildItem -Path . -Recurse -Include $exts -File
$count = 0
foreach ($file in $files) {
    try {
        $text = Get-Content -Raw -Path $file.FullName -Encoding UTF8
    } catch {
        continue
    }
    $newText = $text
    foreach ($key in $map.Keys) {
        $newText = $newText -replace [regex]::Escape($key), [regex]::Escape($map[$key])
    }
    if ($newText -ne $text) {
        Set-Content -Path $file.FullName -Value $newText -Encoding UTF8
        Write-Host "Updated: $($file.FullName)"
        $count++
    }
}
Write-Host "Finished. Files updated: $count"