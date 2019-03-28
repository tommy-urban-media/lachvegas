<?php 
	$externalImageUrl = get_post_meta( $post->ID, 'external_image_url', true );
	$externalImageSource = get_post_meta( $post->ID, 'external_image_source', true );
?>

<div class="related-post">
	
	<a href="<?php the_permalink(); ?>" title="Beitrag: <?= get_the_title($post->ID) ?>">
		<figure class="post-image">
			<?php if (has_post_thumbnail()):?>
				<?php the_post_thumbnail('16_9_medium')?>
			<?php else: ?>
				<?php if ($externalImageUrl): ?>
					<img src="<?= $externalImageUrl ?>" alt="External Image" />
					<?php if ($externalImageSource): ?>
						<figcaption class="caption"><?= $externalImageSource ?></figcaption>
					<?php endif ?>
				<?php else: ?>
					<img src="<?= get_bloginfo('template_url')?>/app/public/lachvegas-placeholder.png" />
				<?php endif ?>
			<?php endif ?>
		</figure>

		<span class="post-title"><?php the_title() ?></span>

	</a>
	
</div>