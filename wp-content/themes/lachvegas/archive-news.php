<?php get_header() ?>

<?php 

$today = getdate();

$count = 50; //get_option('posts_per_page', 50);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$newsArgs = array(
	'posts_per_page' => 50,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => 'news',
	'posts_per_page' => 50,
	'date_query' => array(
		'before' => date('Y-m-d', strtotime('+1 day', time()))
	)
	/*
  'date_query' => array(
    array(
      'year' => 2020,
      'month' => $today['mon'],
      'day' => $today['mday']
    ),
    array(
      'year' => 2020,
      'month' => $today['mon']-1,
    ),
    array(
      'year' => 2019,
      'month' => $today['mon'],
      'day' => $today['mday']
    ),
    array(
      'year' => 2019,
      'month' => $today['mon']-1
    ),
    array(
      'year' => 2018,
      'month' => $today['mon']
    ),
    array(
      'year' => 2018,
      'month' => $today['mon']-1
    ),
    'relation' => 'OR'
	)
	*/
);
$newsQuery = new WP_Query($newsArgs);

$posts = array();

while ($newsQuery->have_posts()) {
  $newsQuery->the_post(); 
  setup_postdata($post);
  $posts[] = $post;
}

usort($posts, 'fnn');

?>
<div class="content content-wrapper">
	
	<?php if ($description = get_the_archive_description()): ?>
		<div class="category-description">
			<?php echo $description ?>
		</div>
	<?php endif ?>

	<?php if ($newsQuery->have_posts()) : ?>

	<div class="content__area">
		<div class="content__area--wide">

			<h1 class="category-title"><?= str_replace( array('Archives:', 'Archive:'), "", get_the_archive_title()); ?></h1>

			<?php if ($newsQuery->have_posts()): ?>

				<ol class="news-list">
					<?php $i = 0; ?>
					<?php while ( $newsQuery->have_posts() ) : $newsQuery->the_post(); setup_postdata($post)?>
						<?php /* ?>
						<?php if ($i == 4): ?>
							<li class="list-item">
								<?php showAD('banner'); ?>
							</li>
						<?php endif ?>
						<?php */ ?>
						<li class="news-list__item">
							<?php get_template_part('template-parts/teasers/teaser-news') ?>
						</li>
					<?php $i++ ?>
					<?php endwhile; ?>
				</ol>

				<?php // echo $newsQuery->max_num_pages ?>
				<?php echo getPagination($newsQuery, $paged, true, false)?>

				<!--
				<nav class="pagination">
					<span class="previous-posts">
						<?php previous_posts_link('&laquo;'); ?>
					</span>
					<span class="next-posts">
						<?php next_posts_link('&raquo;'); ?>
					</span>
				</nav>
				-->

				<?php wp_reset_postdata();?>

			<?php endif; ?>

		</div>
		<div class="content__area--secondary">
			<?php // echo get_template_part('sidebar')?>
		</div>
	</div>

	<?php endif ?>

	<?php //get_template_part('template-parts/common/news-archive') ?>
	<?php get_template_part('template-parts/sections/newsletter') ?>
	<?php get_template_part('template-parts/sections/promis') ?>


</div><!-- .content -->

<?php get_footer(); ?>
