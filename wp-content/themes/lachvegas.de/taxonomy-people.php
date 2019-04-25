<?php get_header(); ?>


<?php 
//global $post;

//$postSubtitle = get_post_meta($post->ID, 'subtitle', true);
$postTag = null;
//$role = get_post_meta($post->ID, 'role', true);
$role = get_custom_field(get_queried_object(), 'taxonomy_roles');
$image = get_custom_field(get_queried_object(), 'taxonomy_image');

$tag = get_the_tags();
if ($tag) {
  $postTag = $tag[0]; 
}

$roles = [];
if ($role) {
	$roles = explode(',', $role); 
}

$queryShortNewsArgs = array(
	'post_type' => array('news', 'post'), 
	'posts_per_page' => -1, 
	'category_name' => 'kurzmeldungen',
	//'tag__in' => array($postTag->term_id)
);

$queryShortNews = new WP_Query($queryShortNewsArgs);

?>


<div class="content content-wrapper">
	<div class="content__area content__area--full">

	<?php // while (have_posts()) : the_post(); setup_postdata($post); ?>

	<?php get_template_part('template-parts/common/breadcrumb') ?>

		<article class="article-person">
			<header class="article-person__header">

				<div class="article-person__header--left">
					<?php if ($image):?>
						<?php $post_thumbnail = wp_get_attachment_image_src($image['ID'], 'thumbnail'); ?>
						<figure class="person-image">
							<?php echo wp_get_attachment_image($image['ID'], 'thumbnail')?>
							<?php if ($caption = get_post($image['ID'])->post_excerpt): ?>
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
							<h1 class="person-title"><?php single_term_title()?></h1>
							<?php if (count($roles)): ?>
							<div class="person-roles">
								<?php foreach ($roles as $role): ?>
									<span class="person-roles__role"><?php echo trim($role) ?></span>
								<?php endforeach ?>
							</div>
						<?php endif ?>
						</div>
						<div class="article-person__title-area--bottom">
							<?php echo term_description()?>
						</div>
					</div>
				</div>
		
			</header>

		</article>
		

		<?php //endwhile;?>
		<?php //wp_reset_query() ?>

		<?php 
		
		//if ($postTag) {
			$args = array(
				'posts_per_page' => -1,
				'post_type' => array('guide', 'news', 'post', 'poem', 'statistic', 'quiz'),
				'category__not_in' => array(get_category_by_slug('kurzmeldungen')->term_id), // Kurzmeldungen
				'tax_query' => array(
					array(
						'taxonomy' => 'people',
						'field' => 'title',
						'terms' => get_queried_object()->term_id
					)
				),
				//'tag__in' => array($postTag->term_id)
			);
		
			$queryPerson = new WP_Query($args);
		//}		

		?>

		<div class="content__area--primary">	

			<h3>Beiträge</h3>

			<?php if ($queryPerson->have_posts()): ?>
			<ol class="list list--news">
				<?php $i = 0; ?>
				<?php while ( $queryPerson->have_posts() ) : $queryPerson->the_post(); setup_postdata($post)?>
					<?php if ($i == 4 || $i == 12): ?>
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
			<?php get_template_part('sidebar') ?>
		</aside>

	</div>

	<?php get_template_part('template-parts/sections/gender') ?>
	<?php get_template_part('template-parts/sections/newsletter') ?>
	<?php get_template_part('template-parts/sections/lachvegas-fragt-dich') ?>

</div>

<?php get_footer(); ?>
