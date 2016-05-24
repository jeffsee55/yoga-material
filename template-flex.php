<?php
/**
 * Template Name: Flex Template
 */

if( have_rows('flex') ):
  while ( have_rows('flex') ) : the_row();
    if( get_row_layout() == 'info_card' ):
      render_info_card( 
        $content = get_sub_field( 'card_content' ),
        $attachment = get_sub_field("card_attachment"),
        $accent = get_sub_field("image_text"),
        $options = array(
          'background_image' => get_sub_field( 'card_background' ),
          'background_size' => get_sub_field( 'card_background_size' ),
          'reverse' => get_sub_field( 'reverse' ),
          'accent_top' => get_sub_field( 'accent_top' ),
          'accent_bottom' => get_sub_field( 'accent_bottom' )
        )
      );
    elseif( get_row_layout() == 'testimonials' ): ?>
      <div class="testimonials__section section-container">
        <h3 class="testimonials__section__header">Testimonials</h3>
        <div class='testimonials'>
          <ul class='testimonials__list'>
            <?php while ( have_rows('quote') ) : the_row();
              echo '<li class="testimonials__list__item">';
                echo '<div class="quote-container">';
                  printf('<div class="quote"><div>%s</div><div class="name">%s</div></div>', get_sub_field('text'), get_sub_field('name'));
                echo '</div>';
              echo '</li>';
            endwhile; ?>
          </ul>
        </div>
      </div>
    <?php elseif( get_row_layout() == 'tabs' ):
      get_template_part( 'templates/tabs' ); ?>
    <?php elseif( get_row_layout() == 'touts' ):
      get_template_part( 'templates/touts' );
    endif;
  endwhile;
endif;
