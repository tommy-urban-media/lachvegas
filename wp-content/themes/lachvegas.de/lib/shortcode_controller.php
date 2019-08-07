<?php

/**
 * Class ShortcodeController
 *
 * Defines shortcodes and their behaviour here.
 * Shortcode handler functions must be public.
 *
 */
class ShortcodeController {

    // define shortcodes as they are beeing used in WP
    private $shortcodes = array(
        'passwordgenerator' => 'register_passwordgenerator',
        'starwars' => 'register_starwars',
        'fortune_cookie' => 'register_fortune_cookie_shortcode'
    );

    public function __construct () {

        // register shortcodes in WP
        foreach ( $this->shortcodes as $shortcodeName => $shortcodeFunc )
          add_shortcode($shortcodeName, array( &$this, $shortcodeFunc ));
    }

    public function register_starwars ( $attr ) {

      extract(shortcode_atts(array('foo' => ''), $attr));
      load_template( get_template_directory() . '/shortcodes/starwars.php');
    }
    
    public function register_fortune_cookie_shortcode($attr) {
        extract(shortcode_atts(array('foo' => ''), $attr));

        ob_start();
        load_template( get_template_directory() . '/template-parts/sections/fortune-cookie.php');

        return ob_get_clean();
    }

}
