<?php

namespace SvenH\PetFishCo\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PetFishCoExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $xmlLoader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $ymlLoader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $serviceFiles = ['orm.xml', 'manager.xml', 'listener.xml', 'validation.xml'];

        foreach ($serviceFiles as $file) {
            if (strpos($file, '.xml') !== false) {
                $xmlLoader->load($file);
            } else {
                $ymlLoader->load($file);
            }
        }
    }
}
