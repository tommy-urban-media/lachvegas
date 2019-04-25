<?php

$args = array(
	'posts_per_page' => 6,
	'date_query' => array(
		array(
			'year' => array(2017, 2018, 2019, 2020)
		)
	),
	'post_type' => array('guide', /*'news',*/ 'post', 'poem', /*'saying', 'statistic',*/ 'quiz'),
	//'category__not_in' => array(64) // Produkte
);

$queryNews = new WP_Query($args);


$oldPosts = get_posts(array(
	'posts_per_page' => -1,
	'post_type' => array('guide', /*'news',*/ 'post', 'poem', /*'statistic',*/ 'quiz'),
	'date_query' => array(
		array(
			'month' => date('m'),
			'day' => date('d')
		)
	),
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'post_settings',
			'field' => 'name',
			'terms' => array('repeatable')
		)
	)
));

/*
foreach($oldPosts as $p) {
	wp_update_post(array(
		'ID' => $p->ID,
		'post_date' => date('Y-m-d 06:00:00')
	));
}
*/
?>

<?php if ( $queryNews->have_posts() ) : ?>
<div class="related-posts">
  <h4>Die Neuesten Beiträge</h4>
  <ol class="related-posts__list">
    <?php $i = 0; ?>
    <?php while ( $queryNews->have_posts() ) : $queryNews->the_post(); setup_postdata($post)?>
      <li class="related-posts__list__item">
        <?php get_template_part('template-parts/teasers/teaser-related-posts-list') ?>
      </li>
    <?php $i++ ?>
    <?php endwhile; ?>
  </ol>
</div>
<?php endif ?>