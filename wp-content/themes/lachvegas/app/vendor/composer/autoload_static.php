<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit857aa1784dd1ba460e04ba92a036c254
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Treinetic\\ImageArtist\\' => 22,
        ),
        'G' => 
        array (
            'GDText\\Tests\\' => 13,
            'GDText\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Treinetic\\ImageArtist\\' => 
        array (
            0 => __DIR__ . '/..' . '/treinetic/imageartist/src',
        ),
        'GDText\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/stil/gd-text/tests',
        ),
        'GDText\\' => 
        array (
            0 => __DIR__ . '/..' . '/stil/gd-text/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit857aa1784dd1ba460e04ba92a036c254::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit857aa1784dd1ba460e04ba92a036c254::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
