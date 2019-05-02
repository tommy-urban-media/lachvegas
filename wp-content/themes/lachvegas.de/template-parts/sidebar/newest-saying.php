<?php

$sayingArgs = array(
	'post_type' => array('saying'),
  'posts_per_page' => 2
);
$sayingsQuery = new WP_Query($sayingArgs);

?>

<section class="newest-saying section-sidebar" style="padding: 0;">
  <?php if ($sayingsQuery->have_posts()): ?>
    <?php while ( $sayingsQuery->have_posts() ) : $sayingsQuery->the_post(); setup_postdata($post)?>
      <?php if (has_post_thumbnail($post->ID)): ?>
        <a href="<?= get_the_permalink( $post->ID )?>">
          <figure class="image image--sidebar">
            <?php the_post_thumbnail( 'thumbnail' ); ?>
          </figure>
        </a>
      <?php endif ?>
    <?php endwhile ?>
  <?php endif ?>
  <?php wp_reset_query(); ?>
  <p style="padding: 20px;">
    <a href="<?= home_url('/') ?>sprueche"> &raquo; Die Beklopptesten Sprüche auf einen Blick</a>
  </p>
</section>