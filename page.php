<?php while (have_posts()) : the_post();
  if( have_rows('card_info') ):
    while ( have_rows('card_info') ) : the_row();
      render_info_card( 
        $content = the_sub_field('card_content'),
        $image = the_sub_field('card_attachment'),
        $reverse = false 
      );
      the_content();
    endwhile;
  endif;
endwhile;
