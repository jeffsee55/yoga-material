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
        $options = array(
          'reverse' => false,
          'background_image' => get_sub_field( 'card_background' ),
          'background_size' => get_sub_field( 'background_size' )
        )
      );
    endwhile;
  endif;

  render_testimonials();

  $tout_background = get_field( 'tout_background' );
  printf( '<div class="tout-section mdl-grid" style="background-image: url( %s )">', $tout_background);
    if( have_rows('tout') ):
      while ( have_rows('tout') ) : the_row();
        render_tout(
          $title = get_sub_field( 'tout_title' ),
          $image = get_sub_field( 'tout_image' ),
          $text = 'This is a tout about something.',
          $link = 'https://example.com',
          $link_text = 'Learn More'
        );
      endwhile;
    endif;
  echo '</div>';

endwhile;

