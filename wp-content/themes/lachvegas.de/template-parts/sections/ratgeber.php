<?php 

$ratgeberQuery = new WP_Query( 
  array(
    'posts_per_page' => 12, 
    'post_type' => array('post'),
    'category_name' => '10-dinge'
  ) 
); 

?>

<?php if ($ratgeberQuery->have_posts()): ?>
<section class="section section--ratgeber">
  <div class="section__pane">
    <div class="section__content">

      <h3 class="teasers-ratgeber-headline">
        <span class="teasers-ratgeber-headline__text">Ratgeber</span>
      </h3>

      <p class="teasers-ratgeber-subheadline">Guter Rat ist teuer heißt es. Bei uns ist er kostenlos</p>

      <ol class="teasers-ratgeber">
        <?php $i = 0; ?>
        <?php while ( $ratgeberQuery->have_posts() ) : $ratgeberQuery->the_post(); setup_postdata($post)?>
          <li class="teasers-ratgeber__item">

            <!--
            <?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
            <span class="post-meta"><?= $subtitle ?></span>
            <?php endif ?>
            -->

            <article class="article-box">
              
              <a class="article-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
                <?php if ($i < 4):?>
                  <figure class="image-wrapper">
                    <?php if (has_post_thumbnail()):?>
                      <?php the_post_thumbnail('article_thumbnail')?>
                    <?php endif ?>
                  </figure> 
                <?php endif ?>

                <?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
                  <span class="article-link-subtitle"><?= $subtitle ?></span>
                <?php endif ?>
                <span class="article-link-title"><?php the_title() ?></span>
              </a>

              <!-- 
              <a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
                <span class="news-title"><?php the_title() ?></span>
              </a>
              -->

              <!-- <span class="post-date"><?php echo the_date('d.m.Y')?></span> -->
              <?php //echo custom_excerpt(get_the_excerpt($post->ID), 16) ?>

            </article>
          </li>

        <?php $i++ ?>
        <?php endwhile; ?>
      </ol>

    </div>
  </div>
</section>
<?php endif ?>