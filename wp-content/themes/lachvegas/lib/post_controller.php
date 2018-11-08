<?php

/**
 * Class PostController
 *
 * Define Logic for single posts
 */
class PostController {

  private $options = array();


  public function __construct () {

    add_action('wp_head', array( &$this, 'trackPostViews'));


    //To keep the count accurate, lets get rid of prefetching
    //remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


  }


  public function trackPostViews() {

    //function wpb_track_post_views ($post_id) {
      if ( !is_single() ) return;
      if ( empty ( $post_id) ) {
          global $post;
          $post_id = $post->ID;
      }
      $this->savePostViews($post_id);
    //}

  }

  public function savePostViews ($postID) {
    $count_key = 'post-views';
    $count = get_post_meta($postID, $count_key, true);

    @session_start();

    if (!isset($_SESSION) || !isset($_SESSION['viewed_posts'])) {
      $_SESSION['viewed_posts'] = array();
    }

    if (isset($_SESSION) && !in_array($postID, $_SESSION['viewed_posts'])) {

      if ($count==''){
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
      } else {
          $count++;
          update_post_meta($postID, $count_key, $count);

          $_SESSION['viewed_posts'][] = $postID;
      }

    }

  }

}
