<?php 

get_header();

$count = get_option('posts_per_page', 50);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 50,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('saying'),
	'cat' => get_queried_object_id()
);

$querySayings = new WP_Query($args)
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

			<?php if ( $querySayings->have_posts() ) : ?>
				<h1 class="category-title"><?php echo single_cat_title() ?></h1>
				<?php if ($querySayings->have_posts()): ?>

<?php /* ?>
					<div class="masonry">
						<?php $i = 0; ?>
						<?php while ( $querySayings->have_posts() ) : $querySayings->the_post(); setup_postdata($post)?>
							<div class="masonry__item">

								<?php if (has_post_thumbnail()):?>
									<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
										<?php the_post_thumbnail('medium'); ?>

										<span class="article-excerpt">
											<?php the_title() ?>
										</span>
									</a>							
								<?php endif ?>

							</div>
						<?php $i++ ?>
						<?php endwhile; ?>
					</div>
					<?php */ ?>

					<ol class="joke-list">
						<?php $i = 0; ?>
						<?php while ( $querySayings->have_posts() ) : $querySayings->the_post(); setup_postdata($post)?>
							<li class="joke-list__item">
								<?php get_template_part('partials/teasers/joke') ?>
							</li>
						<?php $i++ ?>
						<?php endwhile; ?>
					</ol>

					<?php echo getPagination($querySayings, $paged, true, $cat)?>
					<?php wp_reset_postdata();?>

				<?php endif; ?>
			<?php endif ?>
		</div>
	</div>

</div><!-- .content -->

<?php get_footer(); ?>
