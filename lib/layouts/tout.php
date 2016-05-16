<?php

function render_tout( $title, $image, $text, $link, $link_text) {
  $output = '<div class="tout-card mdl-cell mdl-cell--4-col">';
  $output .= sprintf( '<h3>%s</h3>', $title);
  $output .= sprintf( '<img src=%s>', $image);
  $output .= sprintf( '<p>%s</p>', $text );
  if( !empty( $link && $link_text ) )
    $output .= sprintf( '<a class="mdl-button mdl-button--primary mdl-js-button mdl-js-ripple-effect" href="%s">%s</a>', $link, $link_text);
  $output .= '</div>';
  
  
  echo $output;
}
