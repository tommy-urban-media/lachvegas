<?php

$mostViewedArgs = array(
	'post_type' => array('post', 'quiz', 'poem'),
  'posts_per_page' => 3,
  'orderby' => array( 
    'meta_value_num' => 'DESC'
  ),
  'meta_key' => 'post_views_count'
);
$mostViewedArticlesQuery = new WP_Query($mostViewedArgs);

?>

<section class="most-viewed-articles section-sidebar">
  <?php if ($mostViewedArticlesQuery->have_posts()): ?>
    <h3>Beliebteste Beiträge</h3>
    <ol class="most-viewed-articles__list">
      <?php while ( $mostViewedArticlesQuery->have_posts() ) : $mostViewedArticlesQuery->the_post(); setup_postdata($post)?>
        <li>
          <a href="<?= get_the_permalink( $post->ID )?>">
            <?php the_title() ?>
          </a>
        </li>
      <?php endwhile ?>
    </ol>
  <?php endif ?>
  <?php wp_reset_query(); ?>
</section>