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
	//'orderby' => 'modified',
	'orderby' => 'date',
	'date_query' => array(
		'relation' => 'OR',
		'before' => date('Y-m-d H:i:s', strtotime('+1 day'))
	),
	'post_status' => 'publish',
	'post_type' => array('guide', /*'news',*/ 'post', 'poem', 'saying', 'statistic', 'quiz'),
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'post_settings',
			'field' => 'name',
			'terms' => array('teasable')
		)
	)
);

$newPostsQuery = new WP_Query($args);
$max_pages = $newPostsQuery->max_num_pages;

/*
$oldPostsQuery = new WP_Query(array(
	'posts_per_page' => -1,
	'post_type' => array('guide', 'news', 'post', 'poem', 'statistic', 'quiz'),
	'date_query' => array(
		'relation' => 'or',
		array(
			'month' => date('m'),
			'day' => date('d')
		),
		array(
			'month' => date('m'),
			'day' => date('d')-1
		)
	),
	'category_name' => get_category_by_slug('_wiederholend')->cat_name
));
*/

//$mergedQuery = new WP_Query();
//$mergedQuery->posts = array_merge( $newPostsQuery->posts, $oldPostsQuery->posts );
//$mergedQuery->post_count = $newPostsQuery->post_count + $oldPostsQuery->post_count;

?>

<div class="content content-home">

	<?php get_template_part('partials/common/newsticker'); ?>

	<div class="content__area">
		<div class="content__area--primary">

			<?php if ( $newPostsQuery->have_posts() ) : ?>
				<ol class="list list--news">
					<?php $i = 0; ?>
					<?php while ( $newPostsQuery->have_posts() ) : $newPostsQuery->the_post(); setup_postdata($post)?>

						<!--
						<?php if ($i == 4): ?>
							<li class="list-item">
								<?php get_template_part('template-parts/ads/frontend/banner') ?> <?php //showAD('banner'); ?>
							</li>
						<?php endif ?>
						-->

						<li class="list-item">
							<?php get_template_part('template-parts/teasers/teaser-article-list') ?>
						</li>

					<?php $i++ ?>
					<?php endwhile; ?>
				</ol>
			<?php endif ?>

			<?php echo getPagination($newPostsQuery, $paged)?>
			<?php wp_reset_postdata();?>
		</div>

		<aside class="content__area--secondary">
			<?php get_template_part('sidebar')?>
		</aside>
	</div>

	<?php get_template_part('template-parts/sections/news') ?>
	<?php get_template_part('template-parts/sections/newsletter') ?>
	<?php get_template_part('template-parts/sections/topics') ?>
	<?php //get_template_part('template-parts/sections/promis') ?>
	<?php get_template_part('template-parts/sections/fortune-cookie') ?>



	<!-- 
	Ich bin hier überfordert. Ich brauche Hilfe!
	=> Layer öffnet sich mit Auswahl

	Wofür interessierst du dich?

	Physik
	- Für Physiker das ultimative Quiz für Physiker

	Feminismus
	Film
	Musik
	Politik
	Sexualität
	Sport



	Bild mit Arsch und Sonne:
	Schau dir das Bild genau an. Was passiert dort?

	- Ein neuer Stern wird aus einem Schwarzen Loch geboren
	- Ein Stern sucht sich seinen Weg durch das Wurmloch und erreicht unser Universum
	- Ein Schwarzes Loch kollabiert zu einem G-Stern
	- Jemand hat hinten herum das Licht angemacht
	- Jemandem scheint die Sonne aus dem Arsch

	-->

	
	<?php //get_template_part('template-parts/sections/special-day') ?>
    <?php //get_template_part('template-parts/sections/history') ?>
	<?php get_template_part('template-parts/sections/gridbox') ?>

	<?php //get_template_part('template-parts/sections/sayings') ?>
 
	<?php /* ?>
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
	<?php */ ?>
 
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
 
	<?php // get_template_part('template-parts/ads/frontend/superbanner'); ?>
	<?php //ADManager::display('superbanner')?>

	<?php //get_template_part('template-parts/sections/frage-der-woche') ?>
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

	<?php get_template_part('template-parts/category-sections/politik') ?>
	<?php get_template_part('template-parts/category-sections/wirtschaft') ?>
	<?php get_template_part('template-parts/category-sections/gesellschaft') ?>
	<?php get_template_part('template-parts/category-sections/wissen') ?>
	<?php get_template_part('template-parts/category-sections/kultur') ?>
	<?php get_template_part('template-parts/category-sections/sport') ?>
	<?php get_template_part('template-parts/category-sections/unterhaltung') ?>
	<?php get_template_part('template-parts/category-sections/quiz') ?>

</div>

<?php get_footer(); ?>
