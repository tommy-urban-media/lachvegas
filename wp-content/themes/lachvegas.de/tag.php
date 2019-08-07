<?php
/**
 * The template for displaying Tag pages.
 */

get_header(); 
?>

<?php // get_template_part('template-parts/common/breadcrumb') ?>

<div class="content content-home">

	<?php get_template_part('template-parts/common/breadcrumb') ?>

	<div class="content__area">
		<div class="content__area--primary">

			<header class="archive-header">
				<h1 class="archive-title">
					Thema: <?php echo __('<span>' . single_tag_title( '', false ) . '</span>'); ?>
				</h1>
				<?php if (tag_description()):?>
					<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header>

			<?php if (have_posts()): ?>
				
				<ol class="list list--news">

				<?php $i = 0; ?>
				<?php while ( have_posts() ) : the_post();?>
					<?php /* ?>
					<?php if ($i == 4 || $i == 12): ?>
						<li class="list-item">
							<?php showAD('banner'); ?>
						</li>
					<?php endif ?>
					<?php */ ?>
					<li class="list-item">
						<?php get_template_part('template-parts/teasers/teaser-article-list') ?>
					</li>
				<?php $i++ ?>
				<?php endwhile; ?>

				</ol>

				<?php previous_posts_link('Zurück'); ?>
				<?php next_posts_link('Weiter'); ?>

			<?php endif; ?>
	
		</div>

		<div class="content__area--secondary">
			<?php echo get_template_part('sidebar')?>
		</div>
	</div>

	<?php get_template_part('template-parts/sections/gender') ?>
	<?php get_template_part('template-parts/sections/newsletter') ?>
	<?php //get_template_part('template-parts/sections/lachvegas-fragt-dich') ?>

</div>

<?php get_footer(); ?>
