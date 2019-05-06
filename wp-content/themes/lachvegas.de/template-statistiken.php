<?php
/**
 * Template Name: Statistik des Tages
 */

get_header(); 

$args = array(
	'posts_per_page' => -1,
	'post_type' => 'statistic',
	'order_by' => 'date', 
	'order' => 'ASC',
	//'orderby' => 'meta_value',
  	//'meta_key' => 'week_of_the_year'
);

$statistics = new WP_Query($args);

?>


<div class="content">
	<div class="content__area">
		<div class="content__area--primary">
			<div class="article-content entry-content">
				<h1><?php _e('Statistik des Tages')?></h1>
				<?php the_content() ?>

				<?php if ($statistics->have_posts()): ?>
					<div class="statistics">
						<?php while ( $statistics->have_posts() ) : $statistics->the_post();?>
							<div class="statistic">

								<?php $subtitle = get_post_meta($post->ID, 'subtitle', true); ?>
								<?php $week_of_the_year = get_post_meta($post->ID, 'week_of_the_year', true); ?>

								<?php if ($week_of_the_year): ?>
									<h3 class="week_of_the_year">Kalenderwoche <?= $week_of_the_year ?></h3>
								<?php endif ?>

								<?php if ($subtitle): ?>
									<span class="subtitle"><?= $subtitle ?></span>
								<?php endif ?>
<!--
								<a class="post-title" href="<?php echo get_permalink()?>">
									<?php the_title()?>
								</a>
-->
								<div class="post-content">
									<?php the_content()?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					<?php wp_reset_postdata();?>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
