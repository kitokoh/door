<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb90d4c6ba2afc6198d5c11959ce974d6
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SWPTLS\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SWPTLS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'SWPTLS\\Admin' => __DIR__ . '/../..' . '/app/Admin.php',
        'SWPTLS\\Ajax' => __DIR__ . '/../..' . '/app/Ajax.php',
        'SWPTLS\\Ajax\\FetchProducts' => __DIR__ . '/../..' . '/app/Ajax/FetchProducts.php',
        'SWPTLS\\Ajax\\ManageNotices' => __DIR__ . '/../..' . '/app/Ajax/ManageNotices.php',
        'SWPTLS\\Ajax\\Tables' => __DIR__ . '/../..' . '/app/Ajax/Tables.php',
        'SWPTLS\\Ajax\\UdTables' => __DIR__ . '/../..' . '/app/Ajax/UdTables.php',
        'SWPTLS\\Assets' => __DIR__ . '/../..' . '/app/Assets.php',
        'SWPTLS\\Database' => __DIR__ . '/../..' . '/app/Database.php',
        'SWPTLS\\Helpers' => __DIR__ . '/../..' . '/app/Helpers.php',
        'SWPTLS\\Multisite' => __DIR__ . '/../..' . '/app/Multisite.php',
        'SWPTLS\\Notices' => __DIR__ . '/../..' . '/app/Notices.php',
        'SWPTLS\\SWPTLS' => __DIR__ . '/../..' . '/app/SWPTLS.php',
        'SWPTLS\\Settings' => __DIR__ . '/../..' . '/app/Settings.php',
        'SWPTLS\\SettingsApi' => __DIR__ . '/../..' . '/app/SettingsApi.php',
        'SWPTLS\\Shortcode' => __DIR__ . '/../..' . '/app/Shortcode.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb90d4c6ba2afc6198d5c11959ce974d6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb90d4c6ba2afc6198d5c11959ce974d6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb90d4c6ba2afc6198d5c11959ce974d6::$classMap;

        }, null, ClassLoader::class);
    }
}