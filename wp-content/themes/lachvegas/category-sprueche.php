<?php 

get_header();

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 5,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('saying'),
	'category_name' => get_cat_name( $cat ),
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

		<div class="content__area">
			<div class="content__area--primary">
				<h1><?php echo single_cat_title() ?></h1>

				<?php if ($query->have_posts()): ?>

					<ol class="list list--news">
						<?php $i = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
							<li class="list-item">

							<?php if ($image = get_post_meta($post->ID, 'image_name', true)): ?>
								<img src="<?= get_bloginfo('template_url')?>/app/generated_images/<?= $image ?>" width="320" height="320" alt="<?= get_the_title($post->ID) ?>" style="width: 320px; height: 320px; display: block; border: 1px solid #fff; margin: 0 auto;" />
							<?php else: ?>
								<?php the_title() ?>
							<?php endif ?>

								<?php 
					
									if ($i == 4) {
										//showAD('banner');
									}
									//get_template_part('template-parts/teasers/teaser-article-list') 
								
								?>

							</li>
						<?php $i++ ?>
						<?php endwhile; ?>
					</ol>

					<?php 
						global $wp_query;
						$big = 999999999; // need an unlikely integer
						echo '<div class="paginate-links">';
							echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'prev_text' => __('<<'),
							'next_text' => __('>>'),
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages
							) );
						echo '</div>';
					
					?>
								
					<?php //previous_posts_link('Zurück'); ?>
					<?php //next_posts_link('Weiter'); ?>

					<?php echo getPagination($query, $paged)?>

					<?php wp_reset_postdata();?>

				<?php endif; ?>
			</div>
			<div class="content__area--secondary">
				<?php echo get_template_part('sidebar')?>
			</div>
		</div>

	<?php endif ?>

	<?php previous_posts_link('Zurück'); ?>
	<?php next_posts_link('Weiter'); ?>

	<?php get_template_part('template-parts/sections/gender') ?>

</div><!-- .content -->

<?php get_footer(); ?>
