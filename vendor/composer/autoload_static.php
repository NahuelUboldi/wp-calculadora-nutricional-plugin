<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1aebf53a4332110478cf0c93f8a7a289
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1aebf53a4332110478cf0c93f8a7a289::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1aebf53a4332110478cf0c93f8a7a289::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1aebf53a4332110478cf0c93f8a7a289::$classMap;

        }, null, ClassLoader::class);
    }
}
