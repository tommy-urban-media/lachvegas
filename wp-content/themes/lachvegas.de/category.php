<?php 

get_header();

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 10,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('news', 'post', 'saying', 'guide', 'poem', 'quiz'),
	'cat' => get_queried_object_id(),
	//'category_name' => get_cat_name( $cat ),
	'date_query' => array(
		'relation' => 'OR',
		'before' => date('Y-m-d H:i', strtotime('+1 day'))
	),
	'order_by' => 'date', 
	'order' => 'DESC',
);

$query = new WP_Query($args)
?>


<div class="content content-home">

	<?php if ($categoryDescription = category_description($cat)): ?>
		<div class="category-description">
			<?php echo $categoryDescription ?>
		</div>
	<?php endif ?>

	<div class="content__area">
		<div class="content__area--primary">

			<?php if ( $query->have_posts() ) : ?>
				<h1><?php echo single_cat_title() ?></h1>
				<?php if ($query->have_posts()): ?>

					<ol class="list list--news">
						<?php $i = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
							<?php if ($i == 4): ?>
								<li class="list-item">
									<?php showAD('banner'); ?>
								</li>
							<?php endif ?>
							<li class="list-item">
								<?php get_template_part('template-parts/teasers/teaser-article-list') ?>
							</li>
						<?php $i++ ?>
						<?php endwhile; ?>
					</ol>
			
					<?php echo getPagination($query, $paged, true, $cat)?>
					<?php wp_reset_postdata();?>

				<?php endif; ?>

			<?php else: ?>

				<p>
					In dieser Kategorie gibt es noch keine Einträge. Sei der/die Erste und schlage etwas vor was wir hier reinpacken können
					<a href="mailto:info@lachvegas.de">info@lachvegas.de</a>
				</p>

			<?php endif ?>
		</div>

		<div class="content__area--secondary">
			<?php echo get_template_part('sidebar')?>
		</div>
	</div>

	<?php global $category_name; $category_name = get_cat_name( $cat )?>
	<?php get_template_part('template-parts/sections/news') ?>
	<?php get_template_part('template-parts/sections/gender') ?>

</div><!-- .content -->

<?php get_footer(); ?>
