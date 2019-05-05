<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); setup_postdata($post); ?>

<?php 

global $quiz_data;
$id = get_post_meta($post->ID, 'quiz_id', true);
$option_name = 'quiz_' . $id;
$quiz = '';
$quiz_results = null;

if ($id) {
	//$quiz = get_option($option_name);
	get_template_part('data/quiz/' . $id);

	if ($quiz_data) {

		$quiz_results = get_option($option_name);
		$quiz = $quiz_data;
		$quiz['results'] = $quiz_results;
		
	} else {
		echo 'No Quiz available!';
	}

} 

$post_data = new stdClass();
$post_data->original_date = get_post_meta($post->ID, 'original_date', true);

// var_dump($quiz['results']);

?>



<div class="article-wrapper">

	<?php get_template_part('template-parts/common/breadcrumb') ?>

	<article class="article" id="sitecontent" data-id="<?= $post->ID ?>">

		<?php get_template_part('template-parts/article/jsonld'); ?>		

		<section class="article-header">

			<?php if ($subtitle = get_post_meta($post->ID, 'subtitle', true)): ?>
				<p class="article-subtitle"><?= $subtitle ?></p>
			<?php endif ?>

			<h1 class="article-title">
				<span class="article-title-headline"><?php the_title()?></span>
			</h1>

			<div class="article-meta-bar">
				<div class="article-meta">
					<?php $words = str_word_count(strip_tags(get_the_content())) ?>
					<?php $readingTime = ceil($words / 250) . ' Min'; ?>

					<span class="article-meta__column article-meta__words">
						<span class="article-meta__label">Wörter: <!--<i class="fas fa-font"></i>--></span>
						<span class="article-meta__text"><?= $words ?></span>
					</span>
					<span class="article-meta__column article-meta__reading-time">
					<span class="article-meta__label">Lesezeit: <!--<i class="fas fa-clock"></i>--></span>
						<span class="article-meta__text"><?= $readingTime ?></span>
					</span>

				</div>
				<?php get_template_part('template-parts/article-socials') ?>
			</div>

			<?php if (has_post_thumbnail()):?>
				<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
				<?php $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'full'); ?>
				<figure class="post-image">
					<a href="<?php echo $post_thumbnail[0]?>" rel="gallery-group">
						<?php the_post_thumbnail('article-header')?>
						<?php //the_post_thumbnail('article_thumbnail')?>
					</a>
					<?php if ($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
						<figcaption class="caption">
							<?php echo $caption ?>
						</figcaption>
					<?php endif ?>
				</figure>
			<?php endif;?>

			<?php if (!empty($post_data->externalImageUrl)): ?>
				<a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
				<figure class="post-image">
					<img src="<?= $post_data->externalImageUrl ?>" alt="Bild: <?= get_the_title() ?>" />
					<?php if (isset($post_data->externalImageSource)): ?>
					<figcaption class="caption"><?= $post_data->externalImageSource ?></figcaption>
					<?php endif ?>
				</figure>
				</a>
			<?php endif ?>

		</section>

		<?php if ( $post->post_excerpt ):?>
			<section class="article-excerpt">
				<p><?php echo $post->post_excerpt ?></p>
			</section>
		<?php endif;?>

		<section class="article-body article-content">
			<?php the_content() ?>

			<?php get_template_part('template-parts/quiz/quiz'); ?>

			<?php //get_template_part('template-parts/article/puzzle') ?>

			<?php if ($post_data->original_date): ?>
				<p><em>Hinweis: Dieser Artikel wurde erstmals veröffentlicht am <?php echo date('m.d.Y', strtotime($post_data->original_date)) ?>.</em></p>
			<?php endif ?>
		</section>
		
		<?php if (has_tag()): ?>
			<div class="tags">
				<span class="tags__title"><?= __('Themen') ?>:</span>
				<?= get_the_tag_list('<ul class="list list--tags"><li class="list-item">', '</li><li class="list-item">', '</li></ul>')?>
			</div>
		<?php endif ?>


		<footer class="article-footer">
			<?php get_template_part('template-parts/article-socials') ?>
			<?php //get_template_part('template-parts/article/top-article'); ?>
			<?php get_template_part('template-parts/article/related-posts'); ?>
			<?php get_template_part('template-parts/article/newest-posts'); ?>
			<?php // echo get_template_part('template-parts/article', 'vote'); ?>
			<?php // echo get_template_part('template-parts/article', 'author'); ?>
		</footer>

	</article>

	<aside class="article-footer-components">

		<div class="component"><?php get_template_part('template-parts/sidebar/news'); ?></div>
		<!-- <div class="component"><?php showAD('portrait'); ?></div> -->
		<div class="component"><?php get_template_part('template-parts/common/jobs'); ?></div>

	</aside>

</div>


<?php get_template_part('template-parts/sections/newsletter'); ?>
<?php get_template_part('template-parts/sections/lachvegas-fragt-dich'); ?>

<?php endwhile;?>
<?php get_footer(); ?>
