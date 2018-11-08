<?php get_header() ?>

<main class="main" role="main">

	<div class="content content-wrapper">

		<?php if ($categoryDescription = category_description($cat)): ?>
			<div class="category-description">
				<?php echo $categoryDescription ?>
			</div>
		<?php endif ?>
		

	<?php if ( have_posts() ) : ?>

	<section class="section">
		<div class="section__area">
			<div class="section__area__main">

			<h1 class="category-title">News</h1>

			<?php //$queryNews = new WP_Query($args)?>
				<?php if (have_posts()): ?>
				
					<ul class="list list--teaser">
						<?php while ( have_posts() ) : the_post();?>
							<li class="news-list__item">

								<a class="post-title" href="<?php echo get_permalink()?>">
									<?php the_title()?>
								</a>

								<span class="post-meta">
									<?php echo _e('geschrieben von ')?> <a class="contact-link" href="#"><?php the_author()?></a> | <?php echo the_date('d. M. Y')?>
								</span>

								<div class="post-content">

									<?php if (has_post_thumbnail()):?>
										<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
											<figure class="post-image post-image--teaser">
												<?php the_post_thumbnail('article_thumbnail')?>
											</figure>
										</a>
									<?php endif ?>

									<?php the_content()?>
								</div>

							</li>
						<?php endwhile; ?>
					</ul>

					<?php previous_posts_link('Zurück'); ?>
					<?php next_posts_link('Weiter' ); ?>

					<?php wp_reset_postdata();?>

				<?php endif; ?>

				</div>

			</div>

		</section>

		<?php endif ?>

	</div><!-- .content -->

	<?php // echo get_template_part('sidebar'); ?>

</main>

<?php get_footer(); ?>
