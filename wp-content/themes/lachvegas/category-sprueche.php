<?php 

get_header();

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 50,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('saying'),
	'cat' => get_queried_object_id(),
	//'category_name' => get_cat_name( $cat ),
	'order_by' => 'date', 
	'order' => 'DESC',
);

$query = new WP_Query($args)
?>


<div class="content">

	<?php if ($categoryDescription = category_description($cat)): ?>
		<div class="category-description">
			<?php echo $categoryDescription ?>
		</div>
	<?php endif ?>

	<?php if ( $query->have_posts() ) : ?>
		<h1 class="category-title"><?php echo single_cat_title() ?></h1>
		<?php if ($query->have_posts()): ?>

			<div class="masonry">
				<?php $i = 0; ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
					<div class="masonry__item">

						<?php if (has_post_thumbnail()):?>
							<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
								<?php the_post_thumbnail('medium'); ?>

								<span class="article-excerpt">
									<?php the_title() ?>
								</span>
							</a>							
						<?php endif ?>

						<?php 
			
							if ($i == 4) {
								//showAD('banner');
							}
							//get_template_part('template-parts/teasers/teaser-article-list') 
						
						?>

					</div>
				<?php $i++ ?>
				<?php endwhile; ?>
			</div>

			<?php echo getPagination($query, $paged, true, $cat)?>
			<?php wp_reset_postdata();?>

		<?php endif; ?>
	<?php endif ?>

	<?php get_template_part('template-parts/sections/gender') ?>

</div><!-- .content -->

<?php get_footer(); ?>
