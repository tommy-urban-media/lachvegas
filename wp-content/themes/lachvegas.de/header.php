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
<meta name="p:domain_verify" content="571f66866ffeafd18f545a47451fff9d"/>
<meta name="robots" content="index, follow, noarchive, noodp"/>

<title>
<?php

	// global $page, $paged;

	// Add the blog description for the home/front page.
	//$site_description = get_bloginfo( 'description', 'display' );

	// bloginfo( 'name' );

	//if ( $site_description && ( is_home() || is_front_page() ) )
		//echo ' - ' . $site_description;


	// Add a page number if necessary:
	//if ( $paged >= 2 || $page >= 2 )
		//echo sprintf( __( 'Seite %s', 'theme' ), max( $paged, $page ) ) . ' - ';

	wp_title('');
?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/app/public/css/app.css?ver=0.2" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url'); ?>/app/images/eyes.png" />

<style>@import url('https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700,800,900|Indie+Flower');</style>

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

<!-- Global site tag (gtag.js) - Google Analytics -->
<?php if ($_SERVER['SERVER_NAME'] != 'localhost'): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23558535-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-23558535-12');
</script>
<?php endif ?>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-5632762269034234",
          enable_page_level_ads: true
     });
</script>

</head>

<body <?php body_class(); ?> data-component="InfoBox">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v3.2&appId=430709494322673';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="page-container">
    
    <?php get_template_part('partials/page/header') ?>
    
	<main class="main">
		
		<?php get_template_part('template-parts/cookie-info'); ?>

		<div class="subheader">
			<h1 class="page-slogan">
				<div>Die</div>
				<div>Website</div>
				<div>für</div>
				<div>Bekloppte</div>
				<div>und</div>
				<div>Wahnsinnige</div>
				<div>aller</div> 
				<div>Art</div>
			</h1>

			<!--
			<p>
			Schnauze voll von schlechten Nachrichten ???
			Geht Ihnen das auch so? Sie können die ganzen schlechten News im Internet nicht mehr sehen. Sie regen sich ständig darüber auf was alles schief läuft.
			Überall schlechte Nachrichten, Mord und Totschlag<br><br>
			Die Lösung: LACHVEGAS.DE 
			</p>
			-->

			<?php get_template_part('template-parts/socials'); ?>
		</div>
        

        <?php /* ?>
		<div class="topicmenu-wrapper">
			<?php get_template_part('template-parts/topics'); ?>
		</div>
        <?php*/ ?>

		<?php ADManager::display('leaderboard')?>
		<?php //get_template_part('partials/common/newsticker'); ?>
		<?php //get_template_part('template-parts/ads/frontend/leaderboard'); ?>

		