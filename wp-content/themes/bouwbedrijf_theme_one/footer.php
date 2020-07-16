<footer>
      <div class="footer">
            <div class="container">
                  <div class="row">
                        <div class="footer__menu col-md-4">
                              <h2>Contact opnemen</h2>
                              <ul>
                              <li><i class="fas fa-phone"></i><?php echo get_theme_mod('business_phone')?></li><br>
                              <li><i class="fas fa-envelope"></i><?php echo get_theme_mod('business_email')?></li><br>
                              <li><i class="fas fa-home"></i><?php echo get_theme_mod('business_street')?>, <?php echo get_theme_mod('business_postalcode')?>, <?php echo get_theme_mod('business_residence')?></li><br>
                              </ul>
                        </div>
                        <div class="footer__menu col-md-4">
                              <h2>Werkzaamheden</h2>
                              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu1', 'container_class' => 'footermenu' ) ); ?>
                        </div>
                        <div class="footer__menu col-md-4">
                              <h2>Projecten</h2>
                              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu2', 'container_class' => 'footermenu' ) ); ?>
                        </div>
                  </div>
      </div>
    </div>
    </div>
    <div class="container-fluid">
    <div class="footer__bottom row">
            <div class="col d-flex justify-content-center">
                  <span>Deze website is gerealiseerd door <a href="http://www.bouwbedrijf.online" class="link--primary" target="_blank">bouwbedrijf.online</a></span>
            </div>
    </div>
    </footer>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
    <?php wp_footer(); ?>
    </body>
    </html>