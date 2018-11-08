<section class="section section-latest-posts">

  <?php
    $latestPosts = new WP_Query(
      array(
        'posts_per_page' => 5,
        'meta_key' => 'post-views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
      )
    );
  ?>

  <?php //$latest_posts = wp_get_recent_posts( array('numberposts' => 3), OBJECT ); ?>
  <?php //$num = rand( 0, count( $latest_posts )-1 )?>

  <h3 class="section-headline"><?php _e('Die 5 lustigsten Beiträge')?></h3>

  <div class="section-content">

    <ul class="post-list">

    <?php $i = 0; ?>
    <?php while ( $latestPosts->have_posts() ) : $latestPosts->the_post(); setup_postdata($post) ?>
      <?php //if( $i == $num ):?>

        <li class="post-list-item">

          <a class="post-list-link" href="<?php echo get_permalink( $post->ID ) ?>" title="<?php echo $post->post_title ?>">

            <?php if ( has_post_thumbnail( $post->ID ) ): ?>
              <?php echo get_the_post_thumbnail($post->ID, 'thumbnail', array('title' => false))?>
            <?php else:?>
              <!-- <img src="<?php bloginfo('template_url')?>/layout/images/post-default.png" alt="Post Thumbnail" /> -->
            <?php endif;?>

            <span class="article-title">
              <?php echo $post->post_title ?>
            </span>

          </a>

          <div class="post-list-meta">

            <span class="post-views"><?php echo ThemeController::getPostViews($post->ID) ?> Aufrufe</span>
            <span class="post-comments"><?php echo comments_number('0 Kommentare') ?></span>

            <span class="post-votes">
              <?php echo ThemeController::getPostVotes($post->ID) ?>
            </span>

          </div>


        </li>
      <?php //endif?>
    <?php $i++?>
    <?php endwhile; ?>
    </ul>

  </div>

</section>
