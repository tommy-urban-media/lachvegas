<?php 
	$externalImageUrl = get_post_meta( $post->ID, 'external_image_url', true );
	$externalImageSource = get_post_meta( $post->ID, 'external_image_source', true );
?>

<div class="post-content">
	
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
	</a>
	
	<?php //if ($tag = get_the_tags()): ?>
		<span class="post-meta">
			<?php $category = getChildCategory($post->ID) ?>
			<?php if (isset($category) && !empty($category) && isset($category->name)): ?>
				<a class="post-category-link" href="<?= $category->url ?>"><?= $category->name ?></a>
			<?php endif ?>

			<?php $tag = get_the_tags(); ?>
			<?php if ($tag): ?>
			<?php $tag = $tag[0]; ?>
				<a class="post-tag-link" href="<?= get_term_link($tag->term_id) ?>"><?= $tag->name ?></a> 
			<?php endif ?>
		</span>
	<?php //endif ?>

	<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
		<span class="news-title"><?php the_title() ?></span>
	</a>
	<!-- <span class="post-date"><?php echo the_time(get_option('date_format'));?></span> -->
	<?php //echo custom_excerpt(get_the_excerpt($post->ID), 18, false) ?>

</div>