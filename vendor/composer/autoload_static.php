<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc206e2f13ad84bdeb811db1cf7e50df4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Helper\\' => 11,
            'App\\Auth\\' => 9,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Helper\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/helper',
        ),
        'App\\Auth\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/auth',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc206e2f13ad84bdeb811db1cf7e50df4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc206e2f13ad84bdeb811db1cf7e50df4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}