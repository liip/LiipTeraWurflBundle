<?php

/*
 * This file is part of the Liip/TeraWurflBundle
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\TeraWurflBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;

class TeraWurflExtension extends Extension
{
    /**
     * Yaml config files to load
     * @var array
     */
    protected $resources = array(
        'config' => 'config.xml',
    );

    /**
     * Loads the services based on your application configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function configLoad($configs, ContainerBuilder $container)
    {
        // TODO: Check if this is neccesary
        /*$config = array_shift($configs);
        foreach ($configs as $tmp) {
            $config = array_replace_recursive($config, $tmp);
        }

        $loader = $this->getFileLoader($container);
        $loader->load($this->resources['config']);

        foreach ($config as $key => $value) {
            $container->setParameter($this->getAlias().'.'.$key, $value);
        }*/
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
