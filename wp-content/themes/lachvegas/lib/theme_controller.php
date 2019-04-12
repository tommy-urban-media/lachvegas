<?php
/**
 * Class ThemeFunctions
 *
 * Define template function for the theme here
 */

class ThemeController {


  public static function loadFiles() {

    // register css and js files to wp
    //wp_enqueue_style( uniqid(rand()), get_bloginfo('template_url') . '/dist/css/styles.css' );
    //wp_enqueue_script( uniqid(rand()), get_bloginfo('template_url') . '/dist/js/vendor.js');
    //wp_enqueue_script( uniqid(rand()), get_bloginfo('template_url') . '/dist/js/base.js', array('jquery'));

  }


  public static function getPostViews($postID){
    $count_key = 'post-views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0';
    }
    return $count;
  }


  public static function getPostVotesNum ($postID) {

    $postVotesUp = 'post_votes_up';
    $postVotesDown = 'post_votes_down';

    $postVotesUp = (int)get_post_meta($postID, $postVotesUp, true);
    $postVotesDown = (int)get_post_meta($postID, $postVotesDown, true);

    return ($postVotesUp + $postVotesDown);

  }


  public static function getPostVotes ($postID) {

    $postVotesUp = 'post_votes_up';
    $postVotesDown = 'post_votes_down';
    $postVotesNeutral = 'post_votes_neutral';

    $postVotesHTML = '';

    if (!$postVotesUp && !$postVotesDown && !$postVotesNeutral) {
      $sum = 0;
    }

    else {

      $postVotesUp = (int)get_post_meta($postID, $postVotesUp, true);
      $postVotesDown = (int)get_post_meta($postID, $postVotesDown, true);
      $postVotesNeutral = (int)get_post_meta($postID, $postVotesNeutral, true);

      // $sum = $postVotesUp + $postVotesDown + $postVotesNeutral;
      $sum = $postVotesUp + $postVotesDown;

      if ($sum) {

        $postVotesUpPercent = $postVotesUp * 100 / $sum;
        $postVotesDownPercent = $postVotesDown * 100 / $sum;
        $postVotesNeutralPercent = $postVotesNeutral * 100 / $sum;

        $postVotesHTML .= '<span class="post-votes-up" style="width:'. $postVotesUpPercent .'%;"> lustig ('. round($postVotesUpPercent) .'%)</span>';
        $postVotesHTML .= '<span class="post-votes-down" style="width:'. $postVotesDownPercent .'%;"> nicht lustig ('. round($postVotesDownPercent) .'%)</span>';
        // $postVotesHTML .= '<span class="post-votes-neutral" style="width:'. $postVotesNeutralPercent .'%;">  weder noch ('. round($postVotesNeutralPercent) .'%)</span>';


      }

    }

    return $postVotesHTML;

  }


  public static function getDate()
  {
    $weekDays = [
      '', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'
    ];

    $weekDay = $weekDays[date('N')];

    echo $weekDay . ' der ' . date('d.m.Y');
  }



  public static function getQuery() {


  }

}
