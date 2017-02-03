<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 9:05 PM
 */

declare(strict_types = 1);

namespace Dot\Twig;

use Dot\FlashMessenger\View\RendererInterface as FlashMessengerRendererInterface;
use Dot\Navigation\View\RendererInterface as NavigationRendererInterface;
use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Extension\FlashMessengerExtension;
use Dot\Twig\Extension\FormElementsExtension;
use Dot\Twig\Extension\NavigationExtension;
use Dot\Twig\Factory\AuthenticationExtensionFactory;
use Dot\Twig\Factory\AuthorizationExtensionFactory;
use Dot\Twig\Factory\FlashMessengerExtensionFactory;
use Dot\Twig\Factory\NavigationExtensionFactory;
use Dot\Twig\Zend\View\HelperPluginManagerFactory;
use Zend\Expressive\Twig\TwigEnvironmentFactory;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\Proxy\LazyServiceFactory;
use Zend\View\HelperPluginManager;

/**
 * Class ConfigProvider
 * @package Dot\Twig
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),

            'view_helpers' => [],
        ];
    }

    public function getDependencyConfig(): array
    {
        return [
            'factories' => [
                HelperPluginManager::class => HelperPluginManagerFactory::class,

                AuthenticationExtension::class => AuthenticationExtensionFactory::class,
                AuthorizationExtension::class => AuthorizationExtensionFactory::class,
                NavigationExtension::class => NavigationExtensionFactory::class,
                FlashMessengerExtension::class => FlashMessengerExtensionFactory::class,
                FormElementsExtension::class => InvokableFactory::class,
            ],

            'delegators' => [
                TwigEnvironmentFactory::class => [
                    TwigEnvironmentDelegator::class,
                ],

                FlashMessengerRendererInterface::class => [
                    LazyServiceFactory::class,
                ],
                NavigationRendererInterface::class => [
                    LazyServiceFactory::class,
                ]
            ],

            'lazy_services' => [
                'class_map' => [
                    NavigationRendererInterface::class =>
                        NavigationRendererInterface::class,

                    FlashMessengerRendererInterface::class =>
                        FlashMessengerRendererInterface::class,
                ]
            ],

            'aliases' => [
                'ViewHelperManager' => HelperPluginManager::class,
            ],
        ];
    }
}
