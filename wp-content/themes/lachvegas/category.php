<?php 

get_header();

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 10,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('news', 'post', 'saying', 'guide', 'poem'),
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

								<?php if ($i == 4): ?>
									<?php get_template_part('template-parts/ads/jochen-scheisser')?>
								<?php endif ?>

								<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
								<span class="post-meta">
									<?= $subtitle ?>
								</span>
								<?php endif ?>

								<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
									<?php the_title() ?>
								</a>

								<div class="post-content">
									<?php if (has_post_thumbnail()):?>
										<a href="<?= get_the_permalink($post->ID) ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
											<figure class="post-image post-image--teaser">
												<?php the_post_thumbnail('article_thumbnail')?>
											</figure>
										</a>
									<?php endif ?>
									<span class="post-date"><?php echo the_date('d.m.Y')?></span>
									<?php echo custom_excerpt(get_the_excerpt($post->ID), 24) ?>
								</div>
							</li>

						<?php $i++ ?>
						<?php endwhile; ?>
					</ol>

					<?php previous_posts_link('Zurück'); ?>
					<?php next_posts_link('Weiter'); ?>

					<?php wp_reset_postdata();?>

				<?php endif; ?>
			</div>
			<div class="content__area--secondary">
				<?php echo get_template_part('sidebar')?>
			</div>
		</div>

	<?php endif ?>

	<?php previous_posts_link('Zurück'); ?>
	<?php next_posts_link('Weiter' ); ?>

	<?php get_template_part('template-parts/content-areas/gender') ?>

</div><!-- .content -->

<?php get_footer(); ?>
