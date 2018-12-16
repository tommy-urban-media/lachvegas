<?php
/**
 * The template for displaying Tag pages.
 */

get_header(); 
?>
<div class="content">
	<div class="content__area">
		<div class="content__area--primary">

			<header class="archive-header">
				<h1 class="archive-title">
					Thema: <?php echo __('<span>' . single_tag_title( '', false ) . '</span>'); ?>
				</h1>
				<?php if (tag_description()): // Show an optional tag description ?>
					<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header>

			<?php if (have_posts()): ?>
				
				<ol class="list list--news">

				<?php $i = 0; ?>
				<?php while ( have_posts() ) : the_post();?>
					
					<li class="list-item">

						<?php if ($i == 4): ?>
							<?php get_template_part('template-parts/ads/jochen-scheisser')?>
						<?php endif ?>

						<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
						<span class="post-meta"><?= $subtitle ?></span>
						<?php endif ?>

						<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
							<?php the_title() ?>
						</a>

						<div class="post-content">
							<?php if (has_post_thumbnail()):?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
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

			<?php endif; ?>

	
		</div>

		<div class="content__area--secondary">
			<?php echo get_template_part('sidebar')?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
