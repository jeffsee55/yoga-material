<?php
$attachment = wp_get_attachment_image_src( get_the_id() );

while (have_posts()) : the_post();
  render_info_card( get_the_content(), $attachment, false);
endwhile;
