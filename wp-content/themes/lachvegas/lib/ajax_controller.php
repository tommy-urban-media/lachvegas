<?php

/**
 * AjaxController
 *
 * Handle theme specific ajax calls
 */
class AjaxController {


    private $response = array(
        'message' => '',
        'status' => true
    );


    public function __construct () {

      add_action( 'wp_ajax_nopriv_add_like', array( &$this, 'addLike') );
      add_action( 'wp_ajax_add_like', array( &$this, 'addLike') );

      add_action( 'wp_ajax_nopriv_add_vote', array( &$this, 'addVote') );
      add_action( 'wp_ajax_add_vote', array( &$this, 'addVote') );

    }

    public function addLike() {

      @session_start();

      $postID = $_REQUEST['postID'];
      $IP = $_SERVER['REMOTE_ADDR'];

      if ( !empty($postID) ) {

        $post = get_post($postID);

        $postLikes = (int) get_post_meta($postID, "post-likes", true);
        $postLikes++;

        update_post_meta($postID, "post-likes", $postLikes);

        $this->response['message'] = 'Der Beitrag konnte nicht zugeordnet werden.';
        $this->response['likes'] = $postLikes;
        $this->response['status'] = true;

      }

      else {

          $this->response['message'] = 'Der Beitrag konnte nicht zugeordnet werden.';
          $this->response['status'] = false;

      }

      $this->respond();

    }


    public function addVote() {

      @session_start();

      $key = $_REQUEST['key'];
      $postID = $_REQUEST['postID'];
      $IP = $_SERVER['REMOTE_ADDR'];

      if ( !empty($postID) ) {

        $post = get_post($postID);

        $postVotes = (int) get_post_meta($postID, $key, true);
        $postVotes++;

        update_post_meta($postID, $key, $postVotes);

        $this->response['message'] = 'Sie haben abgestimmt';
        $this->response['votes'] = array(
          'post-votes-up' => (int) get_post_meta($postID, 'post_votes_up', true),
          'post-votes-down' => (int) get_post_meta($postID, 'post_votes_down', true),
          'post-votes-neutral' => (int) get_post_meta($postID, 'post_votes_neutral', true)
        );
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
