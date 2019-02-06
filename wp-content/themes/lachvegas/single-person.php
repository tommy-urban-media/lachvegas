<?php get_header(); ?>


<?php 

$postSubtitle = get_post_meta($post->ID, 'subtitle', true);
$postTag = null;
$role = get_post_meta($post->ID, 'role', true);
$roles = array();

$tag = get_the_tags();
if ($tag) {
  $postTag = $tag[0]; 
}

if ($role) {
	$roles = explode(',', $role); 
}


$queryShortNewsArgs = array(
	'post_type' => array('news', 'post'), 
	'posts_per_page' => -1, 
	'category_name' => 'kurzmeldungen',
	'tag__in' => array($postTag->term_id)
);

$queryShortNews = new WP_Query($queryShortNewsArgs);

?>

<?php get_template_part('template-parts/common/breadcrumb') ?>

<div class="content content-wrapper">
	<div class="content__area content__area--full">

	<?php while ( have_posts() ) : the_post(); setup_postdata($post); ?>

		<?php
			//$post_likes = get_post_meta( $post->ID, 'post-likes', true );
			//$post_comments = get_comments_number( $post->ID );
		?>

		<article class="article-person">
			<header class="article-person__header">

				<div class="article-person__header--left">
					<?php if (has_post_thumbnail()):?>
						<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
						<?php $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail'); ?>
						<figure class="person-image">
							<?php the_post_thumbnail('thumbnail')?>
							<?php if ($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
								<figcaption class="caption">
									<?php echo $caption ?>
								</figcaption>
							<?php endif ?>
						</figure>
					<?php endif;?>
				</div>

				<div class="article-person__header--right">
					<div class="article-person__title-area">
						<div class="article-person__title-area--top">
							<h1 class="person-title"><?= the_title()?></h1>
							<?php if (count($roles)): ?>
							<div class="person-roles">
								<?php foreach ($roles as $role): ?>
									<span class="person-roles__role"><?php echo trim($role) ?></span>
								<?php endforeach ?>
							</div>
						<?php endif ?>
						</div>
						<div class="article-person__title-area--bottom">
							<?php the_content()?>
						</div>
					</div>
				</div>
		
			</header>

			<!--
			<div class="article-person__content">
				<div class="article-content entry-content">
					<?php // the_content()?>
				</div>
			</div>
			-->

		</article>
		

		<?php endwhile;?>
		<?php wp_reset_query() ?>

		<?php 
		
		if ($postTag) {
			$args = array(
				'post_type' => array('guide', 'news', 'post', 'poem', 'statistic', 'quiz'),
				'category__not_in' => array(get_category_by_slug('kurzmeldungen')->term_id), // Kurzmeldungen
				'tag__in' => array($postTag->term_id)
			);
		
			$queryPerson = new WP_Query($args);
		}		

		?>

		<div class="content__area--primary">	

			<h3>Beiträge</h3>

			<?php if ($queryPerson->have_posts()): ?>
			<ol class="list list--news">
				<?php $i = 0; ?>
				<?php while ( $queryPerson->have_posts() ) : $queryPerson->the_post(); setup_postdata($post)?>
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
			<?php wp_reset_postdata();?>
			<?php else: ?>
				<p>Bisher keine Beiträge vorhanden. <br><br></p>
				<p>Wenn du etwas lustiges, spannendes oder kurioses hinzufügen möchtest, schreibe uns unter <a href="mailto:info@lachvegas.de">info@lachvegas.de</a></p>
			<?php endif ?>

		</div>

		<aside class="content__area--secondary">
		
			<?php if ( $queryShortNews->have_posts() ) : ?>
				<h3>Kurzmeldungen</h3>
				<ul class="list list--shortnews">
					<?php while ( $queryShortNews->have_posts() ) : $queryShortNews->the_post(); setup_postdata($post)?>
						<li class="list-item">	
							<a href="<?php echo get_the_permalink($post->ID) ?>"><?php the_title(); ?></a>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			<?php endif ?>

			<?php get_template_part('sidebar') ?>

		</aside>

	</div>

	<!--
	<div class="content__area content__area--full">
		<h3 class="">Andere Personen</h3>
	</div>
	-->

	<?php get_template_part('template-parts/sections/gender') ?>

</div>

<?php get_footer(); ?>
