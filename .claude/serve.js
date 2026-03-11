const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = 8080;
const ROOT = path.resolve(__dirname, '..');

const mimeTypes = {
  '.html': 'text/html', '.css': 'text/css', '.js': 'application/javascript',
  '.svg': 'image/svg+xml', '.json': 'application/json', '.png': 'image/png',
  '.jpg': 'image/jpeg', '.ico': 'image/x-icon', '.xml': 'application/xml',
  '.txt': 'text/plain',
};

function extractVars(content) {
  const vars = {};
  // Extract $var = "value"; assignments
  const re = /\$(\w+)\s*=\s*"([^"]*)";\s*/g;
  let m;
  while ((m = re.exec(content)) !== null) {
    vars[m[1]] = m[2];
  }
  // Extract $var = '...'; single-quote assignments
  const re2 = /\$(\w+)\s*=\s*'([^']*)';\s*/g;
  while ((m = re2.exec(content)) !== null) {
    vars[m[1]] = m[2];
  }
  return vars;
}

function processPhp(content, filePath) {
  const dir = path.dirname(filePath);
  const isInRatings = filePath.replace(/\\/g, '/').includes('/ratings/');
  const isInBadges = filePath.replace(/\\/g, '/').includes('/badges/');
  const base = (isInRatings || isInBadges) ? '../' : '';

  // Extract PHP variables from the page
  const vars = extractVars(content);

  // Process includes - match the full PHP block containing include
  let out = content.replace(/<\?php[\s\S]*?include\s+['"]([^'"]+)['"]\s*;\s*\?>/g, (match, inc) => {
    const incPath = path.resolve(dir, inc);
    try {
      let incContent = fs.readFileSync(incPath, 'utf-8');

      // Replace PHP echo of variables
      incContent = incContent.replace(/<\?php\s+echo\s+\$(\w+);\s*\?>/g, (m, varName) => {
        return vars[varName] || '';
      });

      // Replace $base variable references
      incContent = incContent.replace(/<\?php\s+echo\s+\$base\s*(?:\?\?\s*'')?\s*;\s*\?>/g, base);

      // Handle $page_css_path
      incContent = incContent.replace(/<\?php\s+echo\s+\$page_css_path;\s*\?>/g,
        vars['page_css_path'] || (base + 'style.css'));

      // Strip remaining PHP blocks (conditionals, etc) but keep their HTML content
      // Handle <?php if (...): ?> ... <?php endif; ?> blocks by stripping the PHP tags
      incContent = incContent.replace(/<\?php\s+if\s*\([^)]*\)\s*:\s*\?>/g, '');
      incContent = incContent.replace(/<\?php\s+endif;\s*\?>/g, '');
      incContent = incContent.replace(/<\?php\s+else\s*:\s*\?>/g, '');
      incContent = incContent.replace(/<\?php\s+foreach[\s\S]*?\?>/g, '');
      incContent = incContent.replace(/<\?php\s+endforeach;\s*\?>/g, '');

      // Strip any remaining PHP blocks
      incContent = incContent.replace(/<\?php[\s\S]*?\?>/g, '');

      return incContent;
    } catch (e) { return `<!-- include not found: ${inc} (${e.message}) -->`; }
  });

  // Strip remaining PHP blocks (variable declarations at top of page)
  out = out.replace(/<\?php[\s\S]*?\?>/g, '');

  return out;
}

http.createServer((req, res) => {
  let urlPath = decodeURIComponent(req.url.split('?')[0]);
  if (urlPath.endsWith('/')) urlPath += 'index.html';

  let filePath = path.join(ROOT, urlPath);

  // Try .html extension if no extension
  if (!path.extname(filePath) && !fs.existsSync(filePath)) {
    filePath += '.html';
  }

  if (!fs.existsSync(filePath)) {
    res.writeHead(404);
    res.end('Not Found');
    return;
  }

  const ext = path.extname(filePath);
  const mime = mimeTypes[ext] || 'application/octet-stream';

  let content = fs.readFileSync(filePath, ext === '.png' || ext === '.jpg' || ext === '.ico' ? null : 'utf-8');

  // Process PHP includes in HTML files
  if (ext === '.html' && typeof content === 'string' && content.includes('<?php')) {
    content = processPhp(content, filePath);
  }

  res.writeHead(200, { 'Content-Type': mime });
  res.end(content);
}).listen(PORT, () => console.log(`Dev server running at http://localhost:${PORT}`));
