<?php

/**
 * AjaxController
 *
 * Handle theme specific ajax calls
 */

use GDText\Box;
use GDText\Color;

include_once __DIR__ . '/classes/image.php';
include_once __DIR__ . '/models/saying.php';

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

      add_action( 'wp_ajax_nopriv_add_quiz_result', array( &$this, 'addQuizResult') );
      add_action( 'wp_ajax_add_quiz_result', array( &$this, 'addQuizResult') );

      add_action( 'wp_ajax_nopriv_generate_image_from_post_title', array( &$this, 'generateImageFromPostTitle') );
      add_action( 'wp_ajax_generate_image_from_post_title', array( &$this, 'generateImageFromPostTitle') );

      add_action( 'wp_ajax_nopriv_save_post', array( &$this, 'savePost') );
      add_action( 'wp_ajax_save_post', array( &$this, 'savePost') );

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


    public function addQuizResult() {

      @session_start();

      $quizID = $_REQUEST['quiz_id'];
      $questionID = $_REQUEST['question_id'];
      $questionResult = $_REQUEST['question_result'];
      $answerID = $_REQUEST['answer_id'];
      $answerValue = $_REQUEST['answer_value'];

      $IP = $_SERVER['REMOTE_ADDR'];

      if (!empty($quizID)) {
        $quiz = get_option('quiz_' . $quizID);
        $this->response['status'] = true;
        $this->response['answer_correct'] = $answerValue == $questionResult ? true : false;

        if (!isset($quiz['results'])) {
          $quiz['results'] = [];
        }
        if (!isset($quiz['results'][(int)$questionID][(int)$answerID])) {
          $quiz['results'][(int)$questionID][(int)$answerID] = 1;
        } else {
          $quiz['results'][(int)$questionID][(int)$answerID]++;
        }

        update_option('quiz_' . $quizID, $quiz);

        $this->response['results'] = $quiz['results'];

      }
      else {
        $this->response['message'] = 'Der Beitrag konnte nicht zugeordnet werden.';
        $this->response['status'] = false;
      }

      $this->respond();

    }




    public function generateImageFromPostTitle() {

      $id = $_REQUEST['id'];
      $p = get_post($id);

      if ($p) {
        // var_dump($p);
        
        $postImage = false;
        if (has_post_thumbnail($p->ID)) {
          $attachment_id = get_post_thumbnail_id($p->ID);
          //$postImage = wp_get_attachment_image_src($attachment_id, 'full');

          if (attachment_id) {
            $postImage = get_attached_file( $attachment_id ); // Full path
            $postImage = $this->scaled_image_path($attachment_id, 'square_640');
          }
        
        }

        var_dump($postImage);

        $options = [
          'width' => 640,
          'height' => 640,
          'sizeFactor' => 4,
          'text' => get_the_title($p->ID),
          'slug' => basename(get_permalink($p->ID)),
          'postImage' => $postImage
        ];

        $image = new Image((object)$options);
        $image->generate();

        $path = $image->getPath();
        $fullPath = $image->getFullPath();
        update_post_meta($p->ID, 'image_name', $path );

        $image->savePostThumbnail($p->ID, $fullPath);

      }

      $this->response['message'] = 'Done';
      $this->response['status'] = true;
      $this->respond();

    }


    private function scaled_image_path($attachment_id, $size = 'thumbnail') {
      $file = get_attached_file($attachment_id, true);
      if (empty($size) || $size === 'full') {
          // for the original size get_attached_file is fine
          return realpath($file);
      }
      if (! wp_attachment_is_image($attachment_id) ) {
          return false; // the id is not referring to a media
      }
      $info = image_get_intermediate_size($attachment_id, $size);
      if (!is_array($info) || ! isset($info['file'])) {
          return false; // probably a bad size argument
      }
  
      return realpath(str_replace(wp_basename($file), $info['file'], $file));
    }


    public function savePost() {
        $id = $_REQUEST['id'];
        $type = $_REQUEST['type'];
        $title = $_REQUEST['title'];
        $description = $_REQUEST['title'];
        $categories = explode('.', $_REQUEST['categories']);
        $tags = explode('.', $_REQUEST['tags']);
        $image = $_REQUEST['image'];

        // add default category for this post
        $categories[] = 'Sprüche';
        
        //$p = get_post($id);

        $data = [
            'id' => $id,
            'date' => date('Y-m-d H:i:s'),
            'title' => $title,
            'description' => $description,
            'category' => $categories,
            'tags' => $tags,
            'image' => $image
        ];

        switch($type) {
            case 'saying':
                $saying = new Saying($data);
                $saying->save();
                $saying->generateImage();
                break;
        }

        exit;
    }
  

    private function respond() {
        echo json_encode($this->response);
        exit;
    }


}
