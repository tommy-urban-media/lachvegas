<?php

/**
 * Class PostController
 *
 * Define Logic for single posts
 */
class PostController {

    private $options = array();

    private $response = array(
        'message' => '',
        'status' => true
    );


    public function __construct () {

        add_action('wp_head', array( &$this, 'trackPostViews'));

        add_action( 'wp_ajax_nopriv_post_vote', array( &$this, 'postVote') );
        add_action( 'wp_ajax_post_vote', array( &$this, 'postVote') );

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
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);

        @session_start();

        if (!isset($_SESSION) || !isset($_SESSION['viewed_posts'])) {
            $_SESSION['viewed_posts'] = array();
        }

        //if (isset($_SESSION) && !in_array($postID, $_SESSION['viewed_posts'])) {

        if ($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);

            $_SESSION['viewed_posts'][] = $postID;
        }

        //}

    }


    public function postVote() {

        @session_start();
  
        $postID = $_REQUEST['post_id'];
        $IP = $_SERVER['REMOTE_ADDR'];
  
        if ( !empty($postID) ) {
            $post = get_post($postID);

            if ($post) {

                if ( isset($_REQUEST['vote_up']) ) {
                    $postVotesUp = (int) get_post_meta($postID, "post_votes_up", true);

                    if (!is_numeric($postVotesUp)) {
                        $postVotesUp = 0;
                    }

                    $postVotesUp++;
                    update_post_meta($postID, "post_votes_up", $postVotesUp);
                }

                else if ( isset($_REQUEST['vote_down']) ) {
                    $postVotesDown = (int) get_post_meta($postID, "post_votes_down", true);

                    if (!is_numeric($postVotesDown)) {
                        $postVotesDown = 0;
                    }

                    $postVotesDown++;
                    update_post_meta($postID, "post_votes_down", $postVotesDown);
                }

            }
  
          
  
            $this->response['status'] = true;
        }
  
        else {
            $this->response['message'] = 'Der Beitrag konnte nicht zugeordnet werden.';
            $this->response['status'] = false;
        }
  
        $this->respond();
    }


    private function respond() {
        echo json_encode($this->response);
        exit;
    }

}
