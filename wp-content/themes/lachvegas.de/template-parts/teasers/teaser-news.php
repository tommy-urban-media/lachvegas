<?php 

$current_day = date('d');
$current_month = date('m');

$teaser = [
	'id' => $post->ID,
	'type' => $post->post_type,
	'date' => get_the_time(get_option('date_format')),
	'datetime' => get_the_time('Y-m-d H:i:s'),
	'title' => get_the_title($post->ID),
	'subtitle' => get_post_meta($post->ID, 'subtitle', true),
	'excerpt' => custom_excerpt(get_the_excerpt($post->ID), 24),
	'tags' => get_the_tags(),
	'is_today' => false,
	'is_yesterday' => false
];

// the post entry is from today or not
$timestamp = strtotime($post->post_date);
$d = date('d', $timestamp);
$m = date('m', $timestamp);

$teaser['is_today'] = ($d === $current_day && $m === $current_month);
$teaser['is_yesterday'] = ($d === $current_day-1 && $m === $current_month);



$teaser = (object)$teaser;

//var_dump($teaser);

$post_data = [];
$post_data['subtitle'] = get_post_meta($post->ID, 'subtitle', true);
$post_data['tag'] = null;

$postSubtitle = get_post_meta($post->ID, 'subtitle', true);
$postTag = null;

$tag = get_the_tags();
if ($tag) {
  $postTag = $tag[0]; 
}

$postPersonTaxomony = get_the_terms($post->ID, 'people');

if (isset($postPersonTaxomony[0])) {
  $post_data['taxonomyUrl'] = get_term_link( $postPersonTaxomony[0]->term_id, 'people');
  $post_data['taxonomyName'] = $postPersonTaxomony[0]->name;
}

$post_data = (object)$post_data;

?>


<article class="teaser" style="padding-right: 40px">
	<div class="teaser__time">
	<time class="post-date <?= $teaser->is_today ? 'is-today' : '' ?>" datetime="<?= $teaser->datetime ?>"><?= ($teaser->is_today) ? 'heute' : $teaser->date ?></time>
	</div>
	<div class="teaser__content">
		<?php if (!empty($teaser->subtitle)): ?>
			<span class="post-meta">
				<span class="teaser__subtitle"><?= $teaser->subtitle ?></span>
			</span>
		<?php endif ?>

		<?php if ( strlen($post->post_content) >= 10): ?>
			<a class="post-title" href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
				<?php the_title() ?>
			</a>
		<?php else: ?>
			<span>
				<?php the_title() ?>
			</span>
		<?php endif ?>
	</div>
</article>
