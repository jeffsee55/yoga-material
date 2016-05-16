<?php use Roots\Sage\Titles; ?>

<header class="header mdl-grid">

  <div class="page-header">
    <?php if( is_front_page() ) :
      echo '<img class="brand-logo" src="' . get_template_directory_uri() . '/dist/images/yogawareness.png">';
    else :
      echo '<img class="brand-logo brand-logo-small" src="' . get_template_directory_uri() . '/dist/images/yogawareness.png">';
      echo '<h1>' . Titles\title() . '</h1>';
    endif; ?>
  </div>

  <nav class="main-nav mdl-navigation">
    <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'main-nav__list']);
    endif;
    ?>
  </nav>

</header>
