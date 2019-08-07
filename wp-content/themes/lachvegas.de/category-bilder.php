<?php 

get_header();

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 10,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('news', 'post', 'saying', 'guide', 'picture', 'poem', 'quiz', 'joke'),
	//'cat' => get_queried_object_id(),
	//'category_name' => get_cat_name( $cat ),
	'date_query' => array(
		'relation' => 'OR',
		'before' => date('Y-m-d H:i', strtotime('+1 day'))
	),
	'order_by' => 'date', 
	'order' => 'DESC',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'category',
			'field' => 'term_id',
			'terms' => get_queried_object_id()
		)
	)
);

?>

<div class="content content-home">

	<?php get_template_part('template-parts/common/breadcrumb') ?>

	<div class="content__area">
		<div class="content__area--wide">

			<h1><?php echo single_cat_title() ?></h1>

			<?php if ($categoryDescription = category_description($cat)): ?>
				<div class="category-description">
					<?php echo $categoryDescription ?>
				</div>
			<?php endif ?>

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

	<?php global $category_name; $category_name = get_cat_name( $cat )?>
	<?php //get_template_part('template-parts/sections/news') ?>
	<?php //get_template_part('template-parts/sections/gender') ?>

</div><!-- .content -->

<?php get_footer(); ?>
