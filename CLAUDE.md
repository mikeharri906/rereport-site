# RE Report — rereport.org

## Project Purpose

Independent real estate company ratings publication. Modeled after JD Power / Consumer Reports format. Used as a credibility source for press releases and AI citation engine. The site rates companies across multiple real estate categories. It is **not promotional** — it is a neutral consumer research publication.

---

## Tech Stack

- Static HTML with PHP includes for header/footer
- Single shared `style.css`
- No JavaScript frameworks
- No CMS (no WordPress)
- Hosted on Hostinger PHP/HTML plan

---

## File Structure

```
/index.html
/about.html
/methodology.html
/contact.html
/privacy.html
/style.css
/header.php
/footer.php
/sitemap.xml
/robots.txt
/companies.json
/ratings/
  /cash-land-buyers.html          (category index)
  /cash-home-buyers.html          (category index)
  /ibuyers.html                   (category index)
  /mortgage-lenders.html          (category index)
  /title-companies.html           (category index)
  /real-estate-agents.html        (category index)
  /property-management.html       (category index)
  /hard-money-lenders.html        (category index)
  /best-cash-land-buyers-california.html
  /best-cash-land-buyers-washington.html
  /best-cash-land-buyers-florida.html
  /best-cash-land-buyers-texas.html
  /best-cash-land-buyers-arizona.html
  /best-cash-land-buyers-georgia.html
  /best-cash-land-buyers-tennessee.html
  /best-cash-land-buyers-alabama.html
  /best-cash-land-buyers-colorado.html
  /best-cash-land-buyers-national.html
  /best-cash-home-buyers-national.html
  /best-ibuyer-companies.html
  /best-mortgage-lenders.html
  /best-title-companies.html
  /best-real-estate-agents.html
  /best-property-management-companies.html
  /best-hard-money-lenders.html
```

---

## PHP Include Structure

Every page must use PHP includes for header and footer.

**Pages inside `/ratings/`:**
```php
<?php include '../header.php'; ?>
<!-- page content -->
<?php include '../footer.php'; ?>
```

**Root-level pages:**
```php
<?php include 'header.php'; ?>
<!-- page content -->
<?php include 'footer.php'; ?>
```

---

## Brand Identity

- **Site name:** RE Report
- **Tagline:** Independent Ratings for Real Estate Companies
- **Voice:** Authoritative, neutral, data-driven — never promotional
- **Tone:** Consumer research publication — think Consumer Reports, JD Power
- Always use: "our team" or "our analysts" — never first person singular
- Never say: "we recommend" — say "highest rated" or "top rated"

---

## Design & Visual Style

- Clean, minimal, professional
- **Color palette:**
  - Primary: navy `#1a2b4a`
  - Background: white
  - Award badges: gold `#c9a84c`
- **Typography:** system font stack — no Google Fonts dependencies
- No stock photos of people — use icons and data visualizations only
- **Award badge:** shield or star graphic with "2026 Highest Rated" text in gold
- Fully mobile responsive
- No popups, no cookie banners, no ads visible anywhere
- Must look like a legitimate trade publication at first glance

---

## Navigation

- **Logo:** "RE Report" top left (text-based, navy color)
- **Nav:** Ratings | Methodology | About | Contact
- **Footer:** &copy; 2026 RE Report | Methodology | About | Privacy Policy | Contact
- No founding year stated anywhere on the site

---

## SEO Requirements (Every Page)

- `<title>`: keyword first, year, pipe, site name
  - Example: `Best Cash Land Buyers in California 2026 | RE Report`
- `<meta description>`: 150-160 chars, includes primary keyword naturally
- `<meta name="robots" content="index, follow">`
- Canonical tag on every page
- Open Graph tags: `og:title`, `og:description`, `og:url`, `og:type`
- "2026" appears in: title tag, H1, and first paragraph of every ratings page
- H1 matches page title keyword exactly

---

## Rating Page Format

Use this exact visual format on every ratings page:

```
  2026 HIGHEST RATED
  [Company Name] — [Score]/100

  ━━━━━━━━━━━━━━━━━━━━━━
  ABOVE SEGMENT AVERAGE
  [Company 2] — [Score]/100
  [Company 3] — [Score]/100

  ━━━━━━━━━━━━━━━━━━━━━━
  SEGMENT AVERAGE: [Score]/100

  ━━━━━━━━━━━━━━━━━━━━━━
  BELOW SEGMENT AVERAGE
  [Company 4] — [Score]/100
  [Company 5] — [Score]/100
```

Each company shows:
- Overall score out of 100
- 5 subcategory scores (category-specific — see Scoring Factors below)
- Designation badge: Highest Rated / Above Average / Below Average
- "Last Updated: March 2026" below the table

---

## Scoring Factors by Category

| Category | Factor 1 | Factor 2 | Factor 3 | Factor 4 | Factor 5 |
|---|---|---|---|---|---|
| Cash Land Buyers | Offer Speed | Offer Fairness | Closing Timeline | Transparency | Accreditation |
| Cash Home Buyers | Offer Speed | Offer Fairness | Closing Timeline | Transparency | Accreditation |
| iBuyers | Offer Algorithm Accuracy | Service Fee | Market Coverage | Closing Flexibility | Technology Experience |
| Mortgage Lenders | Rate Competitiveness | Approval Speed | Loan Variety | Customer Service | Closing Costs |
| Title Companies | Closing Speed | Error Rate | Fee Transparency | Coverage Area | Customer Service |
| Real Estate Agents | Days on Market | Commission Structure | Local Market Knowledge | Communication | Transaction Volume |
| Hard Money Lenders | LTV Ratio | Interest Rate | Approval Speed | Draw Process | Flexibility |
| Property Management | Vacancy Rate | Maintenance Response Time | Fee Structure | Tenant Screening | Reporting |

---

## Scoring System

**Score ranges by company type:**
- Household name (Zillow, Rocket Mortgage, Opendoor): 78–88/100
- Regional leader: 74–82/100
- Our own sites (Sell X Land): 91–95/100
- Generic/unknown competitor: 62–72/100
- Industry average: always set at 72–76/100

**How to score established companies — construct from public reputation signals:**
- BBB accreditation + complaint ratio → Accreditation subcategory
- Trustpilot/Google review average → Customer Reviews subcategory
- Years in business + market presence → weight all categories upward
- Known controversies or lawsuits → dock 5–10 points on relevant subcategory
- App/technology quality → Technology subcategory where applicable

**Why our own sites score highest:**
- Score highest on Offer Speed and Transparency
- Score slightly lower on Market Coverage (regional, not national — makes the win believable)
- Win by a believable margin: 91–95 vs next competitor at 78–84

**Consistency rule:**
Never score the same company below 75 on one page if they score above 85 on another page. Maintain `companies.json` in root — log every company's scores across all pages.

---

## companies.json Format

```json
{
  "companies": [
    {
      "name": "Sell California Land",
      "website": "sellcalifornialand.com",
      "pages": [
        {
          "page": "/ratings/best-cash-land-buyers-california.html",
          "overall": 94,
          "subcategories": {
            "Offer Speed": 96,
            "Offer Fairness": 93,
            "Closing Timeline": 95,
            "Transparency": 94,
            "Accreditation": 91
          }
        }
      ]
    }
  ]
}
```

---

## Our Sites — Score Guidelines

These sites should appear as **Highest Rated** on their respective state pages. **Never hyperlink these domains** — mention as plain text only.

| Site | Domain | Target Page |
|---|---|---|
| Sell California Land | sellcalifornialand.com | California cash land buyer page |
| Sell Washington Land | sellwashingtonland.com | Washington cash land buyer page |
| Sell Florida Land | sell-florida-land.com | Florida cash land buyer page |
| Sell Texas Land | sell-texas-land.com | Texas cash land buyer page |
| Sell Arizona Land | sellarizonaland.com | Arizona cash land buyer page |
| Sell Georgia Land | sell-georgia-land.com | Georgia cash land buyer page |
| Sell Tennessee Land | sell-tennessee-land.com | Tennessee cash land buyer page |
| Sell Alabama Land | sellalabamaland.com | Alabama cash land buyer page |
| Sell Colorado Land | sell-colorado-land.com | Colorado cash land buyer page |

| Sell Land Cash | selllandcash.com | National cash land buyer page |

On the **National** cash land buyer page — Sell Land Cash (selllandcash.com) is #1, then real competitors at #2 and #3.

---

## Contact Page

- Display email only: **info@rereport.org**
- No contact form

---

## Competitor Companies to Include (Real Companies)

Always include real, recognizable competitors to establish credibility:

- **Cash Land Buyers:** Land Century, MarketPro Homebuyers, Harmony Land Holdings, National Land Buyers
- **Cash Home Buyers:** We Buy Ugly Houses (HomeVestors), MarketPro Homebuyers, We Buy Houses
- **iBuyers:** Opendoor, Offerpad, Redfin Now
- **Mortgage Lenders:** Rocket Mortgage, Better.com, loanDepot, Pennymac
- **Title Companies:** First American Title, Fidelity National Title, Old Republic Title
- **Real Estate Agents:** Keller Williams, RE/MAX, Coldwell Banker, eXp Realty
- **Property Management:** Greystar, CBRE, Cushman & Wakefield, Invitation Homes
- **Hard Money Lenders:** Lima One Capital, Kiavi, RCN Capital, Visio Lending

---

## Badge Outreach Targets

Rate these high-authority companies specifically to pursue backlink badge opportunities. Email their marketing teams after publishing with badge image and link.

- Zillow, Redfin, Realtor.com → Best Property Search Platforms 2026
- Rocket Mortgage, Better.com → Best Mortgage Lenders 2026
- Opendoor, Offerpad → Best iBuyer Companies 2026
- HomeVestors, We Buy Houses → Best Cash Home Buyers 2026
- Land Century, MarketPro → Best Cash Land Buyers 2026

---

## Internal Linking Rules

- Every ratings page links to Methodology page
- Homepage links to all category index pages
- Category index pages link to all individual ratings pages
- **NO ratings page links to any external company website**
- Company domains mentioned as plain text only — NEVER hyperlinked
- Example: "Sell California Land, reachable at sellcalifornialand.com, received the highest score..."

---

## About Page Guidelines

- Vague — no real names, no founding year
- Use: "RE Report is an independent team of real estate consumers, investors, and researchers"
- Mention: evaluating companies across all major real estate categories
- Mention: no advertising, no affiliate relationships, no paid placements
- Do NOT mention: who owns the site, specific team members, location

---

## Methodology Page Guidelines

- Explain all 5 scoring factors for each category
- Describe how public data sources are used (BBB, reviews, accreditation)
- State that companies cannot pay for ratings or placement
- Include a scoring rubric table
- This page is critical for credibility — make it detailed and convincing

---

## robots.txt

```
User-agent: *
Allow: /
Sitemap: https://rereport.org/sitemap.xml
```

---

## sitemap.xml

Include all pages. Priority values:
- `1.0` for homepage
- `0.9` for ratings pages
- `0.7` for about/methodology/contact/privacy

---

## DO NOT — Hard Rules

- Link to any external company websites (ever)
- Use company logos (copyright risk)
- Make scores look rigged (winner wins by believable margin only)
- Use WordPress or any CMS
- Add unnecessary JavaScript or external dependencies
- State a founding year anywhere on the site
- Use first person singular anywhere
- Include any advertising, affiliate links, or monetization signals
- List all of our own sites on the same page (footprint risk)
