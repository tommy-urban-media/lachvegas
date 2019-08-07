<?php
/**
 * Template Name: Sprüche
 */

get_header(); 

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 10,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => 'saying',
	'cat' => get_queried_object_id(),
	'order_by' => 'date', 
	'order' => 'DESC',
);

?>

<div class="content">

	<section class="section">
	<div class="section__area">
		<div class="section__area__full">
			<h1 class="page-title"><?php _e('Sprüche')?></h1>

			<?php $querySayings = new WP_Query($args)?>
			<?php if ($querySayings->have_posts()): ?>
			
				<div class="masonry">
					<?php while ( $querySayings->have_posts() ) : $querySayings->the_post(); setup_postdata($post)?>
						<?php if (has_post_thumbnail($post->ID)):?>	
							<article class="masonry__item">
								<?php $bgImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium_large');?>
								<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
									<figure class="post-image">
										<?php the_post_thumbnail('medium_large')?>
									</figure>
									<span class="post-title"><?php the_title() ?></span>
								</a>
							</article>
						<?php endif ?>
					<?php endwhile; ?>
				</div>

				<?php echo getPagination($querySayings, $paged, true, false)?>
				<?php wp_reset_postdata();?>

			<?php endif; ?>

			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
