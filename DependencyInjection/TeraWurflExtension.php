<?php

/*
 * @author Alain Horner <alain.horner@liip.ch>
 * @author Lea Haensenberger <lea.haensenberger@gmail.com>
 *
 * This file is part of the Liip/TeraWurflBundle
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\TeraWurflBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\FileLocator;

class TeraWurflExtension extends Extension
{
    /**
     * Yaml config files to load
     * @var array
     */
    protected $resources = array(
        'config' => 'config.yml',
    );

    /**
     * Loads the services based on your application configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function configLoad($configs, ContainerBuilder $container)
    {
        $config = array_shift($configs);
        foreach ($configs as $tmp) {
            $config = array_replace_recursive($config, $tmp);
        }

        $loader = $this->getFileLoader($container);
        $loader->load($this->resources['config']);

        foreach ($config as $key => $value) {
            $container->setParameter($this->getAlias().'.'.$key, $value);
        }
    }

    /**
     * Get File Loader
     *
     * @param ContainerBuilder $container
     */
    public function getFileLoader($container)
    {
        return new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    }

    /**
     * @inheritDoc
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * @inheritDoc
     */
    public function getNamespace()
    {
        return 'http://liip.ch/schema/dic/terawurfl';
    }

    /**
     * @inheritDoc
     */
    public function getAlias()
    {
        return 'liip_terawurfl';
    }
}
