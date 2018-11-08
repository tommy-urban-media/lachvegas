<?php
/**
 * The Header for the theme.
 */

global $theme_settings;
global $theme_custom;
global $theme_social_media;

$theme_settings 		= get_option("theme_settings_page");
$theme_custom 			= get_option("theme_custom_page");
$theme_social_media 	= get_option("theme_social_media_page");

?>
<!DOCTYPE html>

<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->

<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>
<?php

	global $page, $paged;

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );


	wp_title( '&raquo;', true, 'right' );

	bloginfo( 'name' );

	if ( $site_description && ( is_home() || is_front_page() ) )
		echo ' - ' . $site_description;


	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'theme' ), max( $paged, $page ) );

	?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/app/public/css/app.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url'); ?>/public/favicon.png" />

<style>@import url('https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700,800,900');</style>


<!--
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fancybox/fancybox-1.3.4.css" />
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100,100italic,700,500" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Vollkorn:400,700' rel='stylesheet' type='text/css'>
-->


<?php

	if ( is_singular() && get_option( 'thread_comments' ) ) {
		//wp_enqueue_script( 'comment-reply' );
	}

	//wp_register_script('jquery', ("http://code.jquery.com/jquery-1.8.3.js"), false, '1.3.2');
	//wp_enqueue_script('jquery');

 	$template_url = get_bloginfo('template_url');

	//wp_register_script('jquery-masonry', ($template_url . "/public/js/masonry.pkgd.min.js"));
	//wp_enqueue_script('jquery-masonry');

 	/*
 	wp_register_script('cssbrowser-selector', ($template_url."/js/css_browser_selector.js"));
 	wp_register_script('jquery-tools', ($template_url."/js/jquery.tools.js"));

 	wp_enqueue_script('cssbrowser-selector');
 	wp_enqueue_script('jquery-tools');
 	*/

 	//wp_register_script('jquery-easing', ($template_url."/js/jquery.easing-1.3.pack.js"));
 	//wp_register_script('jquery-fancybox', ($template_url."/js/jquery.fancybox-1.3.4.js"));
 	//wp_register_script('jquery-cycle', ($template_url."/js/jquery.cycle.all.js"));
 	//wp_register_script('jquery-cookie', ($template_url."/js/jquery.cookie.js"));

 	//wp_enqueue_script('jquery-easing');
 	//wp_enqueue_script('jquery-fancybox');
 	//wp_enqueue_script('jquery-cycle');
 	//wp_enqueue_script('jquery-cookie');

 	/* print the theme js */
 	//wp_register_script('app', ($template_url. "/public/js/app.js"));
 	//wp_enqueue_script('app');

	//wp_register_script('app', ($template_url. "/public/js/theme.js"));
 	//wp_enqueue_script('app');

	wp_head();

?>

<?php
if ( isset($theme_social_media['google_analytics_id']) && !empty($theme_social_media['google_analytics_id']) )
	theme_google_analytics( $theme_social_media['google_analytics_id'] );
?>

</head>

<body <?php body_class(); ?>>

<div class="page-container">

	<header class="header">

		<div class="header-inner">

			<p class="page-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="page-name">
						<span class="page-name-num">Lach</span>
						<span class="page-name-txt">Vegas</span>
					</span>
					<span class="page-slogan"><?php echo get_bloginfo('description') ?></span>
				</a>
			</p>

			<nav class="headermenu">
				<span class="menu-icon"></span>
				<?php wp_nav_menu( array('theme_location' => 'headermenu') ); ?>
			</nav>
		</div>

	</header>

	<main class="main" role="main">

		<div class="mainmenu-wrapper">
			<nav class="mainmenu" role="navigation">
				<span class="menu-icon"></span>
				<?php wp_nav_menu( array('theme_location' => 'mainmenu') ); ?>
			</nav>

			<?php get_template_part('template-parts/socials'); ?>
		</div>