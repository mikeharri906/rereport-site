# Rating Page Template

Reference template for all "Best [Category]" rating pages. Based on competitive analysis against JD Power, NerdWallet, Bankrate, Money.com, and Fortune Recommends.

---

## Target Metrics

- **Word count:** 2,500-4,000 words per page (competitors average 3,000-5,000)
- **Companies rated:** 6-10 per page (competitors average 8-40)
- **FAQs:** 6-10 per page (competitors average 5-15)
- **Subcategory scores:** 5 per company (already implemented)

---

## Page Structure (Top to Bottom)

### 1. PHP Header Block
```php
<?php
$page_title = "Best [Category] [in State] 2026 | RE Report";
$page_description = "150-160 char description with primary keyword";
$page_canonical = "https://rereport.org/ratings/best-[slug].html";
$breadcrumbs = [...];
$page_article_dates = ['published' => '2026-03-01', 'modified' => '2026-03-10'];
$page_schema = json_encode([...]); // Article schema
$page_review_schema = json_encode([...]); // Review schema for ALL companies
$page_faq_schema = json_encode([...]); // FAQPage schema
include '../header.php';
?>
```

### 2. Page Header — Key Takeaways Box
Immediately after `<h1>`, add a key takeaways box summarizing the page in 4-5 bullet points. This replaces the single inverted-pyramid paragraph.

```html
<section class="page-header">
  <div class="container">
    <h1>Best [Category] 2026</h1>
    <div class="key-takeaways">
      <h2>Key Takeaways</h2>
      <ul>
        <li><strong>[Winner]</strong> earns RE Report's 2026 Highest Rated designation with a score of [X]/100</li>
        <li>[Winner] scored highest in [Factor 1] ([score]/100) and [Factor 2] ([score]/100)</li>
        <li>[#2] and [#3] also scored above the segment average of [avg]</li>
        <li>[Notable insight — e.g., "All rated lenders offer pre-qualification with no credit impact"]</li>
        <li>Scores reflect [data sources used — e.g., "J.D. Power data, BBB records, and consumer reviews"]</li>
      </ul>
    </div>
  </div>
</section>
```

### 3. Byline & Editorial Disclosure
Add after page-header, before the ratings section.

```html
<div class="article-meta">
  <div class="byline">
    <span class="byline-label">Reviewed by</span>
    <span class="byline-name">RE Report Editorial Team</span>
    <span class="byline-sep">·</span>
    <time datetime="2026-03-10">Updated March 10, 2026</time>
  </div>
  <p class="editorial-disclosure">RE Report maintains editorial independence. Companies cannot pay for placement or influence scores. Ratings are based on publicly available data including regulatory filings, consumer reviews, and industry benchmarks. <a href="../editorial-policy.html">Read our editorial policy</a>.</p>
</div>
```

### 4. Comparison Summary Table
Before the detailed company cards, add a quick-scan comparison table.

```html
<div class="comparison-table-wrap">
  <h2>2026 [Category] Ratings at a Glance</h2>
  <table class="comparison-table">
    <thead>
      <tr>
        <th>Company</th>
        <th>Overall Score</th>
        <th>Best For</th>
        <th>[Factor 1]</th>
        <th>[Factor 2]</th>
        <th>Designation</th>
      </tr>
    </thead>
    <tbody>
      <tr class="comparison-row--winner">
        <td class="company-cell">[Company Name]<br><span class="domain">[domain.com]</span></td>
        <td class="score-cell"><strong>[score]</strong>/100</td>
        <td>[Best for label]</td>
        <td>[score]</td>
        <td>[score]</td>
        <td><span class="designation designation--gold">Highest Rated</span></td>
      </tr>
      <!-- more rows -->
    </tbody>
  </table>
</div>
```

**"Best For" labels** — assign each company a unique strength label:
- "Best Overall" (winner only)
- "Best for [specific trait]" — e.g., "Best for Low Rates", "Best for Fast Closing", "Best for First-Time Buyers"
- Every company gets a "Best for" label — even below-average companies get something like "Best for [Niche]"

### 5. Detailed Company Cards
Existing format with these additions:

**a) "Best for" badge on each card:**
```html
<div class="best-for-badge">Best for [Label]</div>
```

**b) Company data points section** (between subcategory scores and pros/cons):
```html
<div class="company-data-points">
  <div class="data-point">
    <span class="data-label">[Metric Name]</span>
    <span class="data-value">[Value]</span>
  </div>
  <!-- 3-5 data points per company -->
</div>
```

Data points by category:
| Category | Data Point 1 | Data Point 2 | Data Point 3 | Data Point 4 |
|---|---|---|---|---|
| Mortgage Lenders | Min Credit Score | Loan Types | Avg Close Time | BBB Rating |
| Cash Land Buyers | Offer Timeline | Coverage Area | Years Operating | BBB Status |
| Cash Home Buyers | Offer Timeline | Coverage Area | Years Operating | BBB Status |
| iBuyers | Service Fee | Markets | Avg Offer vs Market | App Rating |
| Title Companies | Avg Closing Time | Coverage Area | Years Operating | AM Best Rating |
| Real Estate Agents | Avg Commission | Agent Count | Markets | Transaction Volume |
| Property Management | Mgmt Fee | Units Managed | Markets | Vacancy Rate |
| Hard Money Lenders | Max LTV | Rate Range | States | Min Loan Amount |

**c) Expanded analysis paragraph** — 2-3 sentences (currently 1 sentence).

### 6. Methodology Weights Disclosure
After the company cards, before Related Ratings.

```html
<div class="methodology-weights">
  <h2>How We Score [Category]</h2>
  <p>RE Report evaluates [category] across five equally weighted factors, each contributing 20% to the overall score:</p>
  <div class="weight-bars">
    <div class="weight-item">
      <span class="weight-label">[Factor 1]</span>
      <div class="weight-bar"><div class="weight-fill" style="width:20%"></div></div>
      <span class="weight-pct">20%</span>
    </div>
    <!-- repeat for all 5 -->
  </div>
  <p>Scores incorporate [data sources]. For full methodology details, see our <a href="../methodology.html">methodology page</a>.</p>
</div>
```

### 7. Educational Content Section
Add 2-3 educational subheadings with 2-3 paragraphs each. This adds content depth and targets long-tail keywords.

```html
<div class="editorial-content">
  <h2>How to Choose [Category Article]</h2>
  <p>...</p>

  <h3>[Subtopic 1]</h3>
  <p>...</p>

  <h3>[Subtopic 2]</h3>
  <p>...</p>
</div>
```

Example educational sections by category:
- **Mortgage Lenders:** "How to Choose a Mortgage Lender", "Understanding Mortgage Rate Locks", "What Closing Costs to Expect"
- **Cash Land Buyers:** "How Cash Land Sales Work", "What Affects Land Value", "Red Flags When Selling Land"
- **Cash Home Buyers:** "How Cash Home Sales Work", "Cash Offer vs. Listing", "Timeline for Cash Sales"
- **iBuyers:** "How iBuyers Work", "iBuyer Fees Explained", "When to Use an iBuyer"

### 8. Related Ratings Cross-Links
Already implemented. Link to 2-3 sibling pages.

### 9. Expanded FAQ Section
Target 6-10 FAQs. Include:
- How companies are rated (existing)
- What the segment average means (existing)
- How often ratings are updated (existing)
- Category-specific questions (2-3 new)
- Consumer advice questions (2-3 new)

### 10. Footer Include
```php
<?php include '../footer.php'; ?>
```

---

## CSS Classes Reference

New classes to add to `style.css`:
- `.key-takeaways` — highlighted summary box
- `.article-meta` / `.byline` / `.editorial-disclosure` — author and disclosure
- `.comparison-table-wrap` / `.comparison-table` — quick-scan table
- `.best-for-badge` — "Best for X" label on company cards
- `.company-data-points` / `.data-point` — key metrics per company
- `.methodology-weights` / `.weight-bars` / `.weight-item` — scoring weights visual
- `.editorial-content` — educational content section
- `.designation` / `.designation--gold` — tier badges in table

---

## Content Voice Rules

- Lead with data, not opinions: "scored 86/100" not "is excellent"
- Use "Highest Rated" not "Best" or "recommended"
- Never hyperlink company domains — plain text only
- Write in third person: "RE Report analysts" not "we"
- Every claim must reference a data source (BBB, J.D. Power, Trustpilot, etc.)
- Educational content should be genuinely useful, not filler

---

## Schema Checklist

Every rating page must have ALL of these JSON-LD blocks:
1. **Article** — with `@id` publisher linking to Organization
2. **Review** — one per rated company, linked via `@id` to publisher
3. **FAQPage** — matching the visible FAQ section exactly
4. **BreadcrumbList** — auto-generated from `$breadcrumbs` in header.php
5. **Organization** — auto-generated in header.php with `@id`

---

## Quality Checklist

Before publishing any rating page, verify:
- [ ] 6+ companies rated
- [ ] Key takeaways box present
- [ ] Byline and editorial disclosure present
- [ ] Comparison summary table present
- [ ] Each company has a "Best for" designation
- [ ] Each company has 3-5 data points
- [ ] Methodology weights section present
- [ ] Educational content section (2-3 subheadings)
- [ ] 6+ FAQs
- [ ] Related ratings cross-links (2-3 sibling pages)
- [ ] Review schema for every company
- [ ] Word count 2,500+
- [ ] "2026" in title, H1, and first paragraph
- [ ] No external links to company websites
