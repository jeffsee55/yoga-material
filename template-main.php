<?php
/**
 * Template Name: Main Template
 */

while (have_posts()) : the_post();
  if( have_rows('info_card') ):
    while ( have_rows('info_card') ) : the_row();
        render_info_card( 
          $content = get_sub_field( 'card_content' ),
          $attachment = get_sub_field("card_attachment"),
          $accent = get_sub_field("accent"),
          $options = array(
            'reverse' => false,
            'background_image' => get_sub_field( 'card_background' ),
            'background_size' => get_sub_field( 'background_size' ),
            'reverse' => get_sub_field( 'reverse' ),
            'order' => get_sub_field('order')
          )
        );
    endwhile;
  endif;

  if( have_rows('testimonial') ):
    render_testimonials();
  endif;

  if( have_rows('tout') ):
    $tout_background = get_field( 'tout_background' );
    $order = ( !empty( get_field('tout_order') ) ) ? get_field('tout_order') : '1';

    printf( '<div class="tout__section section-container slant" style="background-image: url( %s ); order: %s">', $tout_background, $order);
      echo '<h4>' . get_field('tout_title') . '</h4>';
      echo '<div class="mdl-grid">';
      while ( have_rows('tout') ) : the_row();
        render_tout(
          $title = get_sub_field( 'tout_title' ),
          $image = get_sub_field( 'tout_image' ),
          $text = get_sub_field( 'tout_text' ),
          $link = get_sub_field( 'tout_link' ),
          $link_text = get_sub_field( 'tout_link_text' )
        );
      endwhile;
    echo '</div>';
    echo '</div>';
  endif;

endwhile;
