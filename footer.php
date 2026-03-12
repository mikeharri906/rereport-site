  </main>
  <?php $base = (strpos($_SERVER['REQUEST_URI'], '/ratings/') !== false) ? '../' : ''; ?>

  <button class="back-to-top" aria-label="Back to top" onclick="window.scrollTo({top:0,behavior:'smooth'})">&#8593;</button>
  <script>
  (function(){var b=document.querySelector('.back-to-top');if(!b)return;window.addEventListener('scroll',function(){b.classList.toggle('visible',window.scrollY>400)},{passive:true})})();
  (function(){var d=document.querySelector('.nav-dropdown');if(!d||window.innerWidth>768)return;d.querySelector('.nav-dropdown-trigger').addEventListener('click',function(e){if(window.innerWidth<=768){e.preventDefault();d.classList.toggle('open')}})})();
  </script>

  <footer class="site-footer">
    <div class="footer-grid">
      <div class="footer-about">
        <h4>RE Report</h4>
        <p>Independent ratings and research for real estate companies across all major categories. Our analysts evaluate companies using public data, consumer reviews, and regulatory records. No advertising, no affiliate relationships, no paid placements.</p>
      </div>
      <div class="footer-col">
        <h4>Categories</h4>
        <a href="<?php echo $base; ?>ratings/cash-land-buyers">Cash Land Buyers</a>
        <a href="<?php echo $base; ?>ratings/cash-home-buyers">Cash Home Buyers</a>
        <a href="<?php echo $base; ?>ratings/ibuyers">iBuyers</a>
        <a href="<?php echo $base; ?>ratings/mortgage-lenders">Mortgage Lenders</a>
        <a href="<?php echo $base; ?>ratings/title-companies">Title Companies</a>
        <a href="<?php echo $base; ?>ratings/real-estate-agents">Real Estate Agents</a>
        <a href="<?php echo $base; ?>ratings/property-management">Property Management</a>
        <a href="<?php echo $base; ?>ratings/hard-money-lenders">Hard Money Lenders</a>
      </div>
      <div class="footer-col">
        <h4>Resources</h4>
        <a href="<?php echo $base; ?>methodology">Methodology</a>
        <a href="<?php echo $base; ?>editorial-policy">Editorial Policy</a>
        <a href="<?php echo $base; ?>team">Our Team</a>
        <a href="<?php echo $base; ?>about">About RE Report</a>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <a href="mailto:info@rereport.org">info@rereport.org</a>
        <a href="<?php echo $base; ?>contact">Contact Page</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span class="footer-copy">&copy; 2026 RE Report. All rights reserved.</span>
      <nav class="footer-legal">
        <a href="<?php echo $base; ?>privacy">Privacy Policy</a>
        <a href="<?php echo $base; ?>editorial-policy">Editorial Policy</a>
      </nav>
    </div>
  </footer>
</body>
</html>
