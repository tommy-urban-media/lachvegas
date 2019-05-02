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

		<?php get_template_part('template-parts/article-jsonld'); ?>		

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


			<?php 
				$relations = get_field('quiz_questions');
				var_dump($relations);	

				foreach ($relations as $question) {
					var_dump($question->ID);
					echo apply_filters('the_content', $question->post_content);
					$answers = get_field('quiz_answers', $question->ID);
					
					foreach ($answers as $answer) {
						echo apply_filters('the_content', $answer->post_content);
					}
					
				}

			?>

			<div class="quiz" data-component="Quiz" data-param='<?= json_encode($quiz) ?>' data-url="<?php echo admin_url('admin-ajax.php') ?>">
				<?php foreach($quiz['questions'] as $index => $q): ?>
					<div class="quiz__item" data-question-id="<?= $q['id'] ?>" data-question-result="<?= $q['result'] ?>">
						<span class="quiz__item__number"></span>
						
						<h3 class="quiz__item__title"> Frage <?= $index+1 ?>: <?= $q['question_text'] ?></h3>
						
						<?php if (isset($q['text'])):?>
							<div class="quiz__item__content">
								<p><?= $q['text'] ?></p>
							</div>
						<?php endif ?>

						<div class="quiz__actions">
							<?php foreach($q['answers'] as $answer): ?>
							<button class="quiz__button quiz__button--<?= $answer['value'] ?>" data-button data-value="<?= $answer['value'] ?>" data-answer-id="<?= $answer['id'] ?>"><?= $answer['label']?></button>
							<?php endforeach ?>
						</div>

						<div class="quiz__answer-text" data-answer-text>
							<span data-answer-pretext></span>
							<p>
								<span data-answer-right-wrong></span>
								<?= $q['answer_text'] ?>
							</p>
						</div>
					</div>
				<?php endforeach ?>

				<div class="quiz__summary" data-summary>
					<h3>Auswertung</h3>
					<div data-summary-text>... <em>Bitte beantworte alle Fragen um die Auswertung zu sehen.</em></div>
				</div>
			</div>

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



<?php /* ?>

<div class="content">
	<div class="content__area">
		<div class="content__area--primary">
			<article class="article article__quiz" data-id="<?php echo $post->ID ?>">

				<?php //echo get_template_part('template-parts/article', 'jsonld'); ?>
				<?php get_template_part('template-parts/article-socials') ?>

				<header class="article-header">

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
					</div>

					<h1 class="article-title">
						<span class="article-title-headline"><?php the_title()?></span>
					</h1>

					<?php if ( $post->post_excerpt ):?>
						<div class="article-excerpt">
							<p><?php echo $post->post_excerpt ?></p>
						</div>
					<?php endif;?>

					<?php if (has_post_thumbnail()):?>
						<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); ?>
						<?php $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'full'); ?>
						<figure class="post-image">
							<a href="<?php echo $post_thumbnail[0]?>" rel="gallery-group">
								<?php the_post_thumbnail('16_9_full')?>
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

					<?php the_content()?>

					<div class="quiz" data-component="Quiz" data-param='<?= json_encode($quiz) ?>' data-url="<?php echo admin_url('admin-ajax.php') ?>">
						<?php foreach($quiz['questions'] as $index => $q): ?>
							<div class="quiz__item" data-question-id="<?= $q['id'] ?>" data-question-result="<?= $q['result'] ?>">
								<span class="quiz__item__number"></span>
								
								<h3 class="quiz__item__title"> Frage <?= $index+1 ?>: <?= $q['question_text'] ?></h3>
								
								<?php if (isset($q['text'])):?>
									<div class="quiz__item__content">
										<p><?= $q['text'] ?></p>
									</div>
								<?php endif ?>

								<div class="quiz__actions">
									<?php foreach($q['answers'] as $answer): ?>
									<button class="quiz__button quiz__button--<?= $answer['value'] ?>" data-button data-value="<?= $answer['value'] ?>" data-answer-id="<?= $answer['id'] ?>"><?= $answer['label']?></button>
									<?php endforeach ?>
								</div>

								<div class="quiz__answer-text" data-answer-text>
									<span data-answer-pretext></span>
									<p>
										<span data-answer-right-wrong></span>
										<?= $q['answer_text'] ?>
									</p>
								</div>
							</div>
						<?php endforeach ?>

						<div class="quiz__summary" data-summary>
							<h3>Auswertung</h3>
							<div data-summary-text>... <em>Bitte beantworte alle Fragen um die Auswertung zu sehen.</em></div>
						</div>
					</div>

				</div>

				<!--
				<div class="quiz" data-component="Quiz">
					<?php foreach($quiz as $index => $q): ?>
						<div class="quiz__item">
							<span class="quiz__item__number"></span>
							<h3 class="quiz__item__title"> <?= $index+1 ?>/<?= count($quiz) ?> <?= $q['title'] ?></h3>
							<div class="quiz__item__content">
								<p><?= $q['question'] ?></p>
							</div>
							<ol class="quiz__answers">
								<?php foreach($q['answers'] as $answer): ?>
								<li data-name="<?= $answer ?>" class="quiz__answer"><?= $answer ?></li>
								<?php endforeach ?>
							</ol>
						</div>
					<?php endforeach ?>
				</div>
				-->


				<footer class="article-footer">

					<?php get_template_part('template-parts/article-socials') ?>
					<?php // echo get_template_part('template-parts/article', 'related-posts'); ?>
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
			<?php echo get_template_part('sidebar')?>
		</div>
	</div>


	<div class="content__area">
		<p>Schau Dir auch diese lustigen Quizze an: </p>
	</div>

</div>

<?php */ ?>

<?php endwhile;?>
<?php get_footer(); ?>
