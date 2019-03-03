<?php 

get_header();

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 12,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => array('saying'),
	'cat' => get_queried_object_id(),
	//'category_name' => get_cat_name( $cat ),
	'order_by' => 'date', 
	'order' => 'DESC',
);

$query = new WP_Query($args)
?>


<div class="content">

	<?php if ($categoryDescription = category_description($cat)): ?>
		<div class="category-description">
			<?php echo $categoryDescription ?>
		</div>
	<?php endif ?>

	<?php if ( $query->have_posts() ) : ?>

		<div class="content__area">
			<div class="content__area--wide">

				<!-- 
				<h1 class="category-title"><?php echo single_cat_title() ?></h1>
				-->

				<?php if ($query->have_posts()): ?>

					<ol class="list-images">
						<?php $i = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
							<li class="item">

								<?php if (has_post_thumbnail()):?>
									<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
										<img src="<?= get_bloginfo('template_url')?>/app/generated_images/<?php echo sanitize_title(get_the_title($post->ID))?>_640_640_mick.png" width="160px" height="160px" alt="<?= get_the_title($post->ID) ?>" />
									</a>
								<?php else: ?>

									<?php if ($image = get_post_meta($post->ID, 'image_name', true)): ?>
										<img src="<?= get_bloginfo('template_url')?>/app/generated_images/<?= $image ?>" width="320" height="320" alt="<?= get_the_title($post->ID) ?>" style="width: 320px; max-width:100%; height: auto; display: block; border: 1px solid #fff; margin: 0 auto;" />
									<?php else: ?>
										<?php the_title() ?>
									<?php endif ?>

								<?php endif ?>

								<?php 
					
									if ($i == 4) {
										//showAD('banner');
									}
									//get_template_part('template-parts/teasers/teaser-article-list') 
								
								?>

							</li>
						<?php $i++ ?>
						<?php endwhile; ?>
					</ol>

					<?php echo getPagination($query, $paged, true, $cat)?>
					<?php wp_reset_postdata();?>

				<?php endif; ?>
			</div>
		</div>

	<?php endif ?>

	<?php get_template_part('template-parts/sections/gender') ?>

</div><!-- .content -->

<?php get_footer(); ?>
