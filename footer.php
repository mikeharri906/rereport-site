  </main>
  <footer class="site-footer">
    <div class="footer-inner">
      <?php $base = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../' : ''; ?>
      <span class="footer-copy">&copy; 2026 RE Report</span>
      <nav class="footer-nav">
        <a href="<?php echo $base; ?>methodology">Methodology</a>
        <a href="<?php echo $base; ?>about">About</a>
        <a href="<?php echo $base; ?>team">Our Team</a>
        <a href="<?php echo $base; ?>editorial-policy">Editorial Policy</a>
        <a href="<?php echo $base; ?>privacy">Privacy Policy</a>
        <a href="<?php echo $base; ?>contact">Contact</a>
      </nav>
    </div>
  </footer>
</body>
</html>
