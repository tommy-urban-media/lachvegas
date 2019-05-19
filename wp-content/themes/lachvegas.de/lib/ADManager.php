<?php

/**
 * ADManager
 */

class ADManager {

    private static $ad_dir;

    private static $folders = [
        'leaderboard' => 'leaderboard/',
        'square' => 'square/',
        'superbanner' => 'superbanner/'
    ];

    public function __construct() {
        self::$ad_dir = get_template_directory() . '/partials/ads/';
    }

    public static function display( $size = 'square', $lazy = false ) {
        
        self::$ad_dir = get_template_directory() . '/partials/ads/';
        $folder = self::$folders[$size];

        $files = array_slice(scandir(self::$ad_dir . $size), 2);
        $rand = rand(0, count($files)-1);
        
        return get_template_part('partials/ads/' . $size .'/'. str_replace('.php', '', $files[$rand]) );
        
    }
}
