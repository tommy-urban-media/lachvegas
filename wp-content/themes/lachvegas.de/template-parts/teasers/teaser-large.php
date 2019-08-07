<article class="article-teaser-large">
	<a class="article-link" href="<?php the_permalink(); ?>" title="Zum Artikel: <?php echo get_the_title($post->ID); ?>">
		
		<figure class="image-wrapper">
			<?php if (has_post_thumbnail()):?>
				<?php the_post_thumbnail('widescreen')?>
			<?php else: ?>
			<img src="<?= get_bloginfo('template_url')?>/app/public/lachvegas-placeholder.png" alt="Lachvegas.de" />
			<?php endif ?>
		</figure> 
	
		<span class="article-teaser-large-content">
			<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
			<span class="article-link-subtitle"><?= $subtitle ?></span>
			<?php endif ?>
			<span class="article-link-title"><?php the_title() ?></span>

			<?php $excerpt = custom_excerpt(get_the_excerpt($post->ID), 24, false); ?>
			<?php if (strlen($excerpt) > 10): ?>
				<span class="post-excerpt">
					<span class="post-date">
						<?php echo the_time(get_option('date_format'));?>
					</span> - 
					<?php echo $excerpt ?>
				</span>
			<?php endif ?>

		</span>
		
	</a>
</article>