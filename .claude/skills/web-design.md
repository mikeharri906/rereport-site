# Web Design Skill — RE Report

Reference for all visual design decisions on rereport.org. Load this skill when doing any CSS, layout, or visual work.

**Key files:** `style.css` (all styles), `header.php` (shared header), `footer.php` (shared footer)
**Test pages:** `index.html` (homepage components), `ratings/best-cash-land-buyers-california.html` (all rating components)

---

## 1. Design Tokens

All tokens live in `:root` at the top of `style.css`. Every value used more than once must reference a token.

### Colors (already defined)
```
--navy: #1a2b4a          Primary — headings, header, buttons
--navy-light: #2a3d62    Hero gradient endpoint
--gold: #c9a84c          Award/winner accent only
--gold-light: #e0c878    Unused — available for hover states
--white: #ffffff          Backgrounds
--gray-50 to --gray-800  Neutral scale
--text: #212529           Body text
--text-light: #495057     Secondary text
```

### Color Contrast Rules
- Navy on white: passes AA (12.8:1)
- White on navy: passes AA (12.8:1)
- Gold (#c9a84c) on white: **FAILS AA** (2.9:1) — never use gold text on white/light backgrounds
- Gold on navy: passes AA for large text (3.6:1) — OK for badges, headings 18px+
- Gray-300 on navy: passes AA (8.2:1) — minimum for footer text
- Gray-400 on navy: borderline (5.5:1) — acceptable for footer nav links
- Gray-500 on navy: **FAILS AA** (3.8:1) — do not use for footer body text

**Safe gold usage:** On navy backgrounds, as border/decoration on any background, as background color with navy text.
**Unsafe gold usage:** As text color on white or light gray backgrounds.

### Spacing Scale (add to `:root`)
```css
--space-xs:  0.25rem;   /*  4px */
--space-sm:  0.5rem;    /*  8px */
--space-md:  1rem;      /* 16px */
--space-lg:  1.5rem;    /* 24px */
--space-xl:  2rem;      /* 32px */
--space-2xl: 3rem;      /* 48px */
--space-3xl: 4rem;      /* 64px */
```
**Rule:** All spacing values must align to 4px or 8px multiples. No arbitrary values like `0.35rem` or `0.85rem`.

### Shadow Scale (add to `:root`)
```css
--shadow-sm:  0 1px 3px rgba(0,0,0,0.08);
--shadow-md:  0 2px 8px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.04);
--shadow-lg:  0 4px 16px rgba(0,0,0,0.10), 0 2px 4px rgba(0,0,0,0.06);
```
Use layered shadows (multiple values) for natural depth. Single-shadow declarations look flat.

### Transition Scale (add to `:root`)
```css
--transition-fast: 150ms ease-out;
--transition-base: 200ms ease-out;
--transition-slow: 300ms ease-out;
```

### Border Radius
```css
--radius: 8px;
```
Use `8px` for cards, inputs, banners. Use `50%` only for circles (step numbers, avatars). No other radius values.

---

## 2. Typography

### Font Stack
```css
font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
```
`system-ui` first — resolves to native OS font. No external font dependencies ever.

### Fluid Typography with clamp()
Replace fixed sizes + media query overrides with single `clamp()` declarations:

| Element | clamp() value | Range |
|---------|--------------|-------|
| `body` | `clamp(0.9375rem, 0.875rem + 0.25vw, 1.0625rem)` | 15–17px |
| `.hero h1` | `clamp(1.5rem, 1rem + 2.5vw, 2.5rem)` | 24–40px |
| `.page-header h1` | `clamp(1.5rem, 1.25rem + 1.25vw, 2rem)` | 24–32px |
| `.section-title` | `clamp(1.25rem, 1.1rem + 0.75vw, 1.5rem)` | 20–24px |
| `.content h2` | `clamp(1.2rem, 1.1rem + 0.5vw, 1.4rem)` | 19–22px |
| `.content h3` | `clamp(1.05rem, 1rem + 0.3vw, 1.15rem)` | 17–18px |
| `.company-name` | `clamp(1.05rem, 1rem + 0.5vw, 1.2rem)` | 17–19px |
| `.company-score` | `clamp(1.5rem, 1.3rem + 1vw, 1.8rem)` | 24–29px |

This eliminates most font-size overrides in the `@media` blocks.

### Line Height
- Body text: `1.6` (already correct)
- Headings (h1, h2): `1.2`
- Subheadings (h3, h4): `1.3`
- Small text / labels / captions: `1.4`

Currently `.hero h1` inherits `1.6` from body — tighten to `1.2` for a more authoritative heading.

### Font Weight Scale
- `400` — body text, descriptions
- `500` — nav links, subtle emphasis
- `600` — subheadings, card titles, labels, strong emphasis
- `700` — h1, h2, company names, scores, logo

### Letter Spacing
- Uppercase labels (`.tier-label`, `.badge-highest`): `0.5px` to `1.5px`
- Normal text: `0` (default)
- Logo: `0.5px`
- No other letter-spacing values.

### Minimum Font Size
Never go below `0.8rem` (12.8px) for any text. Current floor: `.factor-card p` at `0.8rem`.

---

## 3. Spacing System

### The 8px Grid
All padding, margin, and gap values snap to the 8px grid:
`4px, 8px, 16px, 24px, 32px, 48px, 64px`

Use the spacing tokens (`--space-xs` through `--space-3xl`) instead of arbitrary rem values.

### Fluid Section Padding
Replace fixed section padding with `clamp()`:
```css
.section { padding: clamp(2rem, 1.5rem + 2vw, 3rem) 0; }
.hero { padding: clamp(2.5rem, 2rem + 3vw, 4rem) 0; }
.container { padding: 0 clamp(1rem, 0.5rem + 2vw, 1.5rem); }
```
This eliminates the 480px padding overrides.

### Gap Values by Component
| Context | Gap | Token |
|---------|-----|-------|
| Nav links | `2rem` | `--space-xl` |
| Card grids | `1.5rem` | `--space-lg` |
| Steps grid | `2rem` | `--space-xl` |
| Factors grid | `1rem` | `--space-md` |
| Subcategory items | `0.75rem` | (use `--space-sm` + `--space-xs`) |
| Footer nav | `1.5rem` | `--space-lg` |
| Trust stats | `2.5rem` | (use `--space-2xl` + `--space-sm`) |

### Margin Direction
Use `margin-bottom` consistently for vertical rhythm. Avoid combining `margin-top` and `margin-bottom` on the same element.

---

## 4. Layout Patterns

### Container
```css
.container { max-width: var(--max-width); margin: 0 auto; padding: 0 clamp(1rem, 0.5rem + 2vw, 1.5rem); }
```
`--max-width: 1100px` — do not change this value.

### Responsive Grids
Use `auto-fill` + `minmax()` for grids that adapt without media queries:
```css
grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
```

Current grid minimums:
| Grid | Min Column | Notes |
|------|-----------|-------|
| `.category-grid` | `260px` | 4 cols desktop, 1 col mobile |
| `.subcategory-list` | `180px` | 3 cols desktop, 1 col mobile |
| `.team-grid` | `280px` | 3 cols desktop, 1 col mobile |
| `.pros-cons` | `1fr 1fr` | Fixed 2-col, stacks at 768px |

**Fixed-count grids** (acceptable because content count is known):
- `.factors-grid`: `repeat(5, 1fr)` → `repeat(2, 1fr)` at 768px → `1fr` at 480px
- `.steps-grid`: `repeat(3, 1fr)` → `1fr` at 768px

### Content Width
`.content { max-width: 800px; }` for prose pages (about, methodology, contact, privacy, editorial-policy). Optimal line length for readability is 45-75 characters.

### Z-Index
Only two z-index values allowed:
- `z-index: 100` — sticky header
- `z-index: 200` — skip link (when added)

---

## 5. Component Patterns

### Cards
**Standard card:**
```css
border: 1px solid var(--gray-200);
border-radius: var(--radius);
padding: var(--space-lg);   /* 1.5rem */
background: var(--white);
transition: border-color var(--transition-base), box-shadow var(--transition-base), transform var(--transition-base);
```

**Interactive card hover** (category cards, clickable cards):
```css
.card:hover {
  border-color: var(--navy);
  box-shadow: var(--shadow-md);
  transform: translateY(-1px);
}
.card:active {
  transform: translateY(0);
  box-shadow: var(--shadow-sm);
}
```

**Winner card** (`.company-card--winner`):
```css
border: 2px solid var(--gold);
background: linear-gradient(to bottom, #fefcf5, var(--white));
```
Winner score and score bars use `var(--gold)` instead of `var(--navy)`.

### Highest Rated Badge
Gold gradient background (`#f9f3e3` to `#fdf8ee`), 2px gold border, uppercase 0.8rem text, star icon. Matches `badge-highest-rated.svg` palette — keep these synchronized.

### Score Bars
```css
height: 6px;              /* 8px on mobile for touch */
border-radius: 3px;       /* half of height */
background: var(--gray-200);  /* track */
```
Fill color: `var(--navy)` standard, `var(--gold)` for winners. Width set via inline `style="width: XX%"`.

### Pros/Cons
Two-column grid, stacks at 768px. Colors:
- Pros: `background: #eef6ee; border-left: 4px solid #3a8a3a;`
- Cons: `background: #fdf0ef; border-left: 4px solid #c0392b;`

Consider adding these as tokens: `--success: #3a8a3a; --danger: #c0392b;`

### FAQ (`<details>` / `<summary>`)
Current: +/- character swap. Upgrade to CSS chevron rotation:
```css
.faq-item summary::after {
  content: "";
  width: 10px;
  height: 10px;
  border-right: 2px solid var(--text-light);
  border-bottom: 2px solid var(--text-light);
  transform: rotate(45deg);
  transition: transform var(--transition-base);
  flex-shrink: 0;
}
.faq-item[open] summary::after {
  transform: rotate(-135deg);
}
```

### Tables (`.scoring-table`)
On narrow screens, wrap in a scrollable container:
```css
.table-wrapper { overflow-x: auto; -webkit-overflow-scrolling: touch; }
```

### Segment Average Indicator
Gray-50 background, left-aligned label + bold score. No changes needed — clean pattern.

---

## 6. Interactive States

### :hover (mostly implemented)
- Links: `color: var(--gold)`
- Cards: border + shadow + translateY (see Cards section)
- Table rows: `background: var(--gray-50)`
- Nav links: `color: var(--white)` (on dark bg)

### :active (currently missing — add these)
```css
.category-card:active { transform: translateY(0); box-shadow: var(--shadow-sm); }
a:active { opacity: 0.8; }
.nav-toggle:active { opacity: 0.7; }
```

### :focus-visible (currently missing — critical for accessibility)
```css
/* Global focus style */
:focus-visible {
  outline: 2px solid var(--navy);
  outline-offset: 2px;
}

/* On dark backgrounds (header, hero, footer) */
.site-header :focus-visible,
.hero :focus-visible,
.site-footer :focus-visible {
  outline-color: var(--gold);
}

/* Cards get enhanced focus */
.category-card:focus-visible {
  outline: 2px solid var(--navy);
  outline-offset: 2px;
  box-shadow: var(--shadow-md);
}
```

Never use `outline: none`. Never use `:focus` without `:focus-visible` (causes outlines on mouse click).

### Transition Rules
- All interactive state changes must have a `transition` declaration
- Transition only: `color`, `background-color`, `border-color`, `box-shadow`, `transform`, `opacity`
- Never transition: `width`, `height`, `padding`, `margin` (causes layout reflow)
- Duration: `150ms–300ms`. Never exceed `300ms` for hover states.

### Nav Toggle
The hamburger button (`.nav-toggle`) uses `&#9776;` text character. For better cross-browser rendering, replace with a 3-line CSS or inline SVG hamburger icon. Add hover/focus states:
```css
.nav-toggle:hover { opacity: 0.8; }
.nav-toggle:focus-visible { outline: 2px solid var(--gold); outline-offset: 2px; }
```

---

## 7. Responsive Design

### Breakpoints
Two breakpoints only. Do not add more.

**768px** — tablet/small laptop:
- Navigation collapses to hamburger
- Fixed-count grids reduce columns
- Flex layouts stack vertically (company-header, footer, featured-banner)
- Header height: 56px (from 64px)

**480px** — phone:
- Hero padding tightens
- Container padding reduces
- Factors grid goes single-column

### Fluid-First Approach
With `clamp()` handling typography, spacing, and container padding, media queries should only handle:
- Navigation show/hide toggle
- Grid column count changes
- `flex-direction` changes
- Element visibility changes

Everything else adapts fluidly.

### Touch Targets
Minimum interactive element size: `44 x 44px`.

Currently undersized:
- Mobile nav links: add `min-height: 44px; display: flex; align-items: center;`
- FAQ summary: add `min-height: 44px`
- Footer nav links on mobile: add `padding: 0.5rem 0;` for taller tap targets

### Mobile Navigation Animation
Current: instant show/hide via `display: none` / `display: flex` toggle.

Upgrade to smooth slide-down:
```css
.main-nav {
  max-height: 0;
  overflow: hidden;
  transition: max-height var(--transition-slow);
  display: flex;           /* always flex, height controls visibility */
  /* ...existing positioning styles... */
}
.main-nav.open {
  max-height: 300px;       /* large enough to contain all links */
}
```
This requires changing the mobile media query from `display: none` to `max-height: 0`.

### Table Scrolling
For methodology tables on narrow screens:
```css
@media (max-width: 480px) {
  .scoring-table { display: block; overflow-x: auto; }
}
```

---

## 8. Accessibility

### Skip Link (currently missing)
Add to `header.php` as the first element inside `<body>`:
```html
<a href="#main-content" class="skip-link">Skip to main content</a>
```
Add `id="main-content"` to the `<main>` element.

```css
.skip-link {
  position: absolute;
  top: -100%;
  left: var(--space-md);
  background: var(--navy);
  color: var(--white);
  padding: var(--space-sm) var(--space-md);
  border-radius: 0 0 var(--radius) var(--radius);
  z-index: 200;
  font-weight: 600;
  font-size: 0.9rem;
}
.skip-link:focus { top: 0; }
```

### Reduced Motion (currently missing)
Add at the end of `style.css`:
```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

### ARIA
- Nav toggle: add `aria-expanded="false"` attribute, toggle with JS click handler
- Breadcrumbs: `aria-current="page"` already present (correct)
- Company cards: consider wrapping in `<article>` elements (each is a self-contained unit)

### Contrast Fixes
- Footer body text (`.footer-copy`): uses `var(--gray-500)` — verify passes AA on navy, upgrade to `var(--gray-400)` if needed
- Footer nav: uses `var(--gray-400)` — passes AA at 5.5:1
- Gold text: only use on navy backgrounds or at 18px+ bold

### No Dark Mode
The site does NOT implement `prefers-color-scheme: dark`. The navy/white/gold brand identity depends on the light theme. Document this as an intentional decision.

---

## 9. Trust & Credibility Patterns

### Gold Usage Rules
Gold is the **award color**. Use it only for:
- Winner badge and tier label
- Winner's score number and score bars
- Featured/new banner accent
- Logo hover state

Never use gold for: body text, navigation, general links, or decorative elements unrelated to ratings.

### No-Decoration Principle
- No decorative images, stock photos, or illustrations (beyond the 8 category SVG icons)
- No gradient backgrounds in content areas (only hero/header)
- No animation on page load (only on user interaction)
- No rounded avatars or photos on team page
- No ornamental dividers or borders

### Whitespace
- Never reduce section padding below `2rem` on any viewport
- Content areas should breathe — generous margins around headings
- Empty space communicates professionalism and confidence

### Data Display Hierarchy
On ratings pages, visual prominence order:
1. Company name + score (largest, most prominent)
2. Tier label (uppercase, small, contextual)
3. Subcategory score bars (moderate, scannable)
4. Pros/Cons (subordinate, supporting)
5. Analysis paragraph (smallest, detailed)

### Visual Consistency Checklist (for new pages)
- [ ] Uses `.page-header` section with `h1` and subtitle `p`
- [ ] Content wrapped in `.container` (and `.content` for prose)
- [ ] Breadcrumbs via PHP `$breadcrumbs` array
- [ ] Colors from token palette only
- [ ] Spacing aligns to 8px grid
- [ ] Interactive elements have hover + focus-visible states
- [ ] "Last Updated: March 2026" on ratings pages
- [ ] Links to methodology page where scoring is mentioned

---

## Implementation Priority

When applying this skill to improve the site, work in this order:

1. **Add `:focus-visible` styles** — CSS only, biggest accessibility win
2. **Add `prefers-reduced-motion`** — single media query block
3. **Convert to fluid typography** — replace fixed sizes with `clamp()`, remove media query font overrides
4. **Add spacing/shadow/transition tokens to `:root`** — foundation for everything else
5. **Add skip link** — requires `header.php` + CSS changes
6. **Upgrade FAQ chevron animation** — CSS-only polish
7. **Add `:active` states** — small CSS additions
8. **Fluid section padding** — replace fixed padding with `clamp()`
9. **Fix contrast issues** — footer text color audit
10. **Improve mobile nav animation** — CSS transition on max-height
