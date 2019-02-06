<?php get_header() ?>

<div class="content content-wrapper">

	<?php if ($description = get_the_archive_description()): ?>
		<div class="category-description">
			<?php echo $description ?>
		</div>
	<?php endif ?>

	<?php if ( have_posts() ) : ?>

	<div class="content__area">
		<div class="content__area--primary">

			<h1 class="category-title"><?php echo str_replace( array('Archives:', 'Archive:'), "", get_the_archive_title()); ?></h1>

			<?php if (have_posts()): ?>

				<ol class="list list--news">
					<?php $i = 0; ?>
					<?php while ( have_posts() ) : the_post(); setup_postdata($post)?>
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

				<nav class="pagination">
					<span class="previous-posts">
						<?php previous_posts_link('&laquo;'); ?>
					</span>
					<span class="next-posts">
						<?php next_posts_link('&raquo;'); ?>
					</span>
				</nav>

				<?php wp_reset_postdata();?>

			<?php endif; ?>
		</div>
		<div class="content__area--secondary">
			<?php echo get_template_part('sidebar')?>
		</div>
	</div>

	<?php endif ?>

	<?php get_template_part('template-parts/sections/gender') ?>
	<?php get_template_part('template-parts/sections/promis') ?>


</div><!-- .content -->

<?php get_footer(); ?>
