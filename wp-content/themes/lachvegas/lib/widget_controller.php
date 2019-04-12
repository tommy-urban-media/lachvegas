<?php

/**
 * Class WidgetController
 */

// import widgets
//include_once('widgets/ts_custom_nav_menu_widget.php');
//include_once('widgets/ts_htmlbox_widget.php');

class WidgetController {

  public function __construct () {
    add_action('widgets_init', array(&$this, 'registerSidebars'));
    add_action('widgets_init', array(&$this, 'unregisterWidgets'), 1);

    //add_action('widgets_init', array(&$this, 'register_htmlbox_widget'));
    //add_action('widgets_init', create_function('', 'return register_widget("TS_Custom_Nav_Menu_Widget");'));
  }

  public function registerSidebars() {

    register_sidebar( array(
      'name' => __( 'Main Sidebar', 'theme' ),
      'id' => 'sidebar-main',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

    register_sidebar( array(
      'name' => __( 'Header Sidebar', 'theme' ),
      'id' => 'sidebar-header',
      'description' => __( 'An optional widget area for your site footer', 'theme' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

    register_sidebar( array(
      'name' => __( 'Showcase Sidebar', 'theme' ),
      'id' => 'sidebar-showcase',
      'description' => __( 'The sidebar for the optional Showcase Template', 'theme' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

    register_sidebar( array(
      'name' => __( 'Footer Left Sidebar', 'theme' ),
      'id' => 'sidebar-footer-left',
      'description' => __( 'An optional widget area for your site footer', 'theme' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

    register_sidebar( array(
      'name' => __( 'Footer Center Sidebar', 'theme' ),
      'id' => 'sidebar-footer-center',
      'description' => __( 'An optional widget area for your site footer', 'theme' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

    register_sidebar( array(
      'name' => __( 'Footer Right Sidebar', 'theme' ),
      'id' => 'sidebar-footer-right',
      'description' => __( 'An optional widget area for your site footer', 'theme' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );


    register_sidebar( array(
      'name' => __( 'Language Sidebar', 'theme' ),
      'id' => 'sidebar-language',
      'description' => __( 'A widget area to display language', 'theme' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => "</aside>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );

  }


  public function unregisterWidgets() {

    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');

  }


  public function register_htmlbox_widget() {

    register_widget('TS_HtmlBox_Widget');

  }


}
