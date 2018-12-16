<?php get_header(); ?>

<div class="content content-wrapper">

	<?php while ( have_posts() ) : the_post(); setup_postdata($post); ?>

		<?php
			$post_likes = get_post_meta( $post->ID, 'post-likes', true );
			$post_comments = get_comments_number( $post->ID );
		?>

		<div class="content__area content__area--person">
			<div class="content__area--person--primary">		
				<article class="person">
					<div class="">

						<?php if (has_post_thumbnail()):?>
							<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
							<?php $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail'); ?>
							<figure class="post-image">
								<?php the_post_thumbnail('thumbnail')?>
								<?php if ($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
									<figcaption class="caption">
										<?php echo $caption ?>
									</figcaption>
								<?php endif ?>
							</figure>
						<?php endif;?>

						<h1 class="person__title"><?= the_title()?></h1>

						<div class="person__characters">
							<?php the_content() ?>
						</div>
					</div>
				</article>
			</div>
			<div class="content__area--person--secondary">
				<?php // echo get_template_part('sidebar')?>
			</div>
		</div>

		<?php endwhile;?>

</div>

<?php get_footer(); ?>
