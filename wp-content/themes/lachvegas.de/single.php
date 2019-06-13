<?php get_header(); ?>

<?php 

$postSubtitle = get_post_meta($post->ID, 'subtitle', true);
$postTag = null;

$tag = get_the_tags();
if ($tag) {
  $postTag = $tag[0]; 
}

$post_data = new stdClass();

$postExternalImageUrl = get_post_meta($post->ID, 'external_image_url', true);
$postExternalImageSource = get_post_meta($post->ID, 'external_image_source', true);
$post_data->externalImageUrl = $postExternalImageUrl;
$post_data->externalImageSource = $postExternalImageSource;


$post_data->original_date = get_post_meta($post->ID, 'original_date', true);

$votes = new StdClass();
$votes->up = get_post_meta($post->ID, 'post_votes_up', true);
$votes->down = get_post_meta($post->ID, 'post_votes_down', true);

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
						<?php the_post_thumbnail('full')?>
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

		<section class="article-body article-content <?php /*state-paywall */?>">
            
			<?php //get_template_part('partials/common/paywall')?>
          
			<div class="entry-content">
				<?php the_content() ?>
				
				<?php //get_template_part('template-parts/article/puzzle') ?>

				<?php if ($post_data->original_date): ?>
					<p><em>Hinweis: Dieser Artikel wurde erstmals veröffentlicht am <?php echo date('d.m.Y', strtotime($post_data->original_date)) ?>.</em></p>
				<?php endif ?>
			</div>

			<!--
			Daumen hoch: Der Beitrag ist echt lustig und bekloppt
			Daumen runter: Der Beitrag ist überhaupt nicht lustig
			Daumen zur Seite: Mh.. ich bin völlig verwirrt
			-->

		</section>

		<section class="article-votes" data-component="PostVote" data-post-id="<?= $post->ID ?>" data-url="<?= admin_url('admin-ajax.php') ?>">
			<div class="article-votes__header"><span>Beitrag lustig oder nicht lustig?</span></div>
			<div class="article-votes__body">
				<button class="button-vote-up" data-vote-up title="Der Beitrag ist echt lustig und bekloppt">
					<i class="fa fa-thumbs-up"></i> lustig <?= ($votes->up) ? '(' . $votes->up . ')' : ''?>
				</button>
				<button class="button-vote-down" data-vote-down title="Der Beitrag ist überhaupt nicht lustig">
					<i class="fa fa-thumbs-down"></i> nicht lustig <?= ($votes->down) ? '(' . $votes->down . ')' : ''?>
				</button>
			</div>
		</section>
		
		<?php if (has_tag()): ?>
			<section class="tags">
				<span class="tags__title"><?= __('Themen') ?>:</span>
				<?= get_the_tag_list('<ul class="list list--tags"><li class="list-item">', '</li><li class="list-item">', '</li></ul>')?>
			</section>
		<?php endif ?>


		<footer class="article-footer">
			<?php get_template_part('template-parts/article-socials') ?>
			<?php //get_template_part('template-parts/article/top-article'); ?>
			<?php get_template_part('template-parts/article/related-posts'); ?>
			<?php get_template_part('template-parts/article/newest-posts'); ?>
			<?php // echo get_template_part('template-parts/article', 'vote'); ?>
			<?php // echo get_template_part('template-parts/article', 'author'); ?>
		</footer>

		<aside class="article-footer-components">

			<div class="component"><?php get_template_part('template-parts/sidebar/news'); ?></div>
			<div class="component"><?php get_template_part('template-parts/common/jobs'); ?></div>

		</aside>

		<?php ADManager::display('leaderboard')?>

	</article>

	<?php //get_template_part('template-parts/sections/stupid'); ?>
	<?php get_template_part('template-parts/sections/newsletter'); ?>

</div>



<?php // get_template_part('template-parts/sections/lachvegas-fragt-dich'); ?>




<?php /* ?>
<div class="content">

	<?php while ( have_posts() ) : the_post(); setup_postdata($post); ?>

		<?php
			$post_likes = get_post_meta( $post->ID, 'post-likes', true );
			$post_comments = get_comments_number( $post->ID );
		?>

		<?php $post_views = (int)get_post_meta( $post->ID, 'post-views', true ); ?>

		<?php //if( !postViewed($post->ID) ):?>
		<?php //$post_views += 1?>
		<?php //endif;?>

		<?php if( $post_views == 0 ): ?>
			<?php //add_post_meta($post->ID, 'post-views', '1' ); ?>
		<?php else:?>
			<?php //update_post_meta($post->ID, 'post-views', $post_views ); ?>
		<?php endif;?>

		<div class="content__area">
			<div class="content__area--primary">
				<article class="article" id="sitecontent" role="main" data-id="<?php echo $post->ID ?>">

					<?php //echo get_template_part('template-parts/article', 'jsonld'); ?>
					
					<?php get_template_part('template-parts/article-socials') ?>

					<header class="article-header">

						<!--
						<?php if (isset(get_the_category()[0]->name)): ?>
							<a href="<?php echo get_category_link(get_the_category()[0]->term_id)?>" class="article-title-link"><?php echo get_the_category()[0]->name ?></a>
						<?php endif ?>
						-->

						<?php $user_data = get_userdata($post->post_author); ?>

						<div class="article-meta">

							<span class="article-author-info">
								<?php echo __('von')?>
								<a class="contact-link" href="#">
									<?php echo $user_data->user_firstname?> <?php echo $user_data->user_lastname?>
								</a>
							</span>

							<span class="article-date">
							| <?php echo the_date('d. M, Y')?>
							</span>

							<div class="article-stats">

								<!--
								<?php if (isset($post_views)): ?>
									<span class="article-views" title="<?php _e('Aufrufe')?>">
										<i class="fa fa-eye"></i><?php echo $post_views ? $post_views : 0?>
										<?php _e('Aufrufe')?>
									</span>
								<?php endif;?>
								-->

								<?php if (isset($post_comments) && $post_comments != '0'): ?>
									<a class="article-comments" href="#comments" title="<?php _e('Kommentare')?>">
										<i class="fa fa-comment"></i>
										<?php echo $post_comments ? $post_comments : 0?> <?php _e('Kommentare')?>
									</a>
								<?php endif;?>

							</div>

						</div>

						<?php if ($postSubtitle || $postTag): ?>
						<span class="post-meta">
							<?php if ($postSubtitle): ?>
								<span class="post-subtitle"><?= $postSubtitle ?></span>
							<?php elseif ($postTag): ?>
								<!-- <a class="post-tag-link" href="<?= get_term_link($postTag->term_id) ?>"><?= $postTag->name ?></a> -->
							<?php endif ?>
						</span>
						<?php endif ?>

						<?php if (has_post_thumbnail()):?>
							<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
							<?php $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'full'); ?>
							<figure class="post-image">
								<a href="<?php echo $post_thumbnail[0]?>" rel="gallery-group">
									<?php the_post_thumbnail('full')?>
									<?php //the_post_thumbnail('article_thumbnail')?>
								</a>
								<?php if ($caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
									<figcaption class="caption">
										<?php echo $caption ?>
									</figcaption>
								<?php endif ?>
							</figure>
						<?php endif;?>

					</header>


					<div class="article-content entry-content">
						
						<h1 class="article-title">
							<span class="article-title-headline"><?php the_title()?></span>
						</h1>

						<?php if ( $post->post_excerpt ):?>
							<div class="article-excerpt">
								<p><?php echo $post->post_excerpt ?></p>
							</div>
						<?php endif;?>

						<?php the_content()?>

					</div>


					<footer class="article-footer">

						<?php get_template_part('template-parts/article-socials') ?>
						<?php get_template_part('template-parts/article/related-posts'); ?>
						<?php // echo get_template_part('template-parts/article', 'vote'); ?>
						<?php // echo get_template_part('template-parts/article', 'author'); ?>

						<?php if (has_tag()): ?>
						<div class="tags">
							<span class="tags__title"><?= __('Themen') ?>:</span>
							<?= get_the_tag_list('<ul class="list list--tags"><li class="list-item">', '</li><li class="list-item">', '</li></ul>')?>
						</div>
						<?php endif ?>


						<a name="comments"></a>
						<?php // comments_template( '', true ); ?>


					</footer>

				</article>
			</div>
			<div class="content__area--secondary">
				<?php //echo get_template_part('sidebar')?>
			</div>
		</div>

		<?php endwhile;?>


		<!--
		<div class="content__area">
			<div class="content__area--primary">
				<h3>Produkt der Woche</h3>
				<?php
						$current_week = date("W");
						$productsQuery = new WP_Query( array('posts_per_page' => -1, 'post_type' => array('post'), 'category_name' => get_category_by_slug('produkte')->cat_name, 'date_query' => array('week' => $current_week)) );
				?>
				<?php if ( $productsQuery->have_posts() ) : ?>
				<?php while ( $productsQuery->have_posts() ) : $productsQuery->the_post(); setup_postdata($post)?>

					<?php var_dump($post) ?>

				<?php endwhile ?>
				<?php endif ?>
			</div>
		</div>
		-->

	

</div>
<?php */ ?>

<?php
/* 
if ($post->post_type === 'news'):
	get_template_part('template-parts/common/news-archive');
endif
*/ 
?>

<?php get_footer(); ?>
