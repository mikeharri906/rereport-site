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
  const re = /\$(\w+)\s*=\s*"([^"]*)";\s*/g;
  let m;
  while ((m = re.exec(content)) !== null) vars[m[1]] = m[2];
  const re2 = /\$(\w+)\s*=\s*'([^']*)';\s*/g;
  while ((m = re2.exec(content)) !== null) vars[m[1]] = m[2];
  return vars;
}

function processFile(filePath, urlPath) {
  const dir = path.dirname(filePath);
  const isSubdir = urlPath.includes('/ratings/') || urlPath.includes('/badges/');
  const base = isSubdir ? '../' : '';
  const cssPath = isSubdir ? '../style.css' : 'style.css';

  let content = fs.readFileSync(filePath, 'utf-8');
  const vars = extractVars(content);

  // Process include directives
  content = content.replace(/<\?php[\s\S]*?include\s+['"]([^'"]+)['"]\s*;\s*\?>/g, (match, inc) => {
    const incPath = path.resolve(dir, inc);
    try {
      return fs.readFileSync(incPath, 'utf-8');
    } catch (e) {
      return `<!-- include error: ${inc} -->`;
    }
  });

  // Replace all $variable echo patterns
  content = content.replace(/<\?php\s+echo\s+\$(\w+);\s*\?>/g, (m, v) => {
    if (v === 'base') return base;
    if (v === 'page_css_path') return vars['page_css_path'] || cssPath;
    return vars[v] || '';
  });

  // Handle <?php echo $base ?? ''; ?> and similar
  content = content.replace(/<\?php\s+echo\s+\$base\s*\?\?\s*''\s*;\s*\?>/g, base);

  // Strip all remaining PHP blocks (conditionals, assignments, logic)
  // But preserve HTML content between PHP if/endif blocks
  content = content.replace(/<\?php[\s\S]*?\?>/g, '');

  return content;
}

http.createServer((req, res) => {
  let urlPath = decodeURIComponent(req.url.split('?')[0]);
  if (urlPath.endsWith('/')) urlPath += 'index.html';

  let filePath = path.join(ROOT, urlPath);
  if (!path.extname(filePath) && !fs.existsSync(filePath)) filePath += '.html';

  if (!fs.existsSync(filePath)) {
    res.writeHead(404, { 'Content-Type': 'text/plain' });
    res.end('Not Found');
    return;
  }

  const ext = path.extname(filePath);
  const mime = mimeTypes[ext] || 'application/octet-stream';
  const isBinary = ['.png', '.jpg', '.ico'].includes(ext);

  let content;
  if (isBinary) {
    content = fs.readFileSync(filePath);
  } else {
    content = fs.readFileSync(filePath, 'utf-8');
    if (ext === '.html' && content.includes('<?php')) {
      content = processFile(filePath, urlPath);
    }
  }

  res.writeHead(200, { 'Content-Type': mime });
  res.end(content);
}).listen(PORT, () => console.log(`Dev server at http://localhost:${PORT}`));
