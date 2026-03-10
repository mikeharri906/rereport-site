  </main>
  <footer class="site-footer">
    <div class="footer-inner">
      <?php $base = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../' : ''; ?>
      <span class="footer-copy">&copy; 2026 RE Report</span>
      <nav class="footer-nav">
        <a href="<?php echo $base; ?>methodology.html">Methodology</a>
        <a href="<?php echo $base; ?>about.html">About</a>
        <a href="<?php echo $base; ?>team.html">Our Team</a>
        <a href="<?php echo $base; ?>editorial-policy.html">Editorial Policy</a>
        <a href="<?php echo $base; ?>privacy.html">Privacy Policy</a>
        <a href="<?php echo $base; ?>contact.html">Contact</a>
      </nav>
    </div>
  </footer>
</body>
</html>
