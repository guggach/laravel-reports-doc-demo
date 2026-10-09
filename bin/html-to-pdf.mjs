// Renders HTML (via stdin) to PDF (to stdout) using the Playwright Chromium.
// Usage: node html-to-pdf.mjs '<options-json>'
import { chromium } from 'playwright';

const options = JSON.parse(process.argv[2] ?? '{}');
const margins = options.margins ?? {};

let html = '';
process.stdin.setEncoding('utf8');
for await (const chunk of process.stdin) {
    html += chunk;
}

const browser = await chromium.launch({ args: ['--no-sandbox'] });
const page = await browser.newPage();

await page.setContent(html, { waitUntil: 'load' });

const pdf = await page.pdf({
    format: options.format ?? 'A4',
    landscape: Boolean(options.landscape),
    printBackground: options.printBackground !== false,
    margin: {
        top: `${margins.top ?? 0}mm`,
        right: `${margins.right ?? 0}mm`,
        bottom: `${margins.bottom ?? 0}mm`,
        left: `${margins.left ?? 0}mm`,
    },
});

await browser.close();

process.stdout.write(pdf);
