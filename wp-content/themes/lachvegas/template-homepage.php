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
	'post_type' => 'news'
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
										<?php get_template_part('template-parts/ads/jochen-scheisser')?>
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
										<span class="post-date"><?php echo the_date('d.m.Y')?></span>
										<?php echo custom_excerpt(get_the_excerpt($post->ID), 24) ?>
									</div>
								</li>

							<?php $i++ ?>
							<?php endwhile; ?>
							</ol>
					<?php endif ?>


					<ul class="pagination">
						<li class="previous-posts">
							<?php previous_posts_link( '<< Zurück', $queryNews->max_num_pages ); ?>
						</li>
						<li class="next-posts">
							<?php next_posts_link( 'Weiter >>', $queryNews->max_num_pages ); ?>
						</li>
					</ul>

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



	<div class="content__area">
		<section class="section section--people">
			<div class="section__area">
				<div class="section__content">
					<ol class="list list--people">
						
						<?php 
						$people = [
							
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
			</div>
		</section>
	</div>
	

	<div class="content__area">
		<section class="section section--gender">
			<div class="section--gender--man">
				<h3>Frauen sind ...</h3>
				<p>abergläubisch, abhängig, allwissend, ängstlich, anstrengend, applaussüchtig, arrogant, aufbrausend, aufgeregt, ausgeflippt, modesüchtig</p>

				<p><a href="#">Mehr über Frauen ... </a></p>
			</div>
			<div class="section--gender--woman">
				<h3>Männer sind ...</h3>
				<p>akribisch, stur,, peinlich, aggressiv, albern, angeberisch, anspruchslos, aufmüpfig</p>
				<p><a href="#">Mehr über Männer ... </a></p>
			</div>
		</section>
	</div>


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
				<a href="/10-dinge" class="button button__section">Mehr aus diesem Bereich</a>
			</footer>

		</section>
	</div>




	<div class="content__area">
		<section class="section section--posts">
			<header class="section__header">
				<h3 class="section__title">Wissen</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 6, 'post_type' => array('post'), 'category_name' => get_category_by_slug('wissen')->cat_name ) ); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="list list--teaser-text">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						<li class="list-item">

							<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
							<span class="post-meta">
								<?= $subtitle ?>

								<?= getChildCategory($post->ID) ?>
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
				<a href="/10-dinge" class="button button__section">Mehr aus diesem Bereich</a>
			</footer>

		</section>
	</div>




	<div class="content__area">
		<section class="section section--posts">
			<header class="section__header">
				<h3 class="section__title">Spruch des Tages</h3>
				<span class="section__separator"></span>
			</header>
			<?php $query = new WP_Query( array('posts_per_page' => 1, 'post_type' => array('saying') )); ?>
			<?php if ( $query->have_posts() ) : ?>
				<ol class="list list--slider">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
						
						<?php $bgImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium_2x');?>
						<li class="list-item">
							<?php if (has_post_thumbnail()):?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>">
									<figure class="post-image">
										<?php the_post_thumbnail('medium_2x')?>
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
				<a href="<?= home_url('/')?>kategorie/sprueche" class="button button__section">Alle Sprüche</a>
			</footer>

		</section>
	</div>


</div>

<?php get_footer(); ?>
