<?php
/**
 * @package         Cloudpayments
 * @version         1.0.0
 * @author          Sergey Osipov <info@devstratum.ru>
 * @website         https://devstratum.ru
 * @copyright       Copyright (c) 2024 Sergey Osipov. All Rights Reserved
 * @license         GNU General Public License v2.0
 * @report          https://github.com/devstratum/cloudpayments/issues
 */

\defined('_JEXEC') or exit;

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The content service provider
 */
return new class implements ServiceProviderInterface
{
    /**
     * Registers the service provider with a DI container
     *
     * @param   Container  $container  The DI container
     * @since   1.0.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(new ModuleDispatcherFactory('\\Devstratum\\Module\\Cloudpayments'));
        $container->registerServiceProvider(new HelperFactory('\\Devstratum\\Module\\Cloudpayments\\Site\\Helper'));
        $container->registerServiceProvider(new Module);
    }
};