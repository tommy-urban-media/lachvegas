<?php

if (function_exists('get_field')) {
	$relatedPosts = get_field('post_related_posts', $post->ID);
}

?>

<?php if ($relatedPosts) : ?>
<div class="related-posts">
  <h4>Das könnte dich auch interessieren</h4>
  <ol class="related-posts__list">
    <?php $i = 0; ?>
    <?php foreach($relatedPosts as $relatedPost): ?>
      <li class="related-posts__list__item">
				<?php global $post; $post = $relatedPost ?>
        <?php get_template_part('template-parts/teasers/teaser-related-posts-list') ?>
      </li>
    <?php $i++ ?>
		<?php endforeach; ?>
  </ol>
</div>
<?php endif ?>