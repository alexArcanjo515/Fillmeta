<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4344a44085bc8991182dd7e356effd20
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4344a44085bc8991182dd7e356effd20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4344a44085bc8991182dd7e356effd20::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4344a44085bc8991182dd7e356effd20::$classMap;

        }, null, ClassLoader::class);
    }
}
