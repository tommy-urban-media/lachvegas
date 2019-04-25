<?php

/**
 * AjaxController
 *
 * Handle theme specific ajax calls
 */

use GDText\Box;
use GDText\Color;

include_once __DIR__ . '/classes/image.php';
include_once __DIR__ . '/models/job.php';
include_once __DIR__ . '/models/news.php';
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

      add_action( 'wp_ajax_nopriv_save_poll_result', array( &$this, 'savePollResult') );
      add_action( 'wp_ajax_save_poll_result', array( &$this, 'savePollResult') );

      add_action( 'wp_ajax_nopriv_generate_image_from_post_title', array( &$this, 'generateImageFromPostTitle') );
      add_action( 'wp_ajax_generate_image_from_post_title', array( &$this, 'generateImageFromPostTitle') );

      add_action( 'wp_ajax_nopriv_save_post', array( &$this, 'savePost') );
      add_action( 'wp_ajax_save_post', array( &$this, 'savePost') );

      add_action( 'wp_ajax_nopriv_get_box_content', array( &$this, 'getBoxContent') );
      add_action( 'wp_ajax_get_box_content', array( &$this, 'getBoxContent') );

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
    


    public function savePollResult() {
    
      @session_start();

      $pollID = $_REQUEST['poll_id'];
      $pollAnswerID = $_REQUEST['poll_answer_id'];

      $IP = $_SERVER['REMOTE_ADDR'];

      if (!empty($pollID)) {
        
        $poll = get_post($pollID);

        if ($poll) {

          //var_dump($pollAnswerID);
          
          $pollVotes = get_post_meta($poll->ID, 'poll_votes', true); 
          $pollDataJson = get_post_meta($poll->ID, 'poll_data', true); 
          $pollData = json_decode($pollDataJson);

          //var_dump($pollData);
          $results_number = 0;
          $pollVotes += 1;

          foreach ($pollData as $d) {
            if ($d->id == $pollAnswerID) {
              $d->votes += 1;
              $results_number = round($d->votes * 100 / $pollVotes);
            }
          }

          update_post_meta($poll->ID, 'poll_votes', $pollVotes);
          update_post_meta($poll->ID, 'poll_data', json_encode($pollData));

          $responseData = [
            'votes' => $pollVotes,
            'results_number' => $results_number . '%',
            'results' => $pollData
          ];

          $this->response['message'] = 'Danke für die Abstimmung';
          $this->response['status'] = true;
          $this->response['data'] = $responseData;

        } else {
          $this->response['message'] = 'Poll not found';
          $this->response['status'] = false;
        }

        $this->response['results'] = $quiz['results'];

      }
      else {
        $this->response['message'] = 'No Poll Id given';
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


	/**
	 *  Saving new post type or update existing one by given import id
	 */
    public function savePost() {

        $id = $_REQUEST['id'];
		$postType = $_REQUEST['post_type'];
        $params = $_REQUEST['params'];

		$data =  new stdClass();
		$data->id = $id;
		$data->date = date('Y-m-d H:i:s');

		foreach ($params as $key => $value) {
			$data->{$key} = $value;
		}

        switch($postType) {
			case 'job':
				$job = new Job($data);
				$job->save();
				break;
			case 'news':
				$news = new News($data);
				$news->save();
				break;
            case 'saying':
                $saying = new Saying($data);
                if ($newPostID = $saying->save()) {
                    $p = get_post($newPostID);
                    
                    $options = new stdClass();
                    $options->width = 640;
                    $options->height = 640;
                    $options->sizeFactor = 4;
                    $options->text = get_the_title($p->ID);
                    $options->slug = basename($p->ID);
    
                    $image = new Image($options);
                    $image->generate();
    
                    $path = $image->getPath();
                    $fullPath = $image->getFullPath();
                    update_post_meta($p->ID, 'image_name', $path);
    
                    $image->savePostThumbnail($p->ID, $fullPath);
                }

                break;
        }

        exit;
    }


    public function getBoxContent() {
        $this->response = [
            'message' => 'loaded',
            'status' => true
        ];
        if (isset($_REQUEST['size'])) {
            $size = $_REQUEST['size'];

            ob_start();

            $files = array_slice(scandir(__DIR__ . '/../template-parts/ads/' . $size), 2);
	        $rand = rand(0, count($files)-1);

	        // load all files from this ad type
            get_template_part('template-parts/ads/'. $size .'/'. str_replace('.php', '', $files[$rand]) );
            
            $this->response['html'] = ob_get_clean();
        }

        $this->respond();
    }
  

    private function respond() {
        echo json_encode($this->response);
        exit;
    }


}
