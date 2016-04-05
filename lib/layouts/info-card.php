<?php

function render_info_card( $content, $attachment, $options) {
  $background_image = !empty( $options['background_image'] ) ? $options['background_image'] : get_template_directory_uri() . '/dist/images/stardust.png';
  $background_size = ( !empty($options['background_size']) && $options['background_size'] == 'Full') ? 'cover' : 'auto';
  $section = sprintf( '<section class="section-container card-section" style="background-image: url(%s); background-size: %s">', $background_image, $background_size);
  $output = $section;
  $output .= '<div class="info-card mdl-grid">';

  if( $options['reverse'] == true ) :
    $output .= '<div class="info-card__image-container mdl-cell mdl-cell--5-col">';
    $output .= sprintf( '<img src=%s>', $attachment);
    $output .= '</div>';
    $output .= '<div class="info-card__text-container mdl-cell mdl-cell--7-col">';
    $output .= $content;
    $output .= '</div>';
  else :
    $output .= '<div class="info-card__text-container mdl-cell mdl-cell--7-col">';
    $output .= $content;
    $output .= '</div>';
    $output .= '<div class="info-card__image-container mdl-cell mdl-cell--5-col">';
    $output .= sprintf( '<img src=%s>', $attachment);
    $output .= '</div>';
  endif;

  $output .= '</div>';
  $output .= '</section>';

  echo $output;

} ?>
