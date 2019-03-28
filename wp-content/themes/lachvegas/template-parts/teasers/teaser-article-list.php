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
	'is_today' => false
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
$post_data['tag'] = null;

$postSubtitle = get_post_meta($post->ID, 'subtitle', true);
$postTag = null;

$tag = get_the_tags();
if ($tag) {
  $postTag = $tag[0]; 
}


$postExternalImageUrl = get_post_meta($post->ID, 'external_image_url', true);
$postExternalImageSource = get_post_meta($post->ID, 'external_image_source', true);
$post_data['externalImageUrl'] = $postExternalImageUrl;
$post_data['externalImageSource'] = $postExternalImageSource;

$post_data['is_video'] = (bool) get_post_meta($post->ID, 'is_video', true);

$excerpt = custom_excerpt(get_the_excerpt($post->ID), 24);

$postPersonTaxomony = get_the_terms($post->ID, 'people');

//var_dump($postPersonTaxomony);

if (isset($postPersonTaxomony[0])) {
  $post_data['taxonomyUrl'] = get_term_link( $postPersonTaxomony[0]->term_id, 'people');
  $post_data['taxonomyName'] = $postPersonTaxomony[0]->name;

  $post_data['taxonomyImage'] = get_custom_field($postPersonTaxomony[0], 'taxonomy_image');
  $post_data['taxonomyImageUrl'] = get_custom_field($postPersonTaxomony[0], 'taxonomy_image_url');
  $post_data['taxonomyImageUrlSource'] = get_custom_field($postPersonTaxomony[0], 'taxonomy_image_source');
}

$post_data = (object)$post_data;

?>

<!--
<?php if (($postSubtitle || $postTag) && $post->post_type != 'news'): ?>
<span class="post-meta">
  <?php if ($postSubtitle): ?>
    <span class="post-subtitle"><?= $postSubtitle ?></span>
  <?php elseif ($postTag): ?>
    <a class="post-tag-link" href="<?= get_term_link($postTag->term_id) ?>"><?= $postTag->name ?></a> 
  <?php endif ?>
</span>
<?php endif ?>
-->

<!--
<?php if($post->post_type !== 'news'): ?>
  <a class="post-title" href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
    <?php if ($post->post_type === 'news'): ?>
      <span class="post-date"><?php echo the_time(get_option('date_format'));?></span>
    <?php endif ?>
    <?php the_title() ?>
  </a>
<?php endif ?>
-->



<article class="teaser">
	<?php if (has_post_thumbnail()):?>
		<figure class="teaser__image">
			<a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
				<?php 
					switch($post->post_type) {
						case 'saying': 
							the_post_thumbnail('thumbnail');
							break;
						default:
							the_post_thumbnail('article_thumbnail');
							break;
					}
						
				?>
			</a>
		</figure>
  	<?php endif ?>

	<?php //var_dump($post_data) ?>
	<?php if (!empty($post_data->externalImageUrl)): ?>
		<a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
		<figure class="post-image post-image--teaser">

			<?php if($post_data->is_video): ?>
			<span class="post-media-type is-video">
				<i class="fa fa-play-circle"></i>
				Video
			</span>
			<?php endif ?>

			<img src="<?= $post_data->externalImageUrl ?>" />

			<?php if (isset($post_data->externalImagSource)): ?>
			<figcaption class="caption"><?= $post_data->externalImagSource ?></figcaption>
			<?php endif ?>
		</figure>
		</a>
	<?php endif ?>

	<?php if (!empty($post_data->taxonomyImageUrl)): ?>
		<a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
		<figure class="post-image post-image--teaser">
			<img src="<?= $post_data->taxonomyImageUrl ?>" />

			<?php if (isset($post_data->taxonomyImageUrlSource)): ?>
			<figcaption class="caption"><?= $post_data->taxonomyImageUrlSource ?></figcaption>
			<?php endif ?>
		</figure>
		</a>
	<?php endif ?>

	<div class="teaser__content">
				
		<?php if ($postTag or isset($post_data->taxonomyUrl) or !empty($teaser->subtitle)): ?>
		<span class="post-meta">

			<?php if (!empty($teaser->subtitle)): ?>
				<span class="teaser-subtitle"><?= $teaser->subtitle ?></span>
			<?php endif ?>
				
			<?php if (!empty($teaser->tags)): ?>
				<?php foreach($teaser->tags as $tag): ?>
					<a class="post-tag-link" href="<?= get_term_link($tag->term_id) ?>"><?= $tag->name ?></a> 
				<?php endforeach ?>
			<?php endif ?>

			<?php if (isset($post_data->taxonomyUrl)): ?>
				<a class="post-tag-link" href="<?= $post_data->taxonomyUrl ?>"><?= $post_data->taxonomyName ?></a>
			<?php endif ?>
		</span>
		<?php endif ?>

		<a class="post-title" href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
			<?php the_title() ?>
		</a>

		<?php if ($post->post_type != 'news' && (strlen($excerpt) > 2)): ?>
    		<div class="post-excerpt">
				<span class="post-date"><?php echo the_time(get_option('date_format'));?> - </span>
				<?php echo $excerpt ?>
			</div>
		<?php endif ?>

	</div>
</article>



<!--
<div class="post-content">

  <?php if (has_post_thumbnail()):?>
    <a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
      <figure class="post-image post-image--teaser">
        <?php the_post_thumbnail('thumbnail')?>
      </figure>
    </a>
  <?php endif ?>

  <?php if (!empty($post_data->externalImageUrl)): ?>
    <a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
      <figure class="post-image post-image--teaser">

        <?php if($post_data->is_video): ?>
          <span class="post-media-type is-video">
            <i class="fa fa-play-circle"></i>
            Video
          </span>
        <?php endif ?>

        <img src="<?= $post_data->externalImageUrl ?>" />

        <?php if (isset($post_data->externalImagSource)): ?>
        <figcaption class="caption"><?= $post_data->externalImagSource ?></figcaption>
        <?php endif ?>
      </figure>
    </a>
  <?php endif ?>

  <?php if (isset($post_data->taxonomyImageUrl)): ?>
    <a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
      <figure class="post-image post-image--teaser">
        <img src="<?= $post_data->taxonomyImageUrl ?>" />

        <?php if (isset($post_data->taxonomyImageUrlSource)): ?>
        <figcaption class="caption"><?= $post_data->taxonomyImageUrlSource ?></figcaption>
        <?php endif ?>
      </figure>
    </a>
  <?php endif ?>

  <?php //if ($post->post_type === 'news'): ?>
    <span class="post-meta">
      <span class="post-date"><?php echo the_time(get_option('date_format'));?></span>

      <?php if ($postTag || isset($post_data->taxonomyUrl)): ?>
        -
      <?php endif ?>

      <?php if ($postTag): ?>
        <a class="post-tag-link" href="<?= get_term_link($postTag->term_id) ?>"><?= $postTag->name ?></a> 
      <?php endif ?>

      <?php if (isset($post_data->taxonomyUrl)): ?>
        <a class="post-tag-link" href="<?= $post_data->taxonomyUrl ?>"><?= $post_data->taxonomyName ?></a>
      <?php endif ?>
    </span>
    <a class="post-title" href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
      <?php the_title() ?>
    </a>
  <?php //endif ?>

  <?php //if ( !has_category( 'kurzmeldungen', $post->ID) ): ?>
  <?php if ($post->post_type != 'news' && (strlen($excerpt) > 2)): ?>
    <div class="post-excerpt"><?php echo $excerpt ?></div>
  <?php endif ?>

</div>

-->