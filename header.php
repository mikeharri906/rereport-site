<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="index, follow">
  <meta name="referrer" content="strict-origin-when-cross-origin">
  <?php if (!isset($page_css_path)) $page_css_path = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../style.css' : 'style.css'; ?>
  <?php if (isset($page_title)): ?>
  <title><?php echo $page_title; ?></title>
  <?php endif; ?>
  <?php if (isset($page_description)): ?>
  <meta name="description" content="<?php echo $page_description; ?>">
  <?php endif; ?>
  <?php if (isset($page_canonical)): ?>
  <link rel="canonical" href="<?php echo $page_canonical; ?>">
  <?php endif; ?>
  <?php if (isset($page_title)): ?>
  <meta property="og:title" content="<?php echo $page_title; ?>">
  <?php endif; ?>
  <?php if (isset($page_description)): ?>
  <meta property="og:description" content="<?php echo $page_description; ?>">
  <?php endif; ?>
  <?php if (isset($page_canonical)): ?>
  <meta property="og:url" content="<?php echo $page_canonical; ?>">
  <?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="RE Report">
  <meta property="og:image" content="https://rereport.org/og-image.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <?php if (isset($page_title)): ?>
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo $page_title; ?>">
  <?php endif; ?>
  <?php if (isset($page_description)): ?>
  <meta name="twitter:description" content="<?php echo $page_description; ?>">
  <?php endif; ?>
  <meta name="twitter:image" content="https://rereport.org/og-image.jpg">
  <?php if (isset($page_article_dates)): ?>
  <meta property="article:published_time" content="<?php echo $page_article_dates['published']; ?>">
  <meta property="article:modified_time" content="<?php echo $page_article_dates['modified']; ?>">
  <meta property="article:author" content="RE Report">
  <?php endif; ?>
  <link rel="icon" type="image/svg+xml" href="<?php echo $base ?? ''; ?>favicon.svg">
  <link rel="stylesheet" href="<?php echo $page_css_path; ?>?v=2">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "@id": "https://rereport.org/#organization",
    "name": "RE Report",
    "url": "https://rereport.org",
    "description": "Independent ratings and reviews for real estate companies across all major categories.",
    "logo": "https://rereport.org/favicon.svg"
  }
  </script>
  <?php if (isset($page_schema)): ?>
  <script type="application/ld+json">
  <?php echo $page_schema; ?>
  </script>
  <?php endif; ?>
  <?php if (isset($page_faq_schema)): ?>
  <script type="application/ld+json">
  <?php echo $page_faq_schema; ?>
  </script>
  <?php endif; ?>
  <?php if (isset($page_review_schema)): ?>
  <script type="application/ld+json">
  <?php echo $page_review_schema; ?>
  </script>
  <?php endif; ?>
  <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
  <script type="application/ld+json">
  <?php
    $bc_items = [];
    $bc_items[] = '{"@type":"ListItem","position":1,"name":"Home","item":"https://rereport.org/"}';
    $bc_pos = 2;
    foreach ($breadcrumbs as $i => $crumb) {
      if ($i === array_key_last($breadcrumbs)) {
        $bc_items[] = '{"@type":"ListItem","position":' . $bc_pos . ',"name":"' . $crumb['label'] . '"}';
      } else {
        $bc_url = isset($crumb['url']) ? 'https://rereport.org' . $crumb['url'] : '';
        $bc_items[] = '{"@type":"ListItem","position":' . $bc_pos . ',"name":"' . $crumb['label'] . '","item":"' . $bc_url . '"}';
      }
      $bc_pos++;
    }
    echo '{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[' . implode(',', $bc_items) . ']}';
  ?>
  </script>
  <?php endif; ?>
</head>
<body>
  <a href="#main-content" class="skip-link">Skip to main content</a>
  <header class="site-header">
    <div class="header-inner">
      <?php
        $base = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../' : '';
      ?>
      <a href="<?php echo $base; ?>index.html" class="site-logo">RE Report</a>
      <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" onclick="this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'); document.querySelector('.main-nav').classList.toggle('open')">&#9776;</button>
      <nav class="main-nav">
        <a href="<?php echo $base; ?>ratings/cash-land-buyers.html">Ratings</a>
        <a href="<?php echo $base; ?>methodology.html">Methodology</a>
        <a href="<?php echo $base; ?>about.html">About</a>
        <a href="<?php echo $base; ?>contact.html">Contact</a>
      </nav>
    </div>
  </header>
  <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
  <nav class="breadcrumbs" aria-label="Breadcrumb">
    <div class="container">
      <ol>
        <li><a href="<?php echo $base; ?>index.html">Home</a></li>
        <?php foreach ($breadcrumbs as $crumb): ?>
        <?php if (isset($crumb['url'])): ?>
        <li><a href="<?php echo $crumb['url']; ?>"><?php echo $crumb['label']; ?></a></li>
        <?php else: ?>
        <li aria-current="page"><?php echo $crumb['label']; ?></li>
        <?php endif; ?>
        <?php endforeach; ?>
      </ol>
    </div>
  </nav>
  <?php endif; ?>
  <main id="main-content">
