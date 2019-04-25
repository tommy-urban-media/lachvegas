
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header class="article-header">

    <?php if (has_post_thumbnail()):?>
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

        <figure class="post-image">

          <?php the_post_thumbnail('article_thumbnail')?>

        </figure>

      </a>
    <?php endif ?>

    <h1 class="article-title">

      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

        <?php the_title(); ?>

      </a>

    </h1>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="article-statistics">
      <?php // theme_posted_on(); ?>

      <?php
				$postLikes = get_post_meta( $post->ID, 'post-likes', true );
				$postComments = get_comments_number( $post->ID );
        $postViews = (int)get_post_meta( $post->ID, 'post-views', true );
			?>

      <span class="article-views" rel="<?php echo $post->ID?>" title="<?php _e('Aufrufe')?>">
        <span><?php echo $postViews ? $postViews : 0?></span> <?php _e('Aufrufe')?>
      </span>

      <?php /* ?>
      <span class="article-likes" rel="<?php echo $post->ID?>" title="<?php _e('Likes')?>">
        <span><?php echo $postLikes ? $postLikes : 0?></span> <?php _e('Likes')?>
      </span>
      <?php */ ?>

      <span class="article-comments" href="#comments" title="<?php _e('Kommentare')?>">
        <?php echo $postComments ? $postComments : 0 ?> <?php _e('Kommentare')?>
      </span>

    </div>
    <?php endif; ?>


    <span class="post-votes">
      <?php echo ThemeController::getPostVotes($post->ID) ?>
    </span>

  </header><!-- .article-header -->


  <div class="article-excerpt">

    <?php // the_excerpt() ?>

    <!--
    <a href="<?php echo get_the_permalink($post->ID)?>" class="button button-readmore"><?php _e('weiterlesen') ?></a>
    -->

  </div>


  <footer class="article-footer">



  </footer>

</article><!-- #post-<?php the_ID(); ?> -->
