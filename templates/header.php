<?php use Roots\Sage\Titles; ?>

<?php if( is_front_page() ) : ?>
  <header class="header mdl-grid">
<?php else : ?>
  <header class="header small mdl-grid">
<?php endif; ?>

  <?php if( is_front_page() ) : ?>
    <div class="page-header">
      <a href="/" class="brand-logo"><img src="<?php echo get_theme_mod( 'jsd_material_primary_logo' ); ?>"></a>
      <h1></h1>
    <?php else : ?>
    <div class="page-header small">
      <a href="/" class="brand-logo brand-logo-small"><img src="<?php echo get_theme_mod( 'jsd_material_secondary_logo' ); ?>"></a>
      <?php echo '<h1>' . Titles\title() . '</h1>';
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
