<?php

function render_testimonials() { 
?>
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
<?php } ?>
