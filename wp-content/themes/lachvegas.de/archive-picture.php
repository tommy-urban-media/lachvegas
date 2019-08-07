<?php
get_header(); 

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 10,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => 'picture',
	'order_by' => 'date', 
	'order' => 'DESC',
);

?>

<div class="content content-home">
	<div class="content__area">
		<div class="content__area--wide">

			<h1 class="archive-title">Bilder</h1>

			<?php if ($description = get_the_archive_description()): ?>
				<div class="category-description">
					<?php echo $description ?>
				</div>
			<?php endif ?>

			<?php /* ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="article-picture" data-id="<?php echo $post->ID ?>">
					<?php echo get_template_part('template-parts/article', 'jsonld'); ?>
					<header class="article-header">
						<h1 class="article-title">
							<span class="article-title-headline"><?php the_title()?></span>
						</h1>
					</header>
					<div class="article-content entry-content">
						<?php the_content()?>
					</div>
				</article>
			<?php endwhile; ?>
			<?php */ ?>

			<?php $queryPictures = new WP_Query($args)?>
			<?php if ($queryPictures->have_posts()): ?>
			
				<div class="picture-list">
					<?php while ( $queryPictures->have_posts() ) : $queryPictures->the_post(); setup_postdata($post)?>
						<?php if (has_post_thumbnail($post->ID)):?>	
							<article class="picture-teaser" data-post-type="picture">
								<div class="picture-teaser__body">
									<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
										<h3 class="post-title"><?php the_title() ?></h3>
										<figure class="post-image">
											<?php the_post_thumbnail('article-teaser')?>
										</figure>
									</a>
								</div>

								<div class="picture-teaser__footer">
									
									<?php if (has_tag()): ?>
										<div class="picture-tags">
											<span class="picture-tags-title">Tags:</span>
											<?= get_the_tag_list('<ul class="tags"><li class="tag">', '</li><li class="tag">', '</li></ul>')?>
										</div>
									<?php endif ?>
								
									<div class="picture-socials">
										<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count"></div>
										<div class="pinterest-share">
											<a data-pin-lang="de" href="http://pinterest.com/pin/create/button/?url=<?php esc_url_raw(get_the_permalink($post->ID))?>&description=<?= get_the_title($post->ID)?>">
												Pinterest teilen
											</a>
										</div>
										<div class="twitter-share">
											<a href="<?php the_permalink(); ?>" class="twitter-share-button" data-show-count="false"></a>
										</div>
									</div>
								</div>

							</article>
						<?php endif ?>
					<?php endwhile; ?>
				</div>

				<?php echo getPagination($queryPictures, $paged, true)?>
				<?php wp_reset_postdata();?>

			<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer(); ?>
