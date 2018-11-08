<?php

  global $post;

  $postVotesUp = get_post_meta( $post->ID, 'post_votes_up', true );
  $postVotesDown = get_post_meta( $post->ID, 'post_votes_down', true );
  $postVotesNeutral = get_post_meta( $post->ID, 'post_votes_neutral', true );

?>

<section class="section article-vote">

  <h3 class="section-headline">Finden Sie diesen Artikel lustig?</h3>

  <div class="section-content">

    <button class="button button-vote-up" data-url="<?php echo admin_url('admin-ajax.php') ?>" data-action="add_vote" data-key="post_votes_up" data-post="<?php echo $post->ID ?>"><?= _e('Ja') ?></button>
    <button class="button button-vote-down" data-url="<?php echo admin_url('admin-ajax.php') ?>" data-action="add_vote" data-key="post_votes_down" data-post="<?php echo $post->ID ?>"><?= _e('Nein') ?></button>

    <div class="article-vote-result">
      <span class="article-vote-txt">Ergebnis:</span>
      <span class="post-votes">
        <?php echo ThemeController::getPostVotes($post->ID) ?>
      </span>
    </div>

  </div>

</section>
