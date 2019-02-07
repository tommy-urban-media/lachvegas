<?php 

$post_data = [];
$post_data['subtitle'] = get_post_meta($post->ID, 'subtitle', true);
$post_data['tag'] = null;

$postSubtitle = get_post_meta($post->ID, 'subtitle', true);
$postTag = null;

$tag = get_the_tags();
if ($tag) {
  $postTag = $tag[0]; 
}

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

<div class="post-content">

  <?php if (has_post_thumbnail()):?>
    <a href="<?= get_the_permalink($post->ID) ?>" title="<?= get_the_title($post->ID); ?>">
      <figure class="post-image post-image--teaser">
        <?php the_post_thumbnail('article_thumbnail')?>
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
   <!-- <span class="post-date"><?php echo the_time(get_option('date_format'));?></span> -->
    <div class="post-excerpt"><?php echo $excerpt ?></div>
  <?php endif ?>

</div>