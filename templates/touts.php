<?php
$tout_background = get_sub_field( 'tout_background' );
$background_size = get_sub_field( 'tout_background_size' );
$slant = ( get_sub_field('accent_top') == true ) ? 'slant-top' : '';
$slant .= ( get_sub_field('accent_bottom') == true ) ? ' slant-bottom' : '';
printf( '<div class="tout__section section-container %s" style="background-image: url( %s ); background-size: %s">', $slant, $tout_background, $background_size );
  echo '<h4>' . get_sub_field('touts_title') . '</h4>';
  echo '<div class="mdl-grid">';
  while ( have_rows('tout') ) : the_row();
    render_tout(
      $title = get_sub_field( 'tout_title' ),
      $image = get_sub_field( 'tout_image' ),
      $text = get_sub_field( 'tout_text' )
    );
  endwhile;
echo '</div>';
echo '</div>';
