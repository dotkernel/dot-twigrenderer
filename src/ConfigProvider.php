<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig;

use Dot\FlashMessenger\View\FlashMessengerRenderer;
use Dot\Navigation\View\NavigationRenderer;
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
                // twig 1.x
                \Twig_Environment::class => [
                    TwigEnvironmentDelegator::class,
                ],

                // twig 2.x
                \Twig\Environment::class => [
                    TwigEnvironmentDelegator::class,
                ],

                FlashMessengerRenderer::class => [
                    LazyServiceFactory::class,
                ],
                NavigationRenderer::class => [
                    LazyServiceFactory::class,
                ]
            ],

            'lazy_services' => [
                'class_map' => [
                    NavigationRenderer::class =>
                        NavigationRenderer::class,

                    FlashMessengerRenderer::class =>
                        FlashMessengerRenderer::class,
                ]
            ],

            'aliases' => [
                'ViewHelperManager' => HelperPluginManager::class,
            ],
        ];
    }
}
