<?php 

$ratgeberQuery = new WP_Query( 
  array(
    'posts_per_page' => 3, 
    'post_type' => array('guide')
  ) 
); 

?>

<?php if ($ratgeberQuery->have_posts()): ?>
<section class="section section--ratgeber">
  <div class="section__pane">
    <header class="section__header">
      <h3 class="section__title">Ratgeber</h3>
      <span class="section__separator"></span>
    </header>
    <div class="section__content">
      <ol class="list list--teaser">
        <?php $i = 0; ?>
        <?php while ( $ratgeberQuery->have_posts() ) : $ratgeberQuery->the_post(); setup_postdata($post)?>
          <li class="list-item">

            <!--
            <?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
            <span class="post-meta"><?= $subtitle ?></span>
            <?php endif ?>
            -->

            <div class="post-content">
              <?php if (has_post_thumbnail()):?>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
                  <figure class="post-image post-image--teaser">
                    <?php the_post_thumbnail('article_thumbnail')?>
                  </figure>
                </a>
              <?php endif ?>
              
              <a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
                <span class="news-title"><?php the_title() ?></span>
              </a>

              <!-- <span class="post-date"><?php echo the_date('d.m.Y')?></span> -->
              <?php echo custom_excerpt(get_the_excerpt($post->ID), 16) ?>

            </div>
          </li>

        <?php $i++ ?>
        <?php endwhile; ?>
      </ol>
    </div>
    <footer class="section__footer">
      <a href="<?= home_url() ?>/ratgeber" class="button button__section"><span>Mehr aus diesem Bereich</span><i class="icon fa fa-angle-double-right"></i></a>
    </footer>
  </div>
</section>
<?php endif ?>