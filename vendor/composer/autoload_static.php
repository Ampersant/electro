<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc26ead55ae33c8afd5e097db9c525a7f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pagerfanta\\Twig\\' => 16,
            'Pagerfanta\\Solarium\\' => 20,
            'Pagerfanta\\Elastica\\' => 20,
            'Pagerfanta\\Doctrine\\PHPCRODM\\' => 29,
            'Pagerfanta\\Doctrine\\ORM\\' => 24,
            'Pagerfanta\\Doctrine\\MongoDBODM\\' => 31,
            'Pagerfanta\\Doctrine\\DBAL\\' => 25,
            'Pagerfanta\\Doctrine\\Collections\\' => 32,
            'Pagerfanta\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pagerfanta\\Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Twig',
        ),
        'Pagerfanta\\Solarium\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Solarium',
        ),
        'Pagerfanta\\Elastica\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Elastica',
        ),
        'Pagerfanta\\Doctrine\\PHPCRODM\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/PHPCRODM',
        ),
        'Pagerfanta\\Doctrine\\ORM\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/ORM',
        ),
        'Pagerfanta\\Doctrine\\MongoDBODM\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/MongoDBODM',
        ),
        'Pagerfanta\\Doctrine\\DBAL\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/DBAL',
        ),
        'Pagerfanta\\Doctrine\\Collections\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/Collections',
        ),
        'Pagerfanta\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc26ead55ae33c8afd5e097db9c525a7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc26ead55ae33c8afd5e097db9c525a7f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc26ead55ae33c8afd5e097db9c525a7f::$classMap;

        }, null, ClassLoader::class);
    }
}