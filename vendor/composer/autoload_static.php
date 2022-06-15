<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit51b46727ce48da11d72ea5fd52022d85
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => '/Core',
        ),
        'App\\' => 
        array (
            0 => '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit51b46727ce48da11d72ea5fd52022d85::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit51b46727ce48da11d72ea5fd52022d85::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit51b46727ce48da11d72ea5fd52022d85::$classMap;

        }, null, ClassLoader::class);
    }
}