<footer>
<div class="footer row">
      <div class="footer__menu">
      <h2>Contact opnemen?</h2>
      <ul>
      <li><?php echo get_theme_mod('business_phone')?></li>
            <li><?php echo get_theme_mod('business_email')?></li>
            <li><?php echo get_theme_mod('business_street')?>, <?php echo get_theme_mod('business_postalcode')?>, <?php echo get_theme_mod('business_residence')?></li>
      </ul>
      </div>
      <div class="footer__menu">
      <h2>Werkzaamheden</h2>
      <?php wp_nav_menu( array( 'theme_location' => 'footer-menu1', 'container_class' => 'footermenu' ) ); ?>
      </div>
      <div class="footer__menu">
      <h2>Projecten</h2>
      <?php wp_nav_menu( array( 'theme_location' => 'footer-menu2', 'container_class' => 'footermenu' ) ); ?>
      </div>
    </div>
    </footer>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
    <?php wp_footer(); ?>
    </body>
    </html>