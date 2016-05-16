<?php
if( !empty( dynamic_sidebar( 'sidebar-primary' ) ) ) {
  echo '<aside class="card">';
    dynamic_sidebar('sidebar-primary');
  echo '</aside>';
}
