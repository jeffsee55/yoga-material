<header class="header mdl-grid">
  <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
  <nav class="main-nav mdl-navigation">
    <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'main-nav__list']);
    endif;
    ?>
  </nav>
</header>
