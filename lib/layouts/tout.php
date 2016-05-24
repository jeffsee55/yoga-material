<?php

function render_tout( $title, $image, $text ) {
  $output = '<div class="tout-card mdl-cell mdl-cell--4-col">';
  $output .= sprintf( '<h3>%s</h3>', $title);
  $output .= sprintf( '<img src=%s>', $image);
  $output .= $text;
  $output .= '</div>';
  echo $output;
}
