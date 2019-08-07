<?php 

get_header();

global $categoryQuery;

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



$is_ancestor_of_category_joke = cat_is_ancestor_of(get_category_by_slug('witze'), $cat);

if ($is_ancestor_of_category_joke):
	$categoryQuery = new WP_Query($args);
	get_template_part('partials/category/joke-child');
else:

$args['tax_query'] = array(
	'relation' => 'AND',
	array(
		'taxonomy' => 'category',
		'field' => 'term_id',
		'terms' => get_queried_object_id()
	),
	array(
		'taxonomy' => 'post_settings',
		'field' => 'name',
		'terms' => array('teasable')
	)
	);

$categoryQuery = new WP_Query($args);

$posts = [];
if ( $categoryQuery->have_posts() ):
	while ( $categoryQuery->have_posts() ) : 
		$categoryQuery->the_post(); 
		setup_postdata($post);

	$posts[] = $post;

	endwhile;
				
endif;



?>

<div class="content content-home">
	<?php get_template_part('template-parts/common/breadcrumb') ?>
	<div class="content__area">
		
		
			<?php if (count($posts)): ?>

				<div class="content__area--wide">
					<?php $i = 0; ?>
					<?php foreach($posts as $post): ?>
						<?php if ($i == 0 && !is_paged()): ?>
							<?php get_template_part('template-parts/teasers/teaser-large') ?>
						<?php endif ?>
					<?php $i++ ?>
					<?php endforeach ?>
				</div>

				<div class="content__area--primary">
					<ol class="list list--news">
					<?php $i = 0; ?>
					<?php foreach($posts as $post): ?>
						<?php if (!is_paged()): ?>
							<?php if ($i != 0): ?>
								<li class="list-item">
									<?php global $post; get_template_part('template-parts/teasers/teaser-article-list') ?>
								</li>
							<?php endif ?>
						<?php else: ?>
							<li class="list-item">
								<?php global $post; get_template_part('template-parts/teasers/teaser-article-list') ?>
							</li>
						<?php endif ?>
					<?php $i++ ?>
					<?php endforeach ?>
					</ol>
					<?php echo getPagination($categoryQuery, $paged)?>
				</div>

			<?php else: ?>
				<div class="content__area--primary">
					<?php echo get_template_part('partials/category/empty')?>
				</div>
			<?php endif ?>

			<aside class="content__area--secondary">
				<?php echo get_template_part('sidebar')?>
			</aside>

		</div>

	</div>

	<?php global $category_name; $category_name = get_cat_name( $cat )?>
	<?php get_template_part('template-parts/sections/news') ?>
	<?php //get_template_part('template-parts/sections/gender') ?>

</div><!-- .content -->

<?php endif ?>
<?php get_footer(); ?>
