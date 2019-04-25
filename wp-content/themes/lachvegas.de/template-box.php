<!DOCTYPE html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />    
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/app/public/css/box.css" />
    </head>
<body>

<?php
/**
 * Template Name: AD Box
 */

// get_header(); 

$ad_sizes = [
    'square' => [
        'size' => [300, 250]
    ],
    'small_square' => [
        'size' => [250, 250]
    ],
    'large_square' => [
        'size' => [336, 280]
    ],
    'leaderboard' => [
        'size' => [728, 90]
    ],
    'leaderboard_large' => [
        'size' => [970, 90]
    ]
];



$size = 'banner';
if (isset($_REQUEST['size'])) {
    $size = $_REQUEST['size'];
}

ob_start();

$basedir = __DIR__ . '/template-parts/ads/';

if (is_dir($basedir . $size)) {
    $files = array_slice(scandir(__DIR__ . '/template-parts/ads/' . $size), 2);
    $rand = rand(0, count($files)-1);

    // load all files from this ad type
    get_template_part('template-parts/ads/'. $size .'/'. str_replace('.php', '', $files[$rand]) );
    
    echo ob_get_clean();
} else {
    echo 'directory not exists';
}

?>

</body>
</html>