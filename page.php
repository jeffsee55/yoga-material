<?php
while (have_posts()) : the_post();
  echo '<div class="main-content page card">';
  the_content();
  echo '</div>';
endwhile;
