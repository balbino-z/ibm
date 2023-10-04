<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitffcd3c8d041ce867ac7f4ec2e5b8bc8b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitffcd3c8d041ce867ac7f4ec2e5b8bc8b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitffcd3c8d041ce867ac7f4ec2e5b8bc8b::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitffcd3c8d041ce867ac7f4ec2e5b8bc8b::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitffcd3c8d041ce867ac7f4ec2e5b8bc8b::$classMap;

        }, null, ClassLoader::class);
    }
}
