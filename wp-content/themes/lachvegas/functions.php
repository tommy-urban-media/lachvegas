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


add_action( 'after_setup_theme', 'theme_setup' );

if ( !function_exists( 'theme_setup' ) ):

  function theme_setup() {

    show_admin_bar( false );

	  add_editor_style();
	  add_theme_support( 'post-thumbnails' );


		// init the theme specific settings
    new ContentTypeController();
    new AjaxController();
    new MenuController();
    //new TS_Media();
    //new ShortcodeController();
    //new WidgetController();
    new PostController();



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


function post_type_tags_fix($request) {
	if ( isset($request['tag']) && !isset($request['post_type']) )
	$request['post_type'] = array('post', 'news');
	return $request;
} 
add_filter('request', 'post_type_tags_fix');


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
    $short_content .= ' ... <a class="read-more-link" href="'. $post->guid .'" title="'.$post->post_title.'">'.$readmore.'</a>';
    return $short_content;

  }
	else
		return $excerpt;
}


function getChildCategory( $postID ) {

	$categories = wp_get_post_categories( $postID, array('fields' => 'ids') );

	$arguments = array(
			'taxonomy'    => 'category',
			'childless'   => true,
			'include'     => $categories,
	);
	
	return get_terms( $arguments )[0]->name;

}

