<?php
/**
 * Template Name: Sprüche
 */

get_header(); 

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 50,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => 'saying',
	'order_by' => 'date', 
	'order' => 'DESC',
);

?>


<div class="content">

	<section class="section">
	<div class="section__area">
		<div class="section__area__full">

		<h1><?php _e('Sprüche')?></h1>

		<?php $queryNews = new WP_Query($args)?>

			<?php if ($queryNews->have_posts()): ?>
			
				<ul class="masonry">
					<?php while ( $queryNews->have_posts() ) : $queryNews->the_post();?>
						<li class="masonry__item">

							<a class="quote-box" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
								<figure class="post-image">
									<?php if (has_post_thumbnail()):?>	
										<?php the_post_thumbnail('medium_large')?>
									<?php else: ?>
										<img src="http://localhost/lachvegas/wp-content/uploads/2018/11/background-board-carpentry-326333-768x512.jpg" />
									<?php endif ?>
									<span class="post-title"><?php the_title() ?></span>
								</figure>
							</a>

						</li>
					<?php endwhile; ?>
				</ul>

				<?php previous_posts_link('Zurück', $queryNews->max_num_pages); ?>
				<?php next_posts_link('Weiter', $queryNews->max_num_pages); ?>

				<?php wp_reset_postdata();?>

			<?php endif; ?>

			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
