<?php

/**
 * Class MenuController
 *
 * Define WP Menus for the theme
 */
class MenuController {

  public function __construct () {

    register_nav_menu( 'mainmenu', 'Hauptmenu' );
    register_nav_menu( 'footermenu', 'Footermenu' );
    register_nav_menu( 'headermenu', 'Headermenu' );
    register_nav_menu( 'topicmenu', 'Weitere Themen' );

  }
  
}
