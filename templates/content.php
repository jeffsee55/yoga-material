<article class="card post-card" <?php post_class(); ?>>
  <?php
    if(has_post_thumbnail()) {
      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
      $thumb_url = $thumb_url_array[0];
    } else {
      $thumb_url = site_url() . '/wp-content/uploads/2016/03/butler-logo-batak.jpg';
    };
  ?>
  <div class="entry-image" style="background-image: url(<?php echo $thumb_url; ?>)"></div>
  <div class="entry-content">
    <header>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>
