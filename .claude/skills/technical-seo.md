# Technical SEO Skill — RE Report

Reference for all technical SEO decisions on rereport.org. Load this skill when working on meta tags, structured data, performance, server config, or AI citation optimization.

**Key files:** `header.php` (meta tags, schema), `footer.php`, `.htaccess`, `robots.txt`, `sitemap.xml`
**Content SEO rules:** See `CLAUDE.md` (title patterns, meta descriptions, keyword placement)
**Visual design rules:** See `.claude/skills/web-design.md`

---

## 1. Current State Audit

### Already Implemented
- `<meta charset>`, `<meta viewport>`, `<meta robots>` on every page
- Dynamic `<title>`, `<meta description>`, `<link rel="canonical">` via PHP variables
- Open Graph tags: `og:title`, `og:description`, `og:url`, `og:type`, `og:site_name`
- Schema.org JSON-LD: Organization (global), WebSite (homepage), Article (ratings/methodology), AboutPage (about), FAQPage (rating pages with FAQ)
- Breadcrumb HTML with `aria-label="Breadcrumb"` and `aria-current="page"`
- `robots.txt` with `Allow: /` and Sitemap declaration
- `sitemap.xml` with all 32 pages, correct priority values
- `.htaccess` with PHP processing for `.html` files
- Skip link, `id="main-content"`, semantic HTML5 structure
- System font stack (no external font requests)
- Single CSS file, no JS frameworks, SVG icons only

### Not Yet Implemented
- Twitter Card meta tags (`twitter:card`, `twitter:image`)
- `og:image` tag (no social sharing image exists yet)
- `<meta name="referrer">` tag
- BreadcrumbList JSON-LD schema (HTML breadcrumbs exist but no JSON-LD)
- Review/Rating schema for company scores
- `.htaccess` caching headers and gzip compression
- `.htaccess` security headers (HSTS, X-Frame-Options, etc.)
- `article:author` and `article:published_time` Open Graph tags on ratings pages

---

## 2. Meta Tags & Head Structure

### Required `<head>` Tag Order

Every page must include these tags in this order inside `header.php`:

```html
<head>
  <!-- 1. Character encoding (must be first) -->
  <meta charset="UTF-8">

  <!-- 2. Viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 3. Robots directive -->
  <meta name="robots" content="index, follow">

  <!-- 4. Referrer policy -->
  <meta name="referrer" content="strict-origin-when-cross-origin">

  <!-- 5. Title (dynamic) -->
  <title><?php echo $page_title; ?></title>

  <!-- 6. Meta description (dynamic) -->
  <meta name="description" content="<?php echo $page_description; ?>">

  <!-- 7. Canonical (dynamic, absolute URL) -->
  <link rel="canonical" href="<?php echo $page_canonical; ?>">

  <!-- 8. Open Graph -->
  <meta property="og:title" content="...">
  <meta property="og:description" content="...">
  <meta property="og:url" content="...">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="RE Report">
  <meta property="og:image" content="https://rereport.org/og-image.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- 9. Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="...">
  <meta name="twitter:description" content="...">
  <meta name="twitter:image" content="https://rereport.org/og-image.jpg">

  <!-- 10. Favicon -->
  <link rel="icon" type="image/svg+xml" href="...">

  <!-- 11. Stylesheet -->
  <link rel="stylesheet" href="style.css">

  <!-- 12. Schema.org JSON-LD (Organization global, then page-specific) -->
  <script type="application/ld+json">...</script>
</head>
```

### Tag Rules

**Canonical tags:**
- Always absolute URL: `https://rereport.org/ratings/page.html`
- Self-referencing (every page canonicalizes to itself)
- Must align with sitemap URL and internal link href — all three point to the same URL

**Open Graph `og:image`:**
- Dimensions: 1200x630px (optimal for social sharing)
- Format: JPEG or PNG (not SVG — social platforms don't render SVG)
- One default image for the site; optionally per-category images later
- Must be an absolute URL

**Twitter Cards:**
- `summary_large_image` for all pages (shows large preview image)
- Can reuse the same `og:image` URL

**Referrer policy:**
- `strict-origin-when-cross-origin` — sends origin to external sites, full URL to same-origin

### Ratings Page Extra OG Tags

On pages with `Article` schema, also add:
```html
<meta property="article:published_time" content="2026-03-01">
<meta property="article:modified_time" content="2026-03-10">
<meta property="article:author" content="RE Report">
```

---

## 3. Structured Data (Schema.org)

### Format Rules
- Always JSON-LD (`<script type="application/ld+json">`)
- Place in `<head>` (current implementation is correct)
- Multiple schema blocks per page are fine
- All URLs must be absolute (`https://rereport.org/...`)
- Only describe content visible on the page — never add schema for hidden content

### Currently Implemented Schemas

| Schema | Where | Status |
|--------|-------|--------|
| Organization | `header.php` (global) | ✓ |
| WebSite | `index.html` | ✓ |
| Article | Rating pages, methodology | ✓ |
| AboutPage | `about.html` | ✓ |
| FAQPage | Rating pages with FAQ section | ✓ |

### Schemas to Add

**BreadcrumbList** — Add to every page that has breadcrumb HTML. Generate via PHP alongside the existing `$breadcrumbs` array:

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://rereport.org/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Cash Land Buyers",
      "item": "https://rereport.org/ratings/cash-land-buyers.html"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "California"
    }
  ]
}
```

Rules:
- Last item has `name` only (no `item` URL — it's the current page)
- `position` is 1-indexed
- URLs are absolute

**Review schema** — Add to each company card on rating pages. Wraps the existing score data:

```json
{
  "@context": "https://schema.org",
  "@type": "Review",
  "itemReviewed": {
    "@type": "Organization",
    "name": "Sell California Land"
  },
  "reviewRating": {
    "@type": "Rating",
    "ratingValue": "94",
    "bestRating": "100",
    "worstRating": "0"
  },
  "author": {
    "@type": "Organization",
    "name": "RE Report",
    "@id": "https://rereport.org/#organization"
  },
  "datePublished": "2026-03-01",
  "reviewBody": "California land sellers benefit from this company's deep knowledge of the local market."
}
```

Rules:
- One Review block per company on the page
- `reviewBody` should match the analysis paragraph visible on the page
- `author` links to the Organization `@id` for entity connection
- `ratingValue` must match the visible score exactly

### Entity Linking with @id

Use `@id` to connect schema entities so AI systems can build a knowledge graph:

```json
// In header.php (Organization):
{ "@type": "Organization", "@id": "https://rereport.org/#organization", "name": "RE Report" }

// In Article schema:
{ "publisher": { "@id": "https://rereport.org/#organization" } }

// In Review schema:
{ "author": { "@id": "https://rereport.org/#organization" } }
```

### Validation Workflow
1. **Google Rich Results Test**: `https://search.google.com/test/rich-results` — paste URL, check for errors/warnings
2. **Schema.org Validator**: `https://validator.schema.org` — validate JSON-LD syntax
3. **Google Search Console > URL Inspection**: verify Google can parse the schema on live pages

---

## 4. Crawlability & Indexation

### robots.txt (current — no changes needed)
```
User-agent: *
Allow: /
Sitemap: https://rereport.org/sitemap.xml
```

Rules:
- Never block `/ratings/`, `/style.css`, or any page you want indexed
- Never add `Disallow: /` (blocks entire site)
- Keep the Sitemap declaration — Googlebot reads it

### sitemap.xml Rules

**Priority values** (current values are correct):
- `1.0` — homepage only
- `0.9` — all rating pages (category indexes + individual ratings)
- `0.7` — support pages (about, methodology, contact, privacy, editorial-policy, team)

**lastmod accuracy:**
- `lastmod` should reflect actual content change date, not a frozen date
- Current: all pages show `2026-03-01` — update when content changes
- If lastmod is inaccurate, Google may ignore it entirely
- Acceptable: update all lastmod values when doing a content refresh cycle

**Sitemap hygiene:**
- Only include pages with `<meta name="robots" content="index, follow">`
- Never include redirected URLs, 404 pages, or noindexed pages
- Max 50,000 URLs per sitemap (not a concern at 32 pages)

### Canonical Alignment Rule

For every page, these three must point to the **exact same URL**:
1. `<link rel="canonical" href="...">`
2. Internal links (`<a href="...">`) pointing to that page
3. `<loc>` in sitemap.xml

If any of these disagree, search engines receive conflicting signals. Check alignment when adding new pages.

### .htaccess Crawl Directives

Current `.htaccess`:
```apache
AddType application/x-httpd-php .html
```

This is correct — enables PHP processing on `.html` files. Do not remove.

---

## 5. Page Speed & Core Web Vitals

### Thresholds (2026)

| Metric | Good | Needs Improvement | Poor |
|--------|------|-------------------|------|
| **LCP** (Largest Contentful Paint) | ≤ 2.5s | 2.5–4.0s | > 4.0s |
| **INP** (Interaction to Next Paint) | ≤ 200ms | 200–500ms | > 500ms |
| **CLS** (Cumulative Layout Shift) | ≤ 0.1 | 0.1–0.25 | > 0.25 |

### Why This Site Performs Well

- **No JavaScript frameworks** — eliminates INP issues (no JS bundle parsing)
- **Single CSS file** (~850 lines) — small enough that critical CSS inlining is unnecessary
- **System font stack** — zero font download time (no Google Fonts, no FOIT/FOUT)
- **SVG icons** — vector graphics, tiny file size, infinite scaling
- **Static HTML + PHP includes** — no database queries, no server-side rendering delays
- **No third-party scripts** — no analytics, ads, or external services blocking render

### .htaccess Performance Headers

Add to `.htaccess` for browser caching and compression:

```apache
# Enable gzip compression
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css application/json image/svg+xml
</IfModule>

# Browser caching
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresDefault "access plus 1 month"
  ExpiresByType text/html "access plus 1 hour"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType image/svg+xml "access plus 1 year"
  ExpiresByType image/x-icon "access plus 1 year"
  ExpiresByType application/json "access plus 1 day"
</IfModule>
```

Rules:
- HTML: short cache (1 hour) — content changes matter
- CSS/SVG: long cache (1 month / 1 year) — rarely changes
- After CSS changes, users get fresh copy within 1 month (acceptable for this site's update frequency)

### CLS Prevention

Always include `width` and `height` on `<img>` tags:
```html
<img src="icons/icon-land.svg" alt="" width="40" height="40">
```
Currently all icons have this ✓. Maintain this for any future images.

### Render-Blocking Resources

Current state: **None** — no external fonts, no JS in `<head>`, single CSS file loads fast. This is ideal. Do not add Google Fonts, external CSS CDNs, or synchronous scripts to `<head>`.

If JavaScript is ever needed, use `defer`:
```html
<script src="script.js" defer></script>
```
Never use bare `<script src="..."></script>` in `<head>` — it blocks rendering.

---

## 6. Image SEO

### Current Images
- 8 SVG category icons (`icons/icon-land.svg`, etc.)
- 1 SVG favicon (`favicon.svg`)
- 1 SVG badge (`badge-highest-rated.svg`)
- No raster images (JPEG, PNG, WebP)

### Alt Text Rules

**Decorative icons** (current category icons on homepage):
```html
<!-- Correct: empty alt for decorative images inside a labeled link -->
<a href="ratings/cash-land-buyers.html" class="category-card">
  <img src="icons/icon-land.svg" alt="" width="40" height="40">
  <h3>Cash Land Buyers</h3>
</a>
```
The `alt=""` is correct here because the heading provides the text label. Adding alt text would be redundant for screen readers.

**Informational images** (if added in future — charts, infographics):
```html
<img src="chart.webp" alt="Comparison chart: Sell California Land scored 94/100, Land Century 79/100, MarketPro 76/100" width="800" height="400">
```
Rules:
- Max 125 characters
- Describe the information conveyed, not the image appearance
- No "image of" or "picture of" prefix
- Include key data points for charts/graphs
- Insert keywords naturally if relevant

**Functional images** (buttons, links):
```html
<img src="search-icon.svg" alt="Search ratings">
```

### Lazy Loading Rules
- **Never** lazy-load above-the-fold images (hero, header, first visible content)
- Use `loading="lazy"` only for images below the fold
- The LCP image (if ever added) gets `fetchpriority="high"`:
```html
<img src="hero.webp" alt="..." width="1200" height="630" fetchpriority="high">
```

### Future Image Format Guidance
If raster images are ever added:
1. **WebP** as primary format (25-35% smaller than JPEG)
2. **JPEG** as fallback
3. Use `<picture>` element for format switching:
```html
<picture>
  <source srcset="image.webp" type="image/webp">
  <img src="image.jpg" alt="..." width="800" height="400" loading="lazy">
</picture>
```

### Image Sitemap
Not needed currently (no raster images to index). If added later, extend `sitemap.xml` with `xmlns:image` namespace.

---

## 7. Internal Linking Architecture

### Hub-and-Spoke Model (Current Structure)

```
Homepage (hub)
  ├─ Category Index: Cash Land Buyers (spoke hub)
  │    ├─ California ratings (leaf)
  │    ├─ Florida ratings (leaf)
  │    ├─ Texas ratings (leaf)
  │    ├─ ... (other states)
  │    └─ National ratings (leaf)
  ├─ Category Index: Cash Home Buyers (spoke hub)
  │    └─ National ratings (leaf)
  ├─ Category Index: iBuyers
  │    └─ Best iBuyer Companies (leaf)
  │ ... (6 more categories)
  ├─ Methodology
  ├─ About
  └─ Contact
```

### Link Equity Flow Rules

1. **Homepage → all category indexes** via category card grid ✓
2. **Category index → all rating pages** in that category ✓
3. **Every rating page → Methodology** ("View Methodology" link) ✓
4. **Footer → key support pages** (Methodology, About, Team, Editorial Policy, Privacy, Contact) ✓
5. **No external links to company websites** (per CLAUDE.md) ✓

### Breadcrumb Structure Rules

Breadcrumbs must reflect the logical hierarchy, not arbitrary paths:

**For state-specific rating pages:**
```
Home › Cash Land Buyers › California
```

**For national/best-of rating pages:**
```
Home › Cash Home Buyers › National Rankings
```

**For category index pages:**
```
Home › Cash Land Buyers
```

**For support pages:**
```
Home › About
```

### Anchor Text Guidelines

Vary anchor text across the site — don't use identical text for every link to the same page:

| Target Page | Good Anchors | Avoid |
|---|---|---|
| Methodology | "Read Full Methodology →", "View Methodology", "how we rate companies" | "click here", "read more" |
| Category index | "View Ratings →", "Cash Land Buyers", "all cash land buyer ratings" | "click here" |
| Homepage | "RE Report", "Home" | "go back" |

### Orphan Page Prevention

Every new page must be:
1. Linked from at least one existing page (parent or sibling)
2. Added to `sitemap.xml`
3. Added to the relevant category index page (if it's a ratings page)

Check: run a crawl (Screaming Frog or manual audit) to confirm no pages exist only in the sitemap without internal links.

### Cross-Linking Opportunities

Currently missing: sibling rating pages don't link to each other. Consider adding "See Also" or "Related Ratings" links at the bottom of rating pages:

```html
<div class="related-ratings">
  <h3>Related Ratings</h3>
  <ul>
    <li><a href="best-cash-land-buyers-florida.html">Best Cash Land Buyers in Florida 2026</a></li>
    <li><a href="best-cash-land-buyers-national.html">Best Cash Land Buyers Nationwide 2026</a></li>
  </ul>
</div>
```

This creates horizontal links between leaf pages, strengthening topical authority.

---

## 8. AI & LLM Citation Optimization (GEO)

### Why This Matters for RE Report

RE Report's purpose is to be cited as a credible source by press releases and AI systems. Optimizing for AI citation (Generative Engine Optimization) is as important as Google ranking.

Key stats:
- AI-referred visitors convert at 4.4x the rate of traditional organic traffic
- Only 12% of AI-cited URLs rank in Google's top 10 — different optimization needed
- LLM traffic grew 527% year-over-year

### Inverted Pyramid Structure

Every ratings page should lead with a direct answer, then expand:

```html
<h1>Best Cash Land Buyers in California 2026</h1>

<!-- Paragraph 1: 40-60 word direct answer -->
<p>Sell California Land leads RE Report's 2026 California cash land buyer
ratings with a score of 94/100, earning the Highest Rated designation.
The company scored highest in Offer Speed (96/100) and Closing Timeline
(95/100). Land Century (79/100) and MarketPro Homebuyers (76/100)
also scored above the segment average of 74.</p>

<!-- Then: detailed company cards, scores, analysis -->
```

AI systems extract the first 1-2 paragraphs for citations. Front-load facts.

### Fact Density Over Keyword Density

Pack pages with specific, verifiable data points:

| Weak (keyword-focused) | Strong (fact-focused) |
|---|---|
| "best cash land buyers" repeated | "scored 94/100 across 5 factors" |
| "top rated company" | "96/100 in Offer Speed, offers within 24-48 hours" |
| "trusted by homeowners" | "A+ BBB rating, operating since 2006" |

### Citation-Ready Formatting

AI systems extract structured content more easily:

1. **Comparison tables** — scores side-by-side in `<table>` elements
2. **Short paragraphs** — 2-3 sentences max
3. **Bullet lists** — for criteria, pros/cons
4. **Bold key facts** — `<strong>94/100</strong>` helps AI identify important data
5. **FAQ sections** — `<details>/<summary>` with FAQPage schema

### Schema as AI Parsing Aid

JSON-LD schema helps ALL systems (Google, ChatGPT, Perplexity) parse content:
- Article schema tells AI "this is a research article"
- FAQPage schema tells AI "here are Q&A pairs ready for extraction"
- Review schema tells AI "here are rated entities with scores"
- Organization schema tells AI "this is the authoritative publisher"

### Wiki-Voice Tone

Already aligned with CLAUDE.md brand voice:
- Third person: "our analysis shows" not "I think"
- Neutral: "highest rated" not "we recommend"
- Source-citing: "based on BBB data and consumer reviews"
- No sales language, no calls to action, no promotional tone

---

## 9. Security & Server Headers

### .htaccess Security Headers

Add to `.htaccess`:

```apache
# Security headers
<IfModule mod_headers.c>
  # Prevent MIME type sniffing
  Header set X-Content-Type-Options "nosniff"

  # Prevent clickjacking
  Header set X-Frame-Options "DENY"

  # Referrer policy
  Header set Referrer-Policy "strict-origin-when-cross-origin"

  # HSTS (enforce HTTPS for 1 year)
  Header set Strict-Transport-Security "max-age=31536000; includeSubDomains"
</IfModule>
```

### HTTPS Rules
- All canonical URLs must use `https://`
- All internal links must use relative paths (already correct — PHP `$base` variable handles this)
- All sitemap URLs must use `https://`
- No mixed content: never load `http://` resources from an `https://` page

### What NOT to Add
- `Content-Security-Policy` — not needed for a static site with no inline scripts (except the nav toggle onclick, which would require `unsafe-inline`). Adding CSP would break the nav toggle without refactoring.
- `X-XSS-Protection` — deprecated in modern browsers, not needed.

---

## 10. Monitoring & Verification

### Google Search Console Monthly Checks

| Report | What to Check | Action if Issues |
|--------|--------------|-----------------|
| Page Indexing | All 32 pages indexed, no unexpected exclusions | Fix crawl errors, check robots.txt |
| Core Web Vitals | LCP ≤ 2.5s, INP ≤ 200ms, CLS ≤ 0.1 | Check page speed section |
| Mobile Usability | No tap target or font size errors | Check web-design.md responsive section |
| Enhancements | Rich results detected for FAQ, Article schemas | Validate with Rich Results Test |
| Sitemaps | Submitted, no errors, all pages discovered | Resubmit if pages missing |

### After Publishing New Pages

1. Add page to `sitemap.xml` with correct `<loc>`, `<lastmod>`, `<priority>`
2. Add internal links from parent category index page
3. Submit updated sitemap in Search Console
4. Use URL Inspection to request indexing for the new page
5. Verify schema with Rich Results Test

### Testing Tools Reference

| Tool | URL | Use For |
|------|-----|---------|
| Rich Results Test | `search.google.com/test/rich-results` | Validate JSON-LD schema |
| Schema.org Validator | `validator.schema.org` | Check schema syntax |
| PageSpeed Insights | `pagespeed.web.dev` | Core Web Vitals, performance audit |
| Mobile-Friendly Test | `search.google.com/test/mobile-friendly` | Mobile rendering check |
| URL Inspection (GSC) | Google Search Console | Check indexability of specific URLs |
| SSL Labs | `ssllabs.com/ssltest` | HTTPS/TLS configuration audit |

### Sitemap Update Workflow

When content changes:
1. Update the `<lastmod>` date on changed pages in `sitemap.xml`
2. If new pages added, add new `<url>` blocks with appropriate priority
3. Push changes to production
4. Resubmit sitemap in Search Console (optional — Googlebot re-fetches periodically)

---

## Implementation Priority

When applying this skill to improve the site, work in this order:

1. **Add .htaccess caching + compression + security headers** — immediate server performance win
2. **Add BreadcrumbList JSON-LD schema** — generate in `header.php` from existing `$breadcrumbs` array
3. **Add Review schema to rating pages** — enables rich snippets in search results
4. **Add Twitter Card meta tags** — small addition to `header.php`
5. **Add referrer policy meta tag** — one line in `header.php`
6. **Add article OG tags to rating pages** — `article:published_time`, `article:author`
7. **Create og:image social sharing graphic** — 1200x630 JPEG, navy/gold branding
8. **Add inverted pyramid opening paragraphs** — improve first paragraph on each rating page for AI citation
9. **Add cross-links between sibling rating pages** — "Related Ratings" section
10. **Entity-link schemas with @id** — connect Organization ↔ Article ↔ Review schemas
