<?php
/**
 * Template Name: Homepage
 */
get_header(); 

$count = get_option('posts_per_page', 10);
$paged = get_query_var('page') ? get_query_var('page') : 1;
$offset = ($paged - 1) * $count;

$args = array(
	'posts_per_page' => $count,
	'paged' => $paged,
	'offset' => $offset,
	'date_query' => array(
		array(
			'year' => array(2017, 2018, 2019, 2020)
		)
	),
	'post_type' => array('guide', 'news', 'post', 'poem', /*'statistic',*/ 'quiz'),
	//'category__not_in' => array(64) // Produkte
);

$queryNews = new WP_Query($args);
$max_pages = $queryNews->max_num_pages;



$oldPosts = get_posts(array(
	'posts_per_page' => -1,
	'post_type' => array('guide', 'news', 'post', 'poem', /*'statistic',*/ 'quiz'),
	'date_query' => array(
		array(
			'month' => date('m'),
			'day' => date('d')
		)
	),
	'category_name' => get_category_by_slug('wiederholend')->cat_name
));

foreach($oldPosts as $p) {
	wp_update_post(array(
		'ID' => $p->ID,
		'post_date' => date('Y-m-d 06:00:00')
	));
}

?>

<div class="content content-home">

	<div class="content__area">
		<div class="content__area--primary">

			<?php if ( $queryNews->have_posts() ) : ?>
				<ol class="list list--news">
					<?php $i = 0; ?>
					<?php while ( $queryNews->have_posts() ) : $queryNews->the_post(); setup_postdata($post)?>
						
						<?php if ($i == 4): ?>
							<li class="list-item">
								<?php showAD('banner'); ?>
							</li>
						<?php endif ?>
						<li class="list-item">
							<?php get_template_part('template-parts/teasers/teaser-article-list') ?>
						</li>

					<?php $i++ ?>
					<?php endwhile; ?>
					</ol>
			<?php endif ?>

			<?php echo getPagination($queryNews, $paged)?>
			<?php wp_reset_postdata();?>
		</div>

		<div class="content__area--secondary">

			<?php get_template_part('sidebar')?>

			<div class="news">

				<h3>Aktuelle Kurzmeldungen</h3>
				
				<?php $queryShortNews = new WP_Query( array('post_type' => 'news', 'posts_per_page' => 10, 'category_name' => 'kurzmeldungen') ); ?>
				<?php if ( $queryShortNews->have_posts() ) : ?>
					<ul class="list list--shortnews">
						<?php while ( $queryShortNews->have_posts() ) : $queryShortNews->the_post(); setup_postdata($post)?>
							<li class="list-item">	
								<a href="<?php echo get_the_permalink($post->ID) ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php wp_reset_postdata(); ?>
				<?php endif ?>	

			</div>
		</div>
	</div>

	<?php get_template_part('template-parts/common/news-archive') ?>
	<?php get_template_part('template-parts/sections/special-day') ?>
	
	<section class="section section--posts">
		<div class="section__pane">
			<header class="section__header">
				<h3 class="section__title">Deutschland</h3>
				<span class="section__separator"></span>
			</header>

			<div class="flex flex--shortnews">
				<div class="flex-item">
					<h4 class="">Deutschland</h4>
					<?php $query = new WP_Query( array('posts_per_page' => 5, 'post_type' => array('news'), 'category_name' => 'deutschland') ); ?>
					<?php if ( $query->have_posts() ) : ?>
						<ol class="list list--shortnews">
							<?php $i = 0; ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">

									<span class="post-meta">
										<span class="post-date"><?php echo the_time(get_option('date_format'));?></span> 
										<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
											<?= $subtitle ?>
										<?php endif ?>
									</span>
									
									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
						</ol>
						<a class="button" href="<?= home_url('/')?>deutschland"><span>Alle Nachrichten</span><i class="icon fa fa-angle-double-right"></i></a>
					<?php endif ?>
				</div>
				<div class="flex-item">
					<h4 class="">Berlin/Brandenburg</h4>
					<?php $query = new WP_Query( array('posts_per_page' => 5, 'post_type' => array('news'), 'category_name' => 'berlin') ); ?>
					<?php if ( $query->have_posts() ) : ?>
						<ol class="list list--shortnews">
							<?php $i = 0; ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">

									<span class="post-meta">
										<span class="post-date"><?php echo the_time(get_option('date_format'));?></span> 
										<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
											<?= $subtitle ?>
										<?php endif ?>
									</span>

									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
						</ol>
						<a class="button" href="<?= home_url('/')?>regionalmeldungen"><span>Alle Regionalmeldungen</span><i class="icon fa fa-angle-double-right"></i></a>
					<?php endif ?>
				</div>
				<div class="flex-item">
					<h4 class="">Bundeswehr Leaks</h4>
					<?php $query = new WP_Query( array('posts_per_page' => 5, 'post_type' => array('news', 'guide'), 'tag' => 'bundeswehr') ); ?>
					<?php if ( $query->have_posts() ) : ?>
						<ol class="list list--shortnews">
							<?php $i = 0; ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">

									<span class="post-meta">
										<span class="post-date"><?php echo the_time(get_option('date_format'));?></span> 
										<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
											<?= $subtitle ?>
										<?php endif ?>
									</span>

									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
						</ol>
						<a class="button" href="<?= home_url('/')?>thema/bundeswehr"><span>Alle Bundeswehr Leaks</span><i class="icon fa fa-angle-double-right"></i></a>
					<?php endif ?>
				</div>
			</div>
		

		</div>
	</section>



	<!--
	<div class="content__area">
		<section class="section section--posts">
			
			<header class="section__header">
				<h3 class="section__title">Heute ist</h3>
				<span class="section__separator"></span>
			</header>

			<div class="section__content">
				<h4>Der Interationale Tag der Jogginghose</h4>
				<p>Also los los.</p>
			</div>

		</section>
	</div>
	-->

	<?php get_template_part('template-parts/sections/promis') ?>
	<?php get_template_part('template-parts/sections/gender') ?>
	<?php get_template_part('template-parts/sections/ratgeber') ?>


	<!--
	<div class="content__area">
		<section class="section section--posts">
			<header class="section__header">
				<h3 class="section__title">Produkte</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 9, 'post_type' => array('post'), 'category_name' => get_category_by_slug('produkte')->cat_name )); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="list list--slider">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						
						<?php $bgImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium_large');?>
						<li class="list-item">
							<?php if (has_post_thumbnail()):?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
									<figure class="post-image" style="width:<?= $bgImage[1] ?>px; height:<?= $bgImage[2] ?>px;">
										<?php the_post_thumbnail('medium_large')?>
										<span class="post-title"><?php the_title() ?></span>
									</figure>
								</a>
							<?php endif ?>
						</li>

					<?php $i++ ?>
					<?php endwhile; ?>
				</ol>
			<?php endif ?>
			
			<footer class="section__footer">
				<a href="<?= home_url('/')?>sprueche" class="button button__section">Alle Sprüche</a>
			</footer>

		</section>
	</div>
	-->

	<?php showAD('superbanner'); ?>

	<?php get_template_part('template-parts/category-sections/quiz') ?>
	<?php get_template_part('template-parts/category-sections/politik') ?>
	<?php get_template_part('template-parts/category-sections/wirtschaft') ?>

	<?php showAD('superbanner'); ?>

	<?php get_template_part('template-parts/category-sections/wissen') ?>
	<?php get_template_part('template-parts/category-sections/kultur') ?>
	<?php get_template_part('template-parts/category-sections/sport') ?>

	<?php showAD('superbanner'); ?>



	<section class="section section--sprueche">
		<div class="section__pane">
			<header class="section__header">
				<h3 class="section__title">Sprüche und Blödsinn</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 7, 'post_type' => array('saying') )); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="teasers-images">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						
						<?php $bgImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium_2x');?>
						<li>
							<?php if (has_post_thumbnail()):?>
								<!--
								<div class="quote-box <?php echo ($i > 0) ? 'quote-box--small' : 'quote-box--medium' ?>">
								<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
									<figure class="post-image" style="width:<?= $bgImage[1] ?>px; height:<?= $bgImage[2] ?>px;">
										<?php the_post_thumbnail('medium_2x')?>
										<span class="post-title"><?php the_title() ?></span>
									</figure>
								</a>
								</div>
								-->

								<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
									<img src="<?= get_bloginfo('template_url')?>/app/generated_images/<?php echo sanitize_title(get_the_title($post->ID))?>_640_640_mick.png" width="160px" height="160px" alt="<?= get_the_title($post->ID) ?>" />
								</a>

							<?php else: ?>

								<?php if (!imageExists(sanitize_title(get_the_title($post->ID)) . '_640_640.png')): ?>
									<?php generateImage(get_the_title($post->ID)); ?>
								<?php endif ?>
								
								<a href="<?php the_permalink(); ?>" title="<?= get_the_title($post->ID) ?>">
									<img src="<?= home_url('/')?>images/<?php echo sanitize_title(get_the_title($post->ID))?>_640_640.png" width="160px" height="160px" alt="<?= get_the_title($post->ID) ?>" />
								</a>
								
							<?php endif ?>
						</li>

					<?php $i++ ?>
					<?php endwhile; ?>
				</ol>
			<?php endif ?>
			
			<footer class="section__footer">
				<a href="<?= home_url('/')?>sprueche" class="button button__section"><span>Alle Sprüche</span><i class="icon fa fa-angle-double-right"></i></a>
			</footer>

		</div>
	</section>


	<!--
	<section class="section section--statistics">
		<div class="section__pane">
			<header class="section__header">
				<h3 class="section__title">Die Besten Statistiken</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 3, 'post_type' => array('statistic') ) ); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="list list--statistics">
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						<li class="list-item">
							<span class="number"><?php echo get_post_meta($post->ID, 'number', true)?></span>
							<?php the_content() ?>
						</li>
					<?php endwhile; ?>
				</ol>
			<?php endif ?>

			<footer class="section__footer">
				<a href="<?= home_url('/')?>/statistiken" class="button button__section"><span>Alle Statistiken</span><i class="icon fa fa-angle-double-right"></i></a>
			</footer>

		</div>
	</section>
	-->



</div>

<?php get_footer(); ?>
