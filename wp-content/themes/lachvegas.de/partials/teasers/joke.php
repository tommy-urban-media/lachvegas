<?php 

$current_day = date('d');
$current_month = date('m');

$teaser = [
	'id' => $post->ID,
	'type' => $post->post_type,
	'date' => get_the_time(get_option('date_format')),
	'title' => get_the_title($post->ID),
	'subtitle' => get_post_meta($post->ID, 'subtitle', true),
	'excerpt' => custom_excerpt(get_the_excerpt($post->ID), 24)
];

// the post entry is from today or not
$timestamp = strtotime($post->post_date);
$d = date('d', $timestamp);
$m = date('m', $timestamp);

$teaser['is_today'] = ($d === $current_day && $m === $current_month);


$teaser = (object)$teaser;

//var_dump($teaser);

$post_data = [];
$post_data['subtitle'] = get_post_meta($post->ID, 'subtitle', true);
$post_data = (object)$post_data;


$votes = new StdClass();
$votes->up = get_post_meta($post->ID, 'post_votes_up', true) or 0;
$votes->down = get_post_meta($post->ID, 'post_votes_down', true) or 0;

if (!$votes->up or $votes->up == "") {
	$votes->up = 0;
}
if (!$votes->down or $votes->down == "") {
	$votes->down = 0;
}

$postVotesData = json_encode($votes);

?>

<article class="joke-teaser" data-type="joke">

    <?php if (has_post_thumbnail()):?>
        <figure class="joke-teaser__image">
            <a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
                <?php the_post_thumbnail('article_thumbnail'); ?>
            </a>
        </figure>
    <?php endif ?>

	<div class="joke-teaser__content">
        <?php if (!empty($teaser->subtitle)): ?>
            <span class="joke-teaser__subtitle"><?= $teaser->subtitle ?></span>
        <?php endif ?>
		<?php the_content() ?>
	</div>

    <div class="joke-teaser__actions" data-component="PostVote" data-param='<?= $postVotesData ?>' data-post-id="<?= $post->ID ?>" data-url="<?= admin_url('admin-ajax.php') ?>">

        <button class="joke-teaser__button" data-vote-up title="Der Beitrag ist echt lustig und bekloppt">
            <i class="fa fa-thumbs-up"></i> (<span data-votes-up><?= $votes->up?></span>)
        </button>
        <button class="joke-teaser__button" data-vote-down title="Der Beitrag ist überhaupt nicht lustig">
            <i class="fa fa-thumbs-down"></i>(<span data-votes-down><?= $votes->down?></span>)
        </button>

        <a class="joke-teaser__button" href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
            <i class="fa fa-link"></i>
        </a>
    </div>

</article>

