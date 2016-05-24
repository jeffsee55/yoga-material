<section class="section-container card__section">
  <div class="card mdl-grid">
    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
      <div class="mdl-tabs__tab-bar">
      <?php 
        $index = 0;
        while ( have_rows('tab') ) : the_row(); $index++;
          if( $index == 1 ) :
            $class = 'is-active';
          else : 
            $class = '';
          endif;
          $id = 'tab' + $index; ?>
          <a href="#<?php echo 'tab-' . $id; ?>" class="mdl-tabs__tab <?php echo $class; ?>"><?php echo get_sub_field('tab_title'); ?></a>
        <?php endwhile; $index = 0; ?>
      </div>

      <?php while ( have_rows('tab') ) : the_row(); $index++;
        if( $index == 1 ) :
          $class = 'is-active';
        else : 
          $class = '';
        endif;
        $id = 'tab-' . $index; ?>
        <div class="mdl-tabs__panel <?php echo $class; ?>" id="<?php echo $id; ?>">
          <div class="info-card__text-container">
            <?php the_sub_field( 'tab_content' ); ?>
            <ul class="mdl-list">
              <?php while ( have_rows('programs') ) : the_row(); ?>
                <li class="mdl-list__item mdl-list__item--three-line">
                  <span class="mdl-list__item-primary-content">
                    <?php
                      if( get_sub_field( 'program_icon' ) ) :
                        $program_icon_url = get_sub_field( 'program_icon' );
                      else :
                        $program_icon_url = site_url() . '/wp-content/uploads/2016/05/default-ball.png';
                      endif;
                    ?>
                    <div class="material-icons mdl-list__item-avatar"><img src="<?php echo $program_icon_url; ?>" class="program-icon"></div>
                    <span><?php the_sub_field( 'program_title' ); ?></span>
                    <span class="mdl-list__item-text-body">
                      <?php the_sub_field( 'program_content' ); ?>
                    </span>
                  </span>
                  <span class="mdl-list__item-secondary-content">
                    <a href="<?php echo get_sub_field('program_link'); ?>" class="mdl-list__item-secondary-action mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                      Enquire
                    </a>
                  </span>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
