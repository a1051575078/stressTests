<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd29251d513defaad1aa762a30e94423c
{
    public static $files = array (
        '045cd5d476702c3529ef3e1b9f615e70' => __DIR__ . '/..' . '/swlib/http/src/functions.php',
        '3a6b4a1bc7c69c0620b4ef88fb5d27d0' => __DIR__ . '/..' . '/swlib/saber/src/include/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Swlib\\Util\\' => 11,
            'Swlib\\Saber\\' => 12,
            'Swlib\\Http\\' => 11,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Swlib\\Util\\' => 
        array (
            0 => __DIR__ . '/..' . '/swlib/util/src',
        ),
        'Swlib\\Saber\\' => 
        array (
            0 => __DIR__ . '/..' . '/swlib/saber/src',
        ),
        'Swlib\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/swlib/http/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
    );

    public static $classMap = array (
        'Swlib\\Saber' => __DIR__ . '/..' . '/swlib/saber/src/Saber.php',
        'Swlib\\SaberGM' => __DIR__ . '/..' . '/swlib/saber/src/SaberGM.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd29251d513defaad1aa762a30e94423c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd29251d513defaad1aa762a30e94423c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd29251d513defaad1aa762a30e94423c::$classMap;

        }, null, ClassLoader::class);
    }
}