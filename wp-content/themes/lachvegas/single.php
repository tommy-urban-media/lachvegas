<?php get_header(); ?>

<div class="content content-wrapper">

	<?php while ( have_posts() ) : the_post(); setup_postdata($post); ?>

		<?php
			$post_likes = get_post_meta( $post->ID, 'post-likes', true );
			$post_comments = get_comments_number( $post->ID );
		?>

		<?php $post_views = (int)get_post_meta( $post->ID, 'post-views', true ); ?>

		<?php //if( !postViewed($post->ID) ):?>
		<?php //$post_views += 1?>
		<?php //endif;?>

		<?php if( $post_views == 0 ): ?>
			<?php add_post_meta($post->ID, 'post-views', '1' ); ?>
		<?php else:?>
			<?php update_post_meta($post->ID, 'post-views', $post_views ); ?>
		<?php endif;?>

		<div class="content__area">
			<div class="content__area--primary">
				<article class="article" data-id="<?php echo $post->ID ?>">

					<?php //echo get_template_part('template-parts/article', 'jsonld'); ?>

					<header class="article-header">

						<!--
						<?php if (isset(get_the_category()[0]->name)): ?>
							<a href="<?php echo get_category_link(get_the_category()[0]->term_id)?>" class="article-title-link"><?php echo get_the_category()[0]->name ?></a>
						<?php endif ?>
						-->

						<?php $user_data = get_userdata($post->post_author); ?>

						<div class="article-meta">

							<span class="article-author-info">
								<?php echo __('von')?>
								<a class="contact-link" href="#">
									<?php echo $user_data->user_firstname?> <?php echo $user_data->user_lastname?>
								</a>
							</span>

							<span class="article-date">
							| <?php echo the_date('d. M, Y')?>
							</span>


							<div class="article-stats">

								<!--
								<?php if (isset($post_views)): ?>
									<span class="article-views" title="<?php _e('Aufrufe')?>">
										<i class="fa fa-eye"></i><?php echo $post_views ? $post_views : 0?>
										<?php _e('Aufrufe')?>
									</span>
								<?php endif;?>
								-->

								<?php if (isset($post_comments) && $post_comments != '0'): ?>
									<a class="article-comments" href="#comments" title="<?php _e('Kommentare')?>">
										<i class="fa fa-comment"></i>
										<?php echo $post_comments ? $post_comments : 0?> <?php _e('Kommentare')?>
									</a>
								<?php endif;?>

							</div>

						</div>


						<h1 class="article-title">
							<span class="article-title-headline"><?php the_title()?></span>
						</h1>

						<?php if ( $post->post_excerpt ):?>
							<div class="article-excerpt">
								<p><?php echo $post->post_excerpt ?></p>
							</div>
						<?php endif;?>



						<?php if (has_post_thumbnail()):?>
							<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
							<?php $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'article-header'); ?>
							<figure class="post-image">
								<!-- <a href="<?php echo $post_thumbnail[0]?>" rel="gallery-group"> -->
									<?php the_post_thumbnail('article-header')?>
								<!-- </a> -->
								<?php if ($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
									<figcaption class="caption">
										<?php echo $caption ?>
									</figcaption>
								<?php endif ?>
							</figure>
						<?php endif;?>


					</header>


					<div class="article-content entry-content">

						<?php the_content()?>

					</div>


					<footer class="article-footer">

						<?php // echo get_template_part('template-parts/article', 'related-posts'); ?>
						<?php // echo get_template_part('template-parts/article', 'vote'); ?>
						<?php // echo get_template_part('template-parts/article', 'author'); ?>

						<div class="tags">
							<?= __('Tags') ?>:
							<?= get_the_tag_list('<ul class="tag-list"><li>', '</li><li>', '</li></ul>')?>
						</div>


						<a name="comments"></a>
						<?php // comments_template( '', true ); ?>


					</footer>

				</article>
			</div>
			<div class="content__area--secondary">
				<?php echo get_template_part('sidebar')?>
			</div>
		</div>

		<?php endwhile;?>

</div>

<?php get_footer(); ?>
