<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="index, follow">
  <?php if (!isset($page_css_path)) $page_css_path = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../style.css' : 'style.css'; ?>
  <link rel="stylesheet" href="<?php echo $page_css_path; ?>">
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
  <link rel="icon" type="image/svg+xml" href="<?php echo $base ?? ''; ?>favicon.svg">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
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
</head>
<body>
  <header class="site-header">
    <div class="header-inner">
      <?php
        $base = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../' : '';
      ?>
      <a href="<?php echo $base; ?>index.html" class="site-logo">RE Report</a>
      <button class="nav-toggle" aria-label="Toggle navigation" onclick="document.querySelector('.main-nav').classList.toggle('open')">&#9776;</button>
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
  <main>
