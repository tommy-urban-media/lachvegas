<?php

$mostViewedArgs = array(
	'post_type' => array('post', 'quiz'),
  'posts_per_page' => 1,
  'orderby' => 'rand'
);
$mostViewedArticlesQuery = new WP_Query($mostViewedArgs);

?>

<section class="most-viewed-articles section-sidebar">
  <?php if ($mostViewedArticlesQuery->have_posts()): ?>
    <h3>Bekloppter Zufallsbeitrag</h3>
    <?php while ( $mostViewedArticlesQuery->have_posts() ) : $mostViewedArticlesQuery->the_post(); setup_postdata($post)?>
        <a href="<?= get_the_permalink( $post->ID )?>">
          <?php the_title() ?>
        </a>
    <?php endwhile ?>
  <?php endif ?>
  <?php wp_reset_query(); ?>
</section>