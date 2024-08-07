<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbe1639c79c7c0ebc1325308ddc67adee
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hasokeyk\\Trendyol\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hasokeyk\\Trendyol\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Trendyol',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbe1639c79c7c0ebc1325308ddc67adee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbe1639c79c7c0ebc1325308ddc67adee::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbe1639c79c7c0ebc1325308ddc67adee::$classMap;

        }, null, ClassLoader::class);
    }
}
