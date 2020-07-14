<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bouwbedrijf thema one</title>
  <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-grid.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/css/all.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
  <?php wp_head();?>
</head>

<body>
<header>
      <div class="header container-fluid">
        <div class="header__topbar row d-none d-md-flex">
          <ul>
            <li><?php echo get_theme_mod('business_phone')?></li>
            <li><?php echo get_theme_mod('business_email')?></li>
            <li><?php echo get_theme_mod('business_street')?>, <?php echo get_theme_mod('business_postalcode')?>, <?php echo get_theme_mod('business_residence')?></li>
          </ul>
        </div>
        <div class="header__main row">
          <div class="header__logo">
          <img src="<?php echo esc_url( get_theme_mod( 'logo' ) ); ?>" alt="logo" />
          </div>
          <?php
				  wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'header__menu' ) );
		    ?>
          <div class="header__mobile d-flex d-md-none">
            <div class="header__icons">
            <a href="tel:<?php echo get_theme_mod('business_phone')?>"><i class="fas fa-phone"></i></a>
              <a href="mailto:<?php echo get_theme_mod('business_email')?>"><i class="fas fa-envelope"></i></A>
            </div>
            <div class="header__hamburger">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>         
        </div>
      </div>
    </header>    