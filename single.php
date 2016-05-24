<?php
$attachment = wp_get_attachment_image_src( get_the_id() );

while (have_posts()) : the_post();
  $options = array(
    'background_size' => 'cover',
    'background_image' => '',
    'accent_top' => false,
    'accent_bottom' => false,
    'reverse' => false,
  );
  render_info_card( get_the_content(), $attachment, false, $options );
endwhile;
