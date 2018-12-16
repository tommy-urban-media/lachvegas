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
	'date_query' => array('year' => array(2017, 2018, 2019)),
	'post_type' => array('news', 'post', 'poem'),
	//'category__not_in' => array(64) // Produkte
);

$queryNews = new WP_Query($args)

?>

<div class="content content-home">

	<div class="content__area">
		<div class="content__area--primary">
			<section class="section section--news">
				<div class="section__content">
					<?php if ( $queryNews->have_posts() ) : ?>
						<ol class="list list--news">
							<?php $i = 0; ?>
							<?php while ( $queryNews->have_posts() ) : $queryNews->the_post(); setup_postdata($post)?>
								<li class="list-item">

									<?php if ($i == 4): ?>
										<?php showAD('banner'); ?>
									<?php endif ?>

									<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
									<span class="post-meta">
										<?= $subtitle ?>
									</span>
									<?php endif ?>

									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<?php the_title() ?>
									</a>

									<div class="post-content">
										<?php if (has_post_thumbnail()):?>
											<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
												<figure class="post-image post-image--teaser">
													<?php the_post_thumbnail('article_thumbnail')?>
												</figure>
											</a>
										<?php endif ?>
										<span class="post-date"><?php echo the_time(get_option('date_format'));?></span>
										<?php echo custom_excerpt(get_the_excerpt($post->ID), 24) ?>
									</div>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
							</ol>
					<?php endif ?>


					<nav class="pagination">
						<span class="previous-posts">
							<?php previous_posts_link( '&laquo; Zurück', $queryNews->max_num_pages ); ?>
						</span>
						<span class="next-posts">
							<?php next_posts_link( 'Weiter &raquo;', $queryNews->max_num_pages ); ?>
						</span>
					</nav>

					<?php //if (function_exists("pagination")): ?>
						<?php //pagination($queryNews->max_num_pages); ?>
					<?php //endif ?>

					<?php wp_reset_postdata();?>

				</div>
			</section>
		</div>
		<div class="content__area--secondary">

			<?php echo get_template_part('sidebar')?>

			<div class="news">
				Aktuelle Kurzmeldungen
				
				<?php $queryShortNews = new WP_Query( array('post_type' => 'news', 'posts_per_page' => -1, 'category_name' => 'kurzmeldungen') ); ?>
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



	<div class="content__area">
		<section class="section section--posts">
			
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

									<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
									<span class="post-meta"><?= $subtitle ?></span>
									<?php endif ?>

									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
						</ol>
						<a class="button" href="<?= home_url('/')?>kategorie/deutschland">Alle Nachrichten</a>
					<?php endif ?>
				</div>
				<div class="flex-item">
					<h4 class="">Regionalmeldungen</h4>
					<?php $query = new WP_Query( array('posts_per_page' => 5, 'post_type' => array('news'), 'category_name' => 'regionalmeldungen') ); ?>
					<?php if ( $query->have_posts() ) : ?>
						<ol class="list list--shortnews">
							<?php $i = 0; ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">

									<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
									<span class="post-meta"><?= $subtitle ?></span>
									<?php endif ?>

									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
						</ol>
						<a class="button" href="<?= home_url('/')?>kategorie/regionalmeldungen">Alle Regionalmeldungen</a>
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

									<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
									<span class="post-meta">
										<?= $subtitle ?>
									</span>
									<?php endif ?>

									<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
						</ol>
						<a class="button" href="<?= home_url('/')?>thema/bundeswehr">Alle Bundeswehr Leaks</a>
					<?php endif ?>
				</div>
			</div>
		

		</section>
	</div>



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


	<!--
	<div class="content__area">
		<section class="section section--people">
			<header class="section__header">
				<h3 class="section__title">Unsere Promis</h3>
				<span class="section__separator"></span>
			</header>
			<div class="section__content">

				<?php $personQuery = new WP_Query( array('posts_per_page' => 12, 'post_type' => array('person')) ); ?>
				<?php if ( $personQuery->have_posts() ) : ?>
				<ol class="list list--people">
					<?php $i = 0; ?>
					<?php while ( $personQuery->have_posts() ) : $personQuery->the_post(); setup_postdata($post)?>
						
						<li class="list-item">
						<a href="<?= get_the_permalink($post->ID) ?>">
							<span class="image-wrapper"><?php the_post_thumbnail('thumbnail') ?></span>
							<span class="person-role"><?= get_post_meta($post->ID, 'role', true) ?></span>
							<span class="person-name"><?php the_title() ?></span>
						</a>
						</li>

					<?php endwhile ?>
				</ol>
				<?php endif ?>
						
					<?php 
					$people = [
						/*
						[
							'name' => 'Angela Merkel',
							'role' => 'Rautenwächterin',
							'url' => '/thema/angela-merkel',
							'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
						],
						[
							'name' => 'Donald Trump',
							'role' => 'Quatschkopp',
							'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/donald-trump-loeste-er-fast-150x150.jpg'
						],
						[
							'name' => 'Adolf Hitler',
							'role' => 'Jahrhunderverbrecher',
							'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
						],
						[
							'name' => 'Heid Klum',
							'role' => 'Schnatter-Tante',
							'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
						],
						[
							'name' => 'Horst Seehofer',
							'role' => 'Störenfried',
							'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
						],
						[
							'name' => 'Kim Jong-Un',
							'role' => 'Raketenmann',
							'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/Borowitz-Trumps-Worst-Hair-Day-150x150.jpg'
						]
						*/
		
					];
					?>

					<?php foreach ($people as $person): ?>
						<li class="list-item">
							<a href="<?= home_url() ?>/thema/angela-merkel">
								<span class="image-wrapper">
									<img src="<?= $person['image'] ?>" />
								</span>
								<span class="person-role"><?= $person['role'] ?></span>
								<span class="person-name"><?= $person['name'] ?></span>
							</a>
						</li>
					<?php endforeach ?>

				</ol>
			</div>
		</section>
	</div>
	-->
	


	<?php // get_template_part('template-parts/content-areas/gender') ?>
				

	<?php 
		$query = new WP_Query(array(
			'posts_per_page' => 1, 
			'date_query' => array(
				array(
					'day' => 30, //date('d'),
					'month' => 5 //date('m')
				)
			),
			'category_name' => get_category_by_slug('feiertage')->cat_name
		)); 	
	?>
	<?php if ( $query->have_posts() ) : ?>
	<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
	<div class="content__area">
		<section class="section section--posts">
			<header class="section__header">
				<h3 class="section__title">Heute ist <strong><?php the_title() ?></strong></h3>
				<span class="section__separator"></span>
			</header>
			<div class="section-content">
				<?php the_content() ?>
				<p>01.05. - Tag der Arbeit</p>
				<p>12.05. - Muttertag</p>
				<p>30.05. - Vatertag</p>
				<p>1. Mai - Tag der Arbeit</p>
				<p>03.10. - Tag der Deutschen Einheit</p>
			</div>
		</section>
	</div>
	<?php endwhile ?>
	<?php endif ?>


	<div class="content__area">
		<section class="section section--posts">
			
			<header class="section__header">
				<h3 class="section__title">Ratgeber</h3>
				<span class="section__separator"></span>
			</header>
			
			<?php $query = new WP_Query( array('posts_per_page' => 6, 'post_type' => array('guide')) ); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="list list--teaser">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						<li class="list-item">

							<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
							<span class="post-meta">
								<?= $subtitle ?>
							</span>
							<?php endif ?>

							<a class="post-title" href="<?= get_the_permalink($post->ID) ?>">
								<span class="news-title"><?php the_title() ?></span>
							</a>

							<div class="post-content">
								<?php if (has_post_thumbnail()):?>
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
										<figure class="post-image post-image--teaser">
											<?php the_post_thumbnail('article_thumbnail')?>
										</figure>
									</a>
								<?php endif ?>
								<!-- <span class="post-date"><?php echo the_date('d.m.Y')?></span> -->
								<?php //echo custom_excerpt(get_the_excerpt($post->ID), 24) ?>
							</div>
						</li>

					<?php $i++ ?>
					<?php endwhile; ?>
				</ol>
			<?php endif ?>
			
			<footer class="section__footer">
				<a href="<?= home_url() ?>/kategorie/10-dinge" class="button button__section">Mehr aus diesem Bereich</a>
			</footer>

		</section>
	</div>



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

	<?php get_template_part('template-parts/category-sections/politik') ?>
	<?php get_template_part('template-parts/category-sections/wirtschaft') ?>
	<?php get_template_part('template-parts/category-sections/wissen') ?>
	<?php get_template_part('template-parts/category-sections/kultur') ?>
	<?php get_template_part('template-parts/category-sections/sport') ?>


	<div class="content__area">
		<section class="section section--posts">
			<header class="section__header">
				<h3 class="section__title">Spruch des Tages</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 5, 'post_type' => array('saying') )); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="grid grid--sayings">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						
						<?php $bgImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium_large');?>
						<li class="grid-item">
							<?php if (has_post_thumbnail()):?>
								<div class="quote-box <?php echo ($i > 0) ? 'quote-box--small' : 'quote-box--medium' ?>">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
									<figure class="post-image" style="width:<?= $bgImage[1] ?>px; height:<?= $bgImage[2] ?>px;">
										<?php the_post_thumbnail('medium_large')?>
										<span class="post-title"><?php the_content() ?></span>
									</figure>
								</a>
								</div>
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



	<!--
	<div class="content__area">
		<section class="section section--posts">
			<header class="section__header">
				<h3 class="section__title">Aktuelle Umfrage</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 6, 'post_type' => array('news', 'post', 'guide', 'statistic'), 'category_name' => get_category_by_slug('wissen')->cat_name ) ); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="list list--teaser-text">
					
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
					<?php endwhile; ?>

				</ol>
			<?php endif ?>

			<div class="question">

				<?php /* do_shortcode('[yop_poll id="1"]') */ ?>
					
				<?php /* get_poll(1); */ ?>

			</div>

		</section>
	</div>
	-->



</div>

<?php get_footer(); ?>
