<?php if ($relatedPosts = get_field('post_related_articles')): ?>

  <?php // var_dump($relatedPosts) ?>

  <section class="section article-related-posts">

    <h3 class="headline">Verwandte Beiträge</h3>

    <ul class="post-list">

    <?php foreach ($relatedPosts as $relatedPost): ?>

      <li class="<?php echo ($post->ID === $relatedPost->ID) ? 'active' : '' ?>">

        <a class="post-list-link" href="<?php echo get_permalink( $relatedPost->ID ) ?>" title="<?php echo $relatedPost->post_title ?>">

          <?php if ( has_post_thumbnail( $relatedPost->ID ) ): ?>
            <?php echo get_the_post_thumbnail($relatedPost->ID, 'thumbnail', array('title' => false))?>
          <?php else:?>
            <!-- <img src="<?php bloginfo('template_url')?>/layout/images/post-default.png" alt="Post Thumbnail" /> -->
          <?php endif;?>

          <span class="article-title">
            <?php echo $relatedPost->post_title ?>
          </span>

        </a>

      </li>

    <?php endforeach; ?>

    </ul>

  </section>

<?php endif ?>
