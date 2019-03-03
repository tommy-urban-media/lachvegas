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

// var_dump($quiz['results']);

?>

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

<?php endwhile;?>
<?php get_footer(); ?>
