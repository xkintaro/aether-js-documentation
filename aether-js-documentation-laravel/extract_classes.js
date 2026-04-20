const fs = require('fs');

const sql = fs.readFileSync('aether_lumen_documentation.sql', 'utf-8');

const allClasses = new Set();

const p1 = /class=\\\\"([^\\]*(?:\\\\.[^\\]*)*)\\\\"/g;
let m;
while ((m = p1.exec(sql)) !== null) {
    m[1].replace(/\\\\/g, '').split(/\s+/).filter(Boolean).forEach(c => allClasses.add(c));
}

const p2 = /class="([^"]+)"/g;
while ((m = p2.exec(sql)) !== null) {
    if (m[1].includes('NOT NULL') || m[1].includes('DEFAULT')) continue;
    m[1].split(/\s+/).filter(Boolean).forEach(c => allClasses.add(c));
}

const p3 = /class=\\\\\\"([^\\]*(?:\\\\.[^\\]*)*)\\\\\\"/g;
while ((m = p3.exec(sql)) !== null) {
    m[1].replace(/\\\\/g, '').split(/\s+/).filter(Boolean).forEach(c => allClasses.add(c));
}

const contentRegex = /content',\s*'([^']*(?:''[^']*)*)'/g;

const rawClassRegex = /class=(?:\\\\"|\\"|")([^"\\]*(?:[\\][^"]*)*?)(?:\\\\"|\\"|")/g;
while ((m = rawClassRegex.exec(sql)) !== null) {
    let val = m[1].replace(/\\\\/g, '').replace(/\\"/g, '');
    val.split(/\s+/).filter(Boolean).forEach(c => allClasses.add(c));
}

const validClass = /^[a-zA-Z\-_!@:\/\[\]\.0-9#]+$/;
const filtered = [...allClasses]
    .filter(c => {
        if (['NOT', 'NULL', 'DEFAULT', 'UNSIGNED', 'AUTO_INCREMENT', 'ENGINE=InnoDB',
            'PRIMARY', 'KEY', 'INT', 'VARCHAR', 'TEXT', 'TIMESTAMP', 'TINYINT',
            'BIGINT', 'LONGTEXT', 'text', 'number', 'password', 'image',
            'checkbox', 'hidden', 'timestamp', 'rich_text_box', 'relationship',
            'Name', 'Email', 'Password', 'Avatar', 'Role', 'Roles'
        ].includes(c)) return false;
        if (c.length < 2) return false;
        if (c.startsWith('<') || c.startsWith('>')) return false;
        if (c.startsWith('&')) return false;
        return true;
    })
    .sort();

console.log(`Toplam ${filtered.length} benzersiz class bulundu.\n`);
filtered.slice(0, 50).forEach(c => console.log(c));
console.log('...');

const chunkSize = 12;
let safelistHtml = `{{--
    Bu dosya, veritabanında saklanan HTML içeriklerde kullanılan Tailwind CSS sınıflarının
    production build sırasında CSS'e dahil edilmesini sağlayan bir safelist dosyasıdır.
    Bu dosya hiçbir yerde render EDİLMEZ. Sadece Tailwind'in sınıfları taraması içindir.

    Veritabanına yeni Tailwind sınıfları eklerseniz, bu dosyaya da eklemeyi unutmayın.
--}}\n\n`;

for (let i = 0; i < filtered.length; i += chunkSize) {
    const chunk = filtered.slice(i, i + chunkSize);
    safelistHtml += `<div class="${chunk.join(' ')}"></div>\n`;
}

fs.writeFileSync('resources/views/safelist.blade.php', safelistHtml, 'utf-8');
console.log(`\n✅ safelist.blade.php güncellendi! (${filtered.length} class)`);
