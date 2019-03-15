<?php

include_once( dirname(__FILE__) . '/lib/ajax_controller.php' );
//include_once( dirname(__FILE__) . '/lib/theme_options_controller.php' );
include_once( dirname(__FILE__) . '/lib/content_type_controller.php' );
include_once( dirname(__FILE__) . '/lib/menu_controller.php' );
//include_once( dirname(__FILE__) . '/lib/media_controller.php' );
include_once( dirname(__FILE__) . '/lib/post_controller.php' );
include_once( dirname(__FILE__) . '/lib/shortcode_controller.php' );
include_once( dirname(__FILE__) . '/lib/widget_controller.php' );
include_once( dirname(__FILE__) . '/lib/theme_controller.php' );
include_once( dirname(__FILE__) . '/lib/classes/import.php' );

require __DIR__ . '/app/vendor/autoload.php';

use GDText\Box;
use GDText\Color;



add_action( 'after_setup_theme', 'theme_setup' );

if ( !function_exists( 'theme_setup' ) ):

  function theme_setup() {

    show_admin_bar( false );

	  add_editor_style();
		add_theme_support( 'post-thumbnails' );	

		add_image_size( 'medium_large', '768', '0', false ); 
		add_image_size( 'medium_large', '768', '0', false ); 
		add_image_size( 'article_thumbnail', '384', '240', true ); 
		add_image_size( 'article-header', '1000', '563', true ); 
		add_image_size( 'medium_2x', '600', '600', true ); 
		add_image_size( 'portrait_2x', '600', '1200', true ); 

		// add 16 to 9 formats
		add_image_size( '16_9_small', 128, 72, true ); 
		add_image_size( '16_9_medium', 256, '144', true ); 
		add_image_size( '16_9_large', 512, 288, true ); 
		add_image_size( '16_9_extralarge', 1024, 576, true ); 
		add_image_size( '16_9_full', 2048, 1152, true ); 


		// init the theme specific settings
    new ContentTypeController();
    new AjaxController();
    new MenuController();
    //new TS_Media();
    //new ShortcodeController();
    //new WidgetController();
		new PostController();

		$import = new Import();

    //if (is_admin() && current_user_can('manage_options'))
      //  new TS_ThemeOptions();
  }

endif;


remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);


// remove all actions related to emojis
remove_action('admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_filter('wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter('the_content_feed', 'wp_staticize_emoji' );
remove_filter('comment_text_rss', 'wp_staticize_emoji' );
add_filter( 'emoji_svg_url', '__return_false' );

remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');


remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
add_filter( 'rest_api_init', function($wp_rest_server){
	remove_action('rest_api_init', 'wp_oembed_register_route');
		if ( !is_user_logged_in() ) {
				wp_die('You are not allowed to access this data','cheatin eh?',403);
		}
}, 99 );


function post_type_tags_fix($request) {
	if ( isset($request['tag']) && !isset($request['post_type']) )
	$request['post_type'] = array('post', 'news', 'guide', 'saying');
	return $request;
} 
add_filter('request', 'post_type_tags_fix');





function showAD( $type = 'banner') {

	$files = array_slice(scandir(__DIR__ . '/template-parts/ads/' . $type), 2);
	$rand = rand(0, count($files)-1);

	// load all files from this ad type
	get_template_part('template-parts/ads/'. $type .'/'. str_replace('.php', '', $files[$rand]) );
	//get_template_part('template-parts/ads/banner/bierweise');

}



/**
 * Register our sidebars and widgetized areas. Also register the default widgets.
 *
 */
//function theme_widgets_init() {

	// register_widget( 'Theme_Google_Maps_Widget' );

//}
//add_action( 'widgets_init', 'theme_widgets_init' );








/* Google Analytics Code */
function theme_google_analytics($id)
{
	?>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '<?php echo $id?>']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
	<?php
}


/**
 * Sets the post excerpt length to a specific length
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function polithema_excerpt_length( $length )
{
	return 50;
}
add_filter( 'excerpt_length', 'polithema_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function theme_continue_reading_link()
{
	return ' <a class="read-more-link" href="'. esc_url( get_permalink() ) . '">&raquo; ' . __('weiterlesen') . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and theme_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function theme_auto_excerpt_more( $more ) {
	return ''; //' &hellip;' . theme_continue_reading_link();
}
add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= theme_continue_reading_link();
	}
	return $output;
}
add_filter( 'the_excerpt', 'theme_custom_excerpt_more' );




if ( ! function_exists( 'theme_comment' ) ) :

function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ):
		case 'pingback' :
		case 'trackback' :
		default :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">

        <span class="comments-number"></span>

				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						/*printf( __( '%1$s on %2$s <span class="says">said:</span>', 'theme' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'theme' ), get_comment_date(), get_comment_time() )
							)
						);
						*/
					?>


					<div class="comment-author-meta">
						<span class="author-name">
							<?php echo get_comment_author()?>
						</span>
						<a class="comment-datetime" href="<?php echo esc_url(get_comment_link($comment->comment_ID))?>">
							<?php echo get_comment_date()?> | <?php echo get_comment_time()?>
						</a>
					</div>

				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Dein Kommentar wartet auf Freischaltung.' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="comment-actions">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __('Edit'), '', '' ); ?>
			</div><!-- .reply -->

			<div class="comments-line-bottom"></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for theme_comment()

/*
class Menu_ID_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$id = $item->object_id;
		$class_names = ' class="' . esc_attr( $class_names ) . '"';


		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .' rel="'. strtolower($item->title) .'">';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<span>&raquo; ' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
*/


function custom_excerpt($excerpt = '', $excerpt_length = 50, $readmore = "mehr", $tags = '<a>') {
  global $post;
  $string_check = explode(' ', $excerpt);

  if( count($string_check, COUNT_RECURSIVE) > $excerpt_length ) {

    $new_excerpt_words = explode(' ', $excerpt, $excerpt_length+1);
    array_pop($new_excerpt_words);
    $excerpt_text = implode(' ', $new_excerpt_words);
    $temp_content = strip_tags($excerpt_text, $tags);
    $short_content = preg_replace('`\[[^\]]*\]`', '', $temp_content);
    $short_content .= ' ... <a class="read-more-link" href="'. get_the_permalink($post->ID) .'" title="'.$post->post_title.'">'.$readmore.'</a>';
    return $short_content;

  }
	else
		return $excerpt;
}


function getChildCategory($postID) {

	$categories = wp_get_post_categories( $postID, array('fields' => 'ids') );

	$arguments = array(
		'taxonomy' => 'category',
		'childless' => true,
		'include' => $categories,
	);

	$term = array();
	
	if (get_terms($arguments) && isset(get_terms($arguments)[0])) {

		$t = get_terms( $arguments )[0];
		$term['name'] = $t->name;
		$term['url'] = get_term_link($t->term_id);
	}

	return (object) $term;

}





function getAdvertisementLink () {

	return home_url('/') . 'lachvegas-unterstuetzen';

}



/* pagination  */
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         { $pages = 1; }
     }   
 
     if(1 != $pages)
     {
         echo "<nav class=\"pagination\"><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class=\"current\">".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive \">".$i."</a></li>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul></nav>\n";
     }
}





function getPagination($query, $page, $is_category = false, $category_id = false) {

	ob_start();

	$max_pages = $query->max_num_pages;

	$showPageFirst = false;
	$showPageLast = false;

	if ($page > 1) {
		$showPageFirst = true;
	}

	if ($page < $max_pages-1) {
		$showPageLast = true;
	}

	if ($max_pages == 1) {
		return;
	} 

	$link = '';
	if ($is_category) {
		$link = get_category_link($category_id);
	} else {
		$link = home_url('/');
	}
	
	?>

	<nav class="pagination">
		<span class="previous-posts">
			<?php previous_posts_link( '&laquo;', $max_pages ); ?>
		</span>

		<?php if ($showPageFirst): ?>
			<span class="pagination_page"><a href="<?= $link ?>page/1">1</a></span>
		<?php endif ?>

		<?php if ($page - 1 >= 2): ?>
		<span class="pagination__dots">...</span>
		<?php endif ?>

		<?php if ($page >= 3): ?>
			<span class="pagination_page"><a href="<?= $link ?>page/<?= ($page - 1) ?>"><?= ($page - 1) ?></a></span>
		<?php endif ?>

		<span class="pagination__current"><?= $page ?></span>

		<?php if ($page <= ($max_pages - 2)): ?>
			<span class="pagination_page"><a href="<?= $link ?>page/<?= ($page + 1) ?>"><?= ($page + 1) ?></a></span>
		<?php endif ?>

		<?php if ($max_pages - $page >= 2): ?>
		<span class="pagination__dots">...</span>
		<?php endif ?>

		<?php if ($showPageLast): ?>
			<span class="pagination_page"><a href="<?= $link ?>page/<?= $max_pages?>"><?= $max_pages ?></a></span>
		<?php endif ?>

		<span class="next-posts">
			<?php next_posts_link( '&raquo;', $max_pages ); ?>
		</span>
	</nav>

	<?php

	return ob_get_clean();

}


/*
function custom_pre_get_posts( $query ) {  
	if( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_category()) {  
			$query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) );  }  } 
	
	add_action('pre_get_posts','custom_pre_get_posts'); 
	
	function custom_request($query_string ) { 
			 if( isset( $query_string['page'] ) ) { 
					 if( ''!=$query_string['page'] ) { 
							 if( isset( $query_string['name'] ) ) { unset( $query_string['name'] ); } } } return $query_string; } 
	
	add_filter('request', 'custom_request');
*/


function prefix_change_cpt_archive_per_page( $query ) {

	//* for cpt or any post type main archive
	if ( $query->is_main_query() && !is_admin() ) {
			$query->set( 'posts_per_page', '10' );
	}

}
add_action( 'pre_get_posts', 'prefix_change_cpt_archive_per_page' );

function prefix_change_category_cpt_posts_per_page( $query ) {

	if ( $query->is_main_query() && ! is_admin() && is_category() ) {
			$query->set( 'post_type', array('news', 'post', 'saying', 'guide', 'poem', 'quiz') );
			$query->set( 'posts_per_page', '10' );
	}

}
add_action( 'pre_get_posts', 'prefix_change_category_cpt_posts_per_page' );


function get_custom_field($postID, $key) {
	if (function_exists('get_field')) {
		return get_field($key, $postID);
	}
	return false; 
}


function imageExists($fileName) {
	return file_exists("images/" . $fileName);
}

function generateImage($title) {

	$width = 640;
	$height = 640;
	$sizeFactor = 4;


	$imageName = sanitize_title($title);

	// var_dump($imageName);

	if ( file_exists("images/". $imageName .".png")) {
		// continue;
	}

	$canvas = imagecreatefrompng('images/_default_640_640.png');
	//$canvas = imagecreatefromjpeg('images/_default.jpg');

	$black = imagecolorallocate( $canvas, 0, 0, 0 ); 
	$white = imagecolorallocate( $canvas, 255, 255, 255 ); 

	//imagefilledrectangle( $canvas, 9, 9, 189, 89, $white ); 

	$font = "/Library/Fonts/Arial.ttf"; 
	$text = $title;
	$fontSize = 32; 

	$wordCount = strlen($text);
	// var_dump($wordCount);

	if ($wordCount <= 200) {
		$fontSize = 28;
	}
	if ($wordCount <= 150) {
		$fontSize = 48;
	}
	if ($wordCount <= 100) {
		$fontSize = 64;
	}
	if ($wordCount <= 50) {
		$fontSize = 68;
	}

	$fontSize *= $sizeFactor; 
	$font_color = imagecolorallocate($canvas, 255, 255, 255);
	$stroke_color = imagecolorallocate($canvas, 0, 0, 0);

	$box = new Box($canvas);
	$box->setFontFace('/Library/Fonts/Arial.ttf'); // http://www.dafont.com/pacifico.font
	$box->setFontSize($fontSize);
	$box->setFontColor(new Color(255, 255, 255));
	$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
	$box->setBox(200, 200, $width*$sizeFactor - 400, $height*$sizeFactor - 600);
	$box->setTextAlign('center', 'center');
	$box->draw($text);

	$text = wordwrap($text, 28, "\n");

	$box = imagettfbbox( $fontSize, 0, $font, $text ); 
	$x = ($width*$sizeFactor - ($box[2] - $box[0])) / 2; 
	$y = ($height*$sizeFactor - ($box[1] - $box[7])) / 2; 
	$y -= $box[7]; 

	$y -= 120;

	//imageTTFText( $canvas, $fontSize, 0, $x, $y, $black, $font, $text ); 
	//imagettfstroketext($canvas, $fontSize, 0, $x, $y, $font_color, $stroke_color, $font, $text, 4);

	imagealphablending($canvas, false);
	imagesavealpha($canvas, true);

	$imageResized = imagecreatetruecolor($width, $height);

	imagealphablending($imageResized, false);
	imagesavealpha($imageResized, true);

	imagecopyresampled($imageResized, $canvas, 0, 0, 0, 0, $width, $height, $width*$sizeFactor, $height*$sizeFactor);

	//imagejpeg( $canvas, "images/imagetest.jpg", 100 ); 
	
	imagepng( $imageResized, "images/". $imageName ."_640_640.png", 9, PNG_ALL_FILTERS); 

	ImageDestroy( $canvas ); 

}




// prevent ACF plugin to remove wp default custom fields
add_filter('acf/settings/remove_wp_meta_box', '__return_false');