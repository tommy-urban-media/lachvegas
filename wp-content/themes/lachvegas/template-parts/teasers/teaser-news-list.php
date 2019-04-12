<?php 

$current_day = date('d');
$current_month = date('m');

$teaser = [
	'id' => $post->ID,
	'type' => $post->post_type,
	'date' => get_the_time(get_option('date_format')),
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


<article class="teaser teaser--small">
	<div class="teaser__content">
		<span class="post-meta">
			<span class="post-date<?= $teaser->is_today ? ' is-today' : '' ?>"><?= ($teaser->is_today) ? 'heute' : $teaser->date ?></span>
			<?php if (!empty($teaser->subtitle)): ?>
				<span class="teaser-subtitle"><?= $teaser->subtitle ?></span>
			<?php endif ?>
			
			<!--
			<?php if (!empty($teaser->tags)): ?>
				<?php foreach($teaser->tags as $tag): ?>
					<a class="post-tag-link" href="<?= get_term_link($tag->term_id) ?>"><?= $tag->name ?></a> 
				<?php endforeach ?>
			<?php endif ?>

			<?php if (isset($post_data->taxonomyUrl)): ?>
				<a class="post-tag-link" href="<?= $post_data->taxonomyUrl ?>"><?= $post_data->taxonomyName ?></a>
			<?php endif ?>
			-->

		</span>

		<a class="post-title" href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
			<?php the_title() ?>
		</a>

	</div>
</article>