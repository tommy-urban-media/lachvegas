<?php 

$sayingsQuery = new WP_Query( 
  array(
    'posts_per_page' => 6, 
    'post_type' => array('saying')
  ) 
); 

?>


<?php if ($sayingsQuery->have_posts()): ?>
<section class="section section--sayings">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title">Die beklopptesten Sprüche</h3>
      <span class="section__separator"></span>
    </header>
    <div class="section__content">

      <div class="slider-wrapper">
        <ol class="slider">
          <?php $i = 0; ?>
          <?php while ( $sayingsQuery->have_posts() ) : $sayingsQuery->the_post(); setup_postdata($post)?>
            <li class="slider__item">

              <div class="post-content">
                <?php if (has_post_thumbnail()):?>
                  <a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID); ?>">
                    <figure class="slider__image">
                      <?php the_post_thumbnail('thumbnail')?>
                    </figure>
                  </a>
                <?php endif ?>
              
              </div>
            </li>

          <?php $i++ ?>
          <?php endwhile; ?>
        </ol>
      </div>

    </div>
    <footer class="section__footer">
      <a href="<?= home_url() ?>/sprueche" class="button button__section"><span>Alle Sprüche</span><i class="icon fa fa-angle-double-right"></i></a>
    </footer>
  </div>
</section>
<?php endif ?>