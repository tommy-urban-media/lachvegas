<?php
/**
 * Template Name: News
 */

get_header(); 

$count = get_option('posts_per_page', 10);
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => 10,
	'paged' => $paged,
	'offset' => $offset,
	'post_type' => 'news',
	'date_query' => array(
		array(
			'year' => array(2016, 2017, 2018, 2019, 2020, 2021, 2022),
			'month' => array(5,6,7,8,9,10),
			//'day'	=> date('d')
		),
	),
	'order_by' => 'date', 
	'order' => 'DESC',
);

?>


<main class="main" role="main">

	<div class="content content-wrapper">

	<section class="section">

		<h1><?php _e('News')?> (6 neu)</h1>

		<div class="section__area">

			<div class="section__area__main">

			<?php $queryNews = new WP_Query($args)?>

				<?php if ($queryNews->have_posts()): ?>
				
					<ul class="list list--teaser">
						<?php while ( $queryNews->have_posts() ) : $queryNews->the_post();?>
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

					<?php previous_posts_link('Zurück', $queryNews->max_num_pages); ?>
          			<?php next_posts_link('Weiter', $queryNews->max_num_pages); ?>

					<?php wp_reset_postdata();?>

				<?php endif; ?>

				</div>


				<div class="section__area__sidebar">

					<div class="tags">
						<?php $tags = get_tags()?>
						<h3>Tags</h3>
						<ul class="tag-list">
						<?php foreach($tags as $tag):?>
							<li class="archive-tag">
								<a href="<?php echo get_tag_link( $tag->term_id )?>" title="<?php echo $tag->name?>">
									<?php echo $tag->name?> (<?php echo $tag->count?>)
								</a>
							</li>
						<?php endforeach;?>
						</ul>
					</div>

				</div>

			</div>
		</section>

	</div>
</div>

<?php get_footer(); ?>
