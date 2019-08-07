<?php 

get_header();

$count = get_option('posts_per_page', 50);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 50,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('joke'),
	'cat' => get_queried_object_id()
);

$query = new WP_Query($args)
?>


<div class="content content-home">

	<?php get_template_part('template-parts/common/breadcrumb') ?>
 
	<?php if ($categoryDescription = category_description($cat)): ?>
		<div class="category-description">
			<?php echo $categoryDescription ?>
		</div>
	<?php endif ?>

	<div class="content__area">
		<div class="content__area--wide">

			<?php get_template_part('partials/menu/joke-menu') ?>

			<?php if ( $query->have_posts() ) : ?>
				<h1><?php echo single_cat_title() ?></h1>
				<?php if ($query->have_posts()): ?>

					<ol class="joke-list">
						<?php $i = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
							<li class="joke-list__item">
								<?php get_template_part('partials/teasers/joke') ?>
							</li>
						<?php $i++ ?>
						<?php endwhile; ?>
					</ol>
			
					<?php echo getPagination($query, $paged, true, $cat)?>
					<?php wp_reset_postdata();?>

				<?php endif; ?>

			<?php else: ?>
				<?php echo get_template_part('partials/category/empty')?>
			<?php endif ?>

			<?php get_template_part('partials/menu/joke-menu') ?>
		</div>

	</div>

	<?php //global $category_name; $category_name = get_cat_name( $cat )?>
	<?php //get_template_part('template-parts/sections/news') ?>
	<?php //get_template_part('template-parts/sections/gender') ?>

</div>

<?php get_footer(); ?>
