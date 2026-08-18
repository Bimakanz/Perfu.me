const fs = require("fs");
const path = require("path");

const replacements = [
    ["â”€", "─"],
    ["â€¢", "•"],
    ["â€“", "—"],
    ["â€º", "›"],
    ["Â·", "·"],
    ["âˆ’", "−"],
    ["â˜…", "★"],
    ["âœ¨", "✨"],
    ["âœ“", "✓"],
    ["âœï¸", "✏️"],
];

const files = [
    "resources/views/admin/index.blade.php",
    "resources/views/katalog.blade.php",
    "resources/views/product-detail.blade.php",
    "css/main.css",
    "public/css/css/main.css",
    "public/css/css/hero.css",
    "public/css/css/navbar.css",
    "public/css/main.css",
];

for (const rel of files) {
    const filePath = path.resolve(rel);
    if (!fs.existsSync(filePath)) {
        console.log("NOTFOUND", rel);
        continue;
    }
    let content = fs.readFileSync(filePath, "utf8");
    let updated = content;
    for (const [bad, good] of replacements) {
        updated = updated.split(bad).join(good);
    }
    if (updated !== content) {
        fs.writeFileSync(filePath, updated, "utf8");
        console.log("UPDATED", rel);
    } else {
        console.log("NOCHANGE", rel);
    }
}
